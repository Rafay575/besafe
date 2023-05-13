<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        User::get();
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $channel = "web")
    {
        $validator = $this->validateData($request);

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->mobile;
        $user->status = $request->status ?: 0;
        $user->ein = $request->ein;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->res_address = $request->res_address;
        $user->perm_address = $request->perm_address;
        $user->id_type = $request->id_type;
        $user->id_no = $request->id_no;
        $user->meta_department_id = $request->meta_department_id ?? null;
        $user->meta_line_id = $request->meta_line_id ?? null;
        $user->meta_designation_id = $request->meta_designation_id ?? null;
        $user->meta_unit_id = $request->meta_unit_id ?? null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/profile'), $imageName);
            $user->image = $imageName;
        }
        if ($request->has('roles') && $request->roles != "") {
            $user->syncRoles($request->roles);
        }

        $user->save();

        if ($channel === 'api') {

            return ApiResponseController::successWithData('User Registered Successfully!', new UserCollection($user));
        }
        return ['success', 'User has been stored'];
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user->roles;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $user_id, $channel)
    {
        $validator = $this->validateData($request, $user_id);

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }
        $user = User::find($user_id);
        if (!$user && $channel === 'api') {
            return ApiResponseController::error('User not found', 404);
        }

        if (!$user)
            return ['error', 'User not found'];

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if ($request->has('password') && $request->password != "") {
            $user->password = Hash::make($request->password);
        }
        $user->mobile = $request->mobile;
        $user->status = $request->status ?: 0;
        $user->ein = $request->ein;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->res_address = $request->res_address;
        $user->perm_address = $request->perm_address;
        $user->id_type = $request->id_type;
        $user->id_no = $request->id_no;
        $user->meta_department_id = $request->meta_department_id ?? null;
        $user->meta_line_id = $request->meta_line_id ?? null;
        $user->meta_designation_id = $request->meta_designation_id ?? null;
        $user->meta_unit_id = $request->meta_unit_id ?? null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/profile'), $imageName);
            $user->image = $imageName;
        }

        if ($request->has('roles') && $request->roles != "") {
            $user->syncRoles($request->roles);
        }


        $user->save();

        if ($channel === 'api') {
            return ApiResponseController::successWithData('User updated Successfully!', new UserCollection($user));
        }
        return ['success', 'User has been updated'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user_id, $channel = "web")
    {
        $user = User::find($user_id);
        if (!$user && $channel === "api") {
            return ApiResponseController::error('User not found', 404);
        }

        if (!$user) {
            return ['error', 'User not found'];
        }

        // deleting the user
        if ($user->delete()) {
            if ($channel === 'api') {
                return ApiResponseController::success('User has been delete');
            } else {
                return ['success', 'User has been deleted'];
            }
        } else {
            if ($channel === 'api') {
                return ApiResponseController::error('Could not delete the user.');
            } else {
                return ['error', 'Could not delete the user'];
            }
        }

    }


    /**
     * Summary of validateData
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    public function validateData(Request $request, $user_id = 0)
    {

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'nullable|regex:/^[0-9]{10,}$/',
            'status' => 'boolean',
            'roles' => 'nullable|string|max:30|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:users,email,' . $user_id . '|max:255',
            // 'password' => 'required|string|min:8|max:255|confirmed',
            'ein' => 'nullable|string|unique:users,ein|max:255',
            'gender' => ['nullable', Rule::in(['Male', 'Female', 'male', 'female'])],
            'dob' => 'nullable|date',
            'res_addres' => 'nullable|string|max:255',
            'perm_addres' => 'nullable|string|max:255',
            'id_type' => 'nullable|string|max:255',
            'id_no' => 'nullable|string|unique:users,id_no|max:255',
        ];
        if ($request->has('password')) {
            $rules['password'] = 'required|string|min:8|max:255|confirmed';
        }
        return Validator::make($request->all(), $rules);
    }
}