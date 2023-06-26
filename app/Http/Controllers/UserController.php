<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Resources\UserCollection;
use App\Models\MetaDepartment;
use App\Models\MetaDesignation;
use App\Models\MetaLine;
use App\Models\MetaUnit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $channel = "web")
    {

        $users = User::query();
        if ($channel == "api") {
            return $users;
        }
        if ($request->ajax()) {
            $data = [];
            $i = 0;
            foreach ($users->get() as $user) {
                $i++;
                $data[] = [
                    'sno' => $i,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'status' => $user->status ? 'Active' : 'InActive',
                    'role' => $user->roles->pluck('name'),
                    'action' => view('users.partials.action-buttons', ['user' => $user])->render()
                ];
            }

            return DataTables::of($data)->toJson();
        }
        return view('users.index', compact('users'));
    }

    public function departmentUsers(Request $request)
    {
        $users = User::where('meta_department_id', $request->department_id)->get();
        return $users;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = MetaUnit::select('unit_title', 'id')->get();
        $departments = MetaDepartment::select('department_title', 'id')->get();
        $designations = MetaDesignation::select('designation_title', 'id')->get();
        $lines = MetaLine::select('line_title', 'id')->get();
        $roles = Role::select('name', 'id')->get();
        return view('users.create', compact('units', 'departments', 'designations', 'lines', 'roles'));
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
        return ['success', 'User has been stored', $request->redirect];
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $user_id)
    {
        $user = User::where('id', $user_id)->firstOrfail();
        $units = MetaUnit::select('unit_title', 'id')->get();
        $departments = MetaDepartment::select('department_title', 'id')->get();
        $designations = MetaDesignation::select('designation_title', 'id')->get();
        $lines = MetaLine::select('line_title', 'id')->get();
        $roles = Role::select('name', 'id')->get();
        return view('users.edit', compact('user', 'units', 'departments', 'lines', 'roles', 'designations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $user_id, $channel = "web")
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
        // $user->email = $request->email;
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
        return ['success', 'User has been updated', $request->redirect];
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
            return ['User not found'];
        }

        if ($user_id == auth()->user()->id) {
            return ['Cannot delete yourself'];
        }

        // deleting the user
        if ($user->delete()) {
            if ($channel === 'api') {
                return ApiResponseController::success('User has been delete');
            } else {
                return ['deleted', 'User has been deleted'];
            }
        } else {
            if ($channel === 'api') {
                return ApiResponseController::error('Could not delete the user.');
            } else {
                return ['Could not delete the user'];
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
        if ($request->has('password') && $request->_method != "PUT") {
            $rules['password'] = 'required|string|min:8|max:255|confirmed';
        }
        if ($request->_method == "PUT" && $request->password != "") {
            $rules['password'] = 'required|string|min:8|max:255|confirmed';
        }
        return Validator::make($request->all(), $rules);
    }

    public function profileCreate()
    {
        return view('users.profile');
    }

    public function profileStore(Request $request)
    {
        return $this->update($request, auth()->user()->id, 'web');
    }

}