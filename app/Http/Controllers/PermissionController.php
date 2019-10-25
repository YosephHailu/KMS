<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\UserLog;
use Auth;

class PermissionController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRole(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|string',
        ]);
        Role::create(['name' => $request->name]);
        
        UserLog::create([
            'operation' => 'create',
            'action' => 'Created New Role',
            'remark' => 'Added New Role "'.$request->name.'"',
            'affected_url' => '',
            'affected_table' => 'roles',
            'user_id' => Auth::Id(),
        ]);
        return redirect('/access')->with('success', 'Role Registered');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePermission(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|string',
        ]);
        Permission::create(['name' => strtolower($request->name)]);
        
        UserLog::create([
            'operation' => 'create',
            'action' => 'Created New Permission',
            'remark' => 'Added New Permission "'.$request->name.'"',
            'affected_url' => '',
            'affected_table' => 'permissions',
            'user_id' => Auth::Id(),
        ]);
        return redirect('/access')->with('success', 'Permission Registered');
    }
    
    public function assignPermission(Request $request)
    {
        //
        $role = Role::findById($request->role_id);
        $permission = Permission::findById($request->permission_id);
        $role->givePermissionTo($permission);

        
        UserLog::create([
            'operation' => 'create',
            'action' => 'Assigned Permission To Role',
            'remark' => 'Assigned "'.$permission->name.'" To Role "'.$role->name.'"',
            'affected_url' => '',
            'affected_table' => 'role_has_permissions',
            'user_id' => Auth::Id(),
        ]);

        return response()->json(['message'=>'Success']);
    }
    
    public function removePermission(Request $request)
    {
        //
        $role = Role::findById($request->role_id);
        $permission = Permission::findById($request->permission_id);
        $role->revokePermissionTo($permission);
        
        return response()->json(['message'=>'Success']);
    }

    
    public function deleteRole($id){
        $role = Role::find($id)->delete();
        UserLog::create([
            'operation' => 'delete',
            'action' => 'Deleted Role',
            'remark' => 'Deleted Role "'.$role->name.'"',
            'affected_url' => '',
            'affected_table' => 'roles',
            'user_id' => Auth::Id(),
        ]);
        return response()->json(['message'=>'Success']);
    }
    
    public function deletePermission($id){
        $permission = Permission::find($id);
        UserLog::create([
            'operation' => 'delete',
            'action' => 'Deleted Permission',
            'remark' => 'Deleted Permission "'.$permission->name.'"',
            'affected_url' => '',
            'affected_table' => 'permissions',
            'user_id' => Auth::Id(),
        ]);
        $permission->delete();
        return response()->json(['message'=>'Success']);
    }

}
