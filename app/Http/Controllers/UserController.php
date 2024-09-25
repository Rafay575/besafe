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
use App\Http\Requests\StoreUserRequest;
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
        $data = [];
        $data['users'] = User::where('user_type','user')->get();
        return view('users.index', $data);
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
        $data = [];
        $data['departments']    = Department::get();
        $data['designations']   = Designation::get();
        $data['regions']        = Region::where('sub_region_id', null)->get();
        $data['sub_regions']    = Region::where('sub_region_id', '>', 0)->get();
        $data['roles']          = Role::select('name', 'id')->get();
        return view('users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request, $channel = "web")
    {
        $input = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/profile'), $imageName);
            $input['image'] = $imageName;
        }

        $input['password']  = Hash::make(12345678);
        $input['user_type'] = "user";

        $user = User::create($input);
        
        if ($request->has('roles') && $request->roles != "") {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index')->with('success', 'User Registered Successfully!');
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
        $data = [];
        $data['user']           = User::find($user_id);
        $data['departments']    = Department::get();
        $data['designations']   = Designation::get();
        $data['regions']        = Region::where('sub_region_id', null)->get();
        $data['sub_regions']    = Region::where('sub_region_id', '>', 0)->get();
        $data['roles']          = Role::select('name', 'id')->get();
        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $user_id, $channel = "web")
    {
        $input = $request->all();
        $user  = User::find($user_id);
        
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

        return redirect()->route('users.index')->with('success', 'User has been updated');
    }
    public function profife_view($user_id){
        $data = [];
        $user = User::find($user_id);
        $data['user']           =  $user;
        $data['departments']    = Department::where('id', $user->department_id)->first();
        $data['designations']   =  Designation::where('id', $user->designation_id)->first();
        $data['regions']        = Region::where('id', $user->region_id)->first();
        $data['sub_regions']    = Region::where('id', '>', 0)->get();
        $data['roles']          = Role::select('name', 'id')->get();
        return view('users.view', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user_id, $channel = "web")
    {
        $user = User::find($user_id);

        if ($user->delete()) {
            return redirect()->route('users.index')->with('success', 'User has been deleted');
        } else {
            return redirect()->route('users.index')->with('error', 'Could not delete the user.');
        }
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