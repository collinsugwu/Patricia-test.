<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 4/8/2020
 * Time: 12:45 PM
 */

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @OA\Post(
     *     path="/posts",
     *     operationId="/posts",
     *     summary="Create a post",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Title of the post",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Description of the post",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Creates a new user, returns a success response with an API token",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation Error",
     *     ),
     * )
     *
     * Handles Post Creation
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);
        $user = $request->user();
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $user->id;
        $post->save();

        return $this->success();
    }

}