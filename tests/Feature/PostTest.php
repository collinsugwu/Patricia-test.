<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 4/8/2020
 * Time: 1:20 PM
 */

namespace Tests\Feature;


use App\Models\Auth\User;
use Faker\Factory;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreatePost()
    {
        $user = $this->createUser();
        $this->loginAs($user);

        $faker = Factory::create();
        $data = [
            'title' => $faker->jobTitle,
            'description' => $faker->paragraph,
            'user_id' => $user->id
        ];

        $this->sendPost('posts', $data);
        $this->assertSuccessResponse();
    }

    public function testAGuestCantCreatePost()
    {
        $user = $this->createUser();
        $faker = Factory::create();
        $data = [
            'title' => $faker->jobTitle,
            'description' => $faker->paragraph,
            'user_id' => $user->id
        ];

        $this->sendPost('posts', $data);
        $this->assertErrorResponse(Response::HTTP_UNAUTHORIZED);
    }

    private function createUser()
    {
        return factory(User::class)->create();
    }
}