<?php

namespace App\Http\Controllers;

use App\Traits\HandlesResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use HandlesResponse;

    /**
     * @OA\Info(
     *   title="Template API",
     *   version="1.0",
     *   @OA\Contact(
     *     email="collinsuchinaka@gmail.com",
     *     name="Development Team"
     *   )
     * )
     *
     * @OA\Server(url="https://api.template.com",description="Live OpenApi Server")
     *
     * @OA\Tag(name="Auth",description="Everything about authentication")
     * @OA\Tag(name="User",description="User details")
     * @OA\Tag(name="Extras",description="Uncategorized")
     * @OA\Tag(name="Admin",description="Admin routes (Not in use)")
     */
}
