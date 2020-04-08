<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\ManagesToken;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    use ManagesToken;

    /**
     * @OA\Post(
     *     path="/login",
     *     operationId="/login",
     *     summary="Login a user and obtain token",
     *     tags={"Auth"},
     *     @OA\Parameter(
     *         name="email_or_username",
     *         in="query",
     *         description="The login parameters should be in a post request, email or username",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Some optional other parameter",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns a success response and an API token",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Error: Bad request. When the merchant does not exist.",
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Error: Bad request. When the merchant name(account_id) is not a word or mis-spelt.",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Error: Bad request. When the user does not exist.",
     *     ),
     * )
     *
     * Handles login
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email_or_username' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $email_or_username = $request->input('email_or_username');
        $user = User::where(function ($builder) use ($email_or_username) {
            $builder->where('username', $email_or_username)
                ->orWhere('email', $email_or_username);
        })->first();

        abort_unless(is_object($user), Response::HTTP_UNAUTHORIZED, 'Unauthorized');

        $verify = Hash::check($request->password, $user->password);
        abort_unless($verify, Response::HTTP_UNAUTHORIZED, 'Unauthorized');

        $token = $this->createTokenFor($user->id);
        return $this->success([
            'token' => $token,
            'user' => $user
        ]);
    }


    /**
     * @OA\Post(
     *     path="/register",
     *     operationId="/register/user",
     *     summary="Registers a user",
     *     tags={"Auth"},
     *     @OA\Parameter(
     *         name="first_name",
     *         in="query",
     *         description="first Name of the user",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="last_name",
     *         in="query",
     *         description="Last Name of the User",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email of User",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="username",
     *         in="query",
     *         description="Username of the user",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password_confirmation",
     *         in="query",
     *         description="Password Confirmation",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="phone",
     *         in="query",
     *         description="Phone of the user",
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
     * Handles Registration
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function registerUser(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'min:3'],
            'last_name' => ['required', 'string', 'min:3'],
            'phone' => ['required', 'string', 'min:9'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        return DB::transaction(function () use ($request) {
            // Create User
            $user = new User($request->all());
            $user->password = Hash::make($request->password);
            $user->save();

            $token = $this->createTokenFor($user->id);
            return $this->success([
                'token' => $token
            ]);
        });
    }

}
