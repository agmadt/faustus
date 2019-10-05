<?php

namespace App\Api\V1\Controllers\Auth;

use App\Api\V1\Controllers\ApiController;
use App\Models\User;
use Dingo\Api\Http\Request;

/**
 * @group Auth
 *
 * APIs for login authentication
 */
class LoginController extends ApiController
{
    /**
     * Get a JWT via given credentials.
     *
     * @bodyParam email string required
     * @bodyParam password required
     *
     * @response {
     *      "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
     *      "token_type": "bearer",
     *      "expires_in": 43800,
     *      "user": {
     *        "id": 3,
     *        "email": "user@secret.test",
     *        "first_name": "Lazarus",
     *        "last_name": "Cannon",
     *      }
     * }
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Refresh a token.
     *
     * @response {
     *      "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
     * }
     */
    public function refresh()
    {
        $token = auth('api')->refresh();
        return response()->json([
            'access_token' => $token,
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @response {
     *       "message": "Successfully logged out"
     * }
     */
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     */
    protected function respondWithToken($token)
    {
        $user = auth('api')->user();

        $userData = [
            'id' => $user->id,
            'email' => $user->email,
        ];

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL(),
            'user' => $userData,
        ]);
    }
}
