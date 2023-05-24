<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FormValidatitionDispatcherController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserApiController extends Controller
{

    /**
     * Summary of show
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        if ($request->user_id != null) {
            $user = User::where('id', $request->user_id)->first();
        } else {
            $user = auth()->user();
        }

        if ($user) {
            $data = [
                'user' => new UserCollection($user),
                'roles' => $user->roles()->pluck('name'),
                'permissions' => $user->getAllPermissions()->pluck('name'),
            ];
            return ApiResponseController::successWithJustData($data);
        } else {
            return ApiResponseController::error('Problem while fetching user.', 400);
        }
    }

    public function showRoles(Request $request)
    {
        $roles = Role::select('id', 'name')->get();
        if ($roles) {
            return ApiResponseController::successWithJustData($roles);
        } else {
            return ApiResponseController::error('Problem while fetching roles.', 400);
        }
    }

    /**
     * Summary of authUserLogin
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|array|bool
     */
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

            return ApiResponseController::error('Invalid Login Credentials');
        }

        $user = User::where('email', $request->email)->firstOrFail();
        if ($user->status == 0) {
            return ApiResponseController::error('User is not active');
        }

        $token = $user->createToken('auth_token');
        $data = [
            'access_token' => $token->plainTextToken,
            'token_name' => 'auth_token',
            'token_type' => 'Bearer',
            'user' => new UserCollection($user),
            'roles' => $user->roles()->pluck('name'),
            'permissions' => $user->getAllPermissions()->pluck('name'),
        ];
        return ApiResponseController::successWithData('Logged In Successfully', $data);

    }


    /**
     * Summary of registerUser
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|array|bool
     */


    public function registerUser(Request $request)
    {

        $response = (new UserController)->store($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while registering User.', 400);
        }

    }

    /**
     * Summary of update
     * @param Request $request
     * @param mixed $user_id
     * @return \Illuminate\Http\JsonResponse|array|bool
     */

    public function update(Request $request, $user_id)
    {


        $response = (new UserController)->update($request, $user_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while updating User.', 400);
        }
    }

    /**
     * Summary of destroy
     * @param mixed $user_id
     * @return \Illuminate\Http\JsonResponse|array<string>
     */

    public function destroy($user_id)
    {
        $response = (new UserController)->destroy($user_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while deleting User.', 400);
        }
    }
}