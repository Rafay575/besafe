<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Resources\UserCollection;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Region;
use App\Models\MetaLine;
use App\Models\MetaUnit;
use App\Models\User;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $channel = "web")
    {
        $data = [];
        $data['employees'] = Employee::get();
        return view('employees.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['departments']    = Department::get();
        $data['designations']   = Designation::get();
        $data['regions']        = Region::where('sub_region_id', null)->get();
        $data['sub_regions']    = Region::where('sub_region_id', '>', 0)->get();
        $data['roles']          = Role::select('name', 'id')->get();
        return view('employees.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request, $channel = "web")
    {
        $input = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/profile'), $imageName);
            $input['image'] = $imageName;
        }
        // create user for employee login
        $input['password']  = Hash::make(12345678);
        $input['user_id']   = 0;
        $input['user_type'] = "employee";
        $user = User::create($input);

        if ($request->has('roles') && $request->roles != "") {
            $user->syncRoles($request->roles);
        }

        $input['user_id'] = $user->id;
        unset($input['password']);
        unset($input['user_type']);
        Employee::create($input);

        return redirect()->route('employees.index')->with('success', 'Employee Create Successfully!');
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
    public function edit(Request $request, $employee_id)
    {
        $data = [];
        $data['employee']       = Employee::find($employee_id);
        $data['departments']    = Department::get();
        $data['designations']   = Designation::get();
        $data['regions']        = Region::where('sub_region_id', null)->get();
        $data['sub_regions']    = Region::where('sub_region_id', '>', 0)->get();
        $data['roles']          = Role::select('name', 'id')->get();
        return view('employees.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $employee_id, $channel = "web")
    {
        $input     = $request->all();
        $employee  = Employee::find($employee_id);
        $user      = User::find($employee->user_id);
        
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/profile'), $imageName);
            $input['image'] = $imageName;
        }

        if ($request->has('roles') && $request->roles != "") {
            $user->syncRoles($request->roles);
        }

        $user->fill($input);
        $user->save();

        $employee->fill($input);
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $employee_id, $channel = "web")
    {
        $employee   = Employee::find($employee_id);
        $user       = User::find($employee->user_id);
        $user->delete();
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee has been deleted');

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