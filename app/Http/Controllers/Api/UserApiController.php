<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FormValidatitionDispatcherController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        if ($user) {
            return $user;
            // return new UserCollection($user);
        } else {
            return response()->json([
                'error' => ['message' => 'Problem While Fetching User'],
            ], 400);
        }
    }

    public function authUserLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|min:4',
            'password' => 'required|string|min:6',
        ]);
        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, 'api');
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'error' => ['message' => 'Invalid Login Credentials'],
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        if ($user->status == 0) {
            return response()->json([
                'error' => ['message' => 'User is not active.'],
            ], 401);
        }
        if (count($user->tokens) > 0) {
            $token = $user->tokens->first();
            $token = $token->id . "|" . $token->plain_text;
        } else {
            $token = $user->createToken('auth_token');
            $token = $token->id . "|" . $token->plainTextToken;
        }
        return response()->json([
            'success' => ['message' => 'Logged In Succesfully'],
            'data' => ['access_token' => $token, 'token_type' => 'Bearer', 'user' => $user],
        ], 200);
    }
}