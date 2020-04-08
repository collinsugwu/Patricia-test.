<?php

namespace App\Providers;

use App\Http\Traits\ManagesToken;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use ManagesToken;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function (Request $request) {
            //Sample authorization header looks like this
            //Authorization: Bearer your-api-token-here
            $header = $request->header('Authorization');
            if (!empty($header) && preg_match('/Bearer\s(\S+)/', $header, $matches)) {
                $token = $matches[1];

                $tokenObject = $this->checkToken($token);
                if ($tokenObject) {
                    $user_id = $tokenObject->getClaim('sub');
                    return User::find($user_id);
                }
            }

            return null;
        });
    }
}
