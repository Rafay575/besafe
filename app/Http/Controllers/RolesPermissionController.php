<?php

namespace App\Http\Controllers;

use App\Models\IncidentAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RolesPermissionController extends Controller
{
    public function index(Request $request)
    {
        self::can(['role.index']);
        $roles = Role::all();

        if ($request->ajax()) {
            $data = [];
            $i = 0;
            foreach ($roles as $role) {
                $i++;
                $data[] = [
                    'sno' => $i,
                    'name' => $role->name,
                    'action' => view('roles.partials.action-buttons', ['role' => $role])->render()
                ];
            }

            return DataTables::of($data)->toJson();
        }
        return view('roles.index');
    }

    public function show($role_id)
    {
        self::can(['role.view']);

        $role = Role::where('id', $role_id)->first();
        $permissions = $role->permissions->pluck('name');
        $modules = $this->getSubModules();

        return view('roles.show', compact('role', 'permissions', 'modules'));
    }
    public function create()
    {
        self::can(['role.create', 'role.delete']);
        $modules = $this->getSubModules();
        return view('roles.create', compact('modules'));
    }
    public function store(Request $request)
    {
        self::can(['role.create']);

        $validator = Validator::make($request->all(), [
            'role_name' => ['string', 'required'],
            "permissions" => ['required'],
            "permissions.*" => ['string', 'required'],
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return ['error', $error];
        }
        if ($request->has('role_id')) {
            $message = "Role has been updated";
            $role = Role::where('id', $request->role_id)->first();
            // $role->name = $request->role_name;
            $role->save();
        } else {
            $message = "Role has been created";
            // $role = Role::create(['name' => $request->role_name]);
        }
        $role->syncPermissions($request->permissions);
        return ['success', $message, $request->redirect];
        // return $role->with('permissions');
    }

    public static function can($permission)
    {
        $permission = auth()->user()->can($permission);
        if (!$permission) {
            return abort(401, 'You are not authorized to perform this action');
        }
    }
    public static function canAny($permission)
    {
        $permission = auth()->user()->canany($permission);
        if (!$permission) {
            return abort(401, 'You are not authorized to perform this action');
        }
    }

    public static function canEditIncident($incident, $incident_name)
    {
        // if user is admin then he can edit any incident
        if (auth()->user()->can(["{$incident_name}.index", "{$incident_name}.edit", "{$incident_name}.delete"])) {
            return true;
        }
        // if user is not admin then we will check if he is allowed to edit or not the specific incident
        $form_name = $incident->getTable();
        $incident_id = $incident->id;
        $incidentAssigned = IncidentAssign::where('incident_id', $incident_id)
            ->where('form_name', $form_name)
            ->get();

        // if user is allowed to edit and the status of that incdient is not completed
        // below status_code < 3 is in progress, pending, etc statuses
        // after 3 is completed,closed etc
        if (@$incidentAssigned->last()->assign_to == auth()->user()->id && $incident->incident_status->status_code < 3) {
            return true;
        } else {
            return abort(401, 'You are not authorized to perform this actionss');
        }

    }
    public static function canViewIncident($incident, $incident_name)
    {
        // if user is admin then he can viw any incident
        if (auth()->user()->can(["{$incident_name}.index", "{$incident_name}.edit", "{$incident_name}.delete"])) {
            return true;
        }

        // if user is not admin then we will check if he is allowed to view or not the specific incident
        $form_name = $incident->getTable();
        $incident_id = $incident->id;
        $incidentAssigned = IncidentAssign::where('incident_id', $incident_id)
            ->where('form_name', $form_name)
            ->get();

        // incidnet assigner can view
        // incident assign to can view
        // incident initator can view
        if ($incidentAssigned->where('assign_to', auth()->user()->id)->count() > 0 or $incidentAssigned->where('assign_by', auth()->user()->id)->count() > 0 or $incident->initiated_by === auth()->user()->id) {
            return true;
        } else {
            return abort(401, 'You are not authorized to perform this action');
        }

    }

    public function destroy($role_id)
    {
        self::can(['role.delete']);

        $role = Role::where('id', $role_id)->first();
        if (count($role->users) > 0) {
            return ['Cannot delete role as users are attached to it'];
        } else {
            $role->delete();
            return ['deleted', 'Role has been deleted'];
        }
    }

    public function fetchPermissions()
    {
        return auth()->user()->getAllPermissions()->pluck('name');
    }

    public function getSubModules()
    {
        return collect([
            ['name' => 'User', 'slug' => 'user'],
            ['name' => 'Role', 'slug' => 'role'],
            ['name' => 'Permission', 'slug' => 'permission'],
            ['name' => 'Unsafe Behavior', 'slug' => 'unsafe_behavior'],
            ['name' => 'Hazard', 'slug' => 'hazard'],
            ['name' => 'Near Miss', 'slug' => 'near_miss'],
            ['name' => 'Fire and Property Damage', 'slug' => 'fire_property_damage'],
            ['name' => 'Injury', 'slug' => 'injury'],
            ['name' => 'Permit To Work', 'slug' => 'ptw'],
            ['name' => 'IE Audit Clause', 'slug' => 'ie_audit_cluase'],
            ['name' => 'IE Audit Questions', 'slug' => 'ie_audit_question'],
            ['name' => 'IE Audit Type', 'slug' => 'ie_audit_type'],
            ['name' => 'Designations', 'slug' => 'designation'],
            ['name' => 'Lines', 'slug' => 'line'],
            ['name' => 'Departments', 'slug' => 'department'],
            ['name' => 'Risk Levels', 'slug' => 'risk_level'],
            ['name' => 'Incident Status', 'slug' => 'incident_status'],
            ['name' => 'Unsafe Behavior Type', 'slug' => 'unsafe_behavior_type'],
            ['name' => 'Incident Categories', 'slug' => 'incident_category'],
            ['name' => 'Injury Categories', 'slug' => 'injury_category'],
            ['name' => 'Permit To Work Types', 'slug' => 'ptw_type'],
            ['name' => 'Permit To Work Items', 'slug' => 'ptw_item'],
            ['name' => 'Property Damaged', 'slug' => 'property_damage'],
            ['name' => 'Audit Halls', 'slug' => 'audit_hall'],
            ['name' => 'Audit Types', 'slug' => 'audit_type'],
            ['name' => 'Immediate Causes', 'slug' => 'immediate_cause'],
            ['name' => 'Basic Causes', 'slug' => 'basic_cuase'],
            ['name' => 'Root Causes', 'slug' => 'root_cause'],
            ['name' => 'Contact Types', 'slug' => 'contact_type']
        ]);
    }
}