<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * @api {post} /api/login User Login
     * @apiVersion 1.0.0
     * @apiName PostUserLogin
     * @apiGroup Users
     * @apiDescription Authenticate user credentials and generate a Sanctum access token.
     *
     * @apiBody {String} email User email address.
     * @apiBody {String} password User password.
     *
     * @apiSuccess {Object} user Authenticated user object including token.
     * @apiSuccess {String} user.token Sanctum plain text authentication token.
     *
     * @apiError (401 Unauthorized) InvalidCredentials Invalid email or password provided.
     * @apiError (422 Unprocessable Entity) ValidationError Validation errors.
     */
    public function login(Request $request)
    {
        $email =    $request->input('email');
        $password = $request->input('password');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $email)->first();

        if(!$user || !Hash::check($password, $password ? $user->password : '')) {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }

        //revoke old tokens

        $user->tokens()->delete();

        $user->token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * @api {get} /api/users Get All Users
     * @apiVersion 1.0.0
     * @apiName GetUsers
     * @apiGroup Users
     * @apiDescription Retrieve a list of all registered users.
     *
     * @apiSuccess {Object[]} users List of user objects.
     * @apiSuccess {Number} users.id User ID.
     * @apiSuccess {String} users.name User name.
     * @apiSuccess {String} users.email User email.
     */

    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }
}
