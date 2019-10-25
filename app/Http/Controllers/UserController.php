<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use \Carbon\Carbon;
use Auth;
use App\UserLog;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasAnyPermission('all')) {
            return view('user.users');
        } else {
            return redirect()->back()->with('error', 'unauthorized Action');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create', User::class);
        return view('user.manage_user')->with('new', true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'directorate_id' => 'required|integer',
            'job_title' => 'required|string',
            'email' => 'required|string|unique:users',
            'username' => 'required|string|unique:users',
            'phone' => 'required|string',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'access_level_id' => 'required|integer',
            'user_status_id' => 'required|integer'
        ]);
        $this->authorize('create', User::class);

        if ($request->hasFile('picture')) {
            $fileNameWithExt = $request->file('picture')->getClientOriginalName();
            //Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //File extension
            $extension = $request->file('picture')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('picture')->storeAs('public/user_photos', $fileNameToStore);
        } else {
            $fileNameToStore = 'nofile.jpg';
        }

        //
        $request->request->add(['photo' => $fileNameToStore]);
        $request->request->add(['password' => Hash::make($request->password)]);
        $user = User::create($request->all());

        UserLog::create([
            'operation' => 'create',
            'action' => 'Register New User',
            'remark' => 'Registered User "' . $user->name . '"',
            'affected_url' => 'users/' . $user->id,
            'affected_table' => 'users',
            'user_id' => Auth::Id(),
        ]);
        return redirect('users/' . $user->id)->with('success', 'User Registered');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $this->authorize('view', $user);

        return view('user.user_detail')->with('user', $user);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(User $user)
    {
        //
        $this->authorize('resetPassword', $user);

        return view('user.reset_password')->with('user', $user);
    }

    /**
     * Update the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(User $user, Request $request)
    {
        //
        $this->authorize('resetPassword', $user);

        $this->validate($request, [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if(!Auth::user()->hasAnyPermission('all')){
            
            $this->validate($request, [
                'old_password' => 'required|string',
            ]);

            if (!Hash::check($request->old_password, Auth::user()->password))
                return redirect()->back()->with('error', "Old Password Incorrect");
        }
        $user->password = Hash::make($request->password);
        $user->save();

        UserLog::create([
            'operation' => 'update',
            'action' => 'Update Password',
            'remark' => 'Updated Password For User  "' . $user->name . '"',
            'affected_url' => 'users/' . $user->id,
            'affected_table' => 'users',
            'date' => Carbon::now(),
            'user_id' => Auth::Id(),
        ]);

        return redirect('users/' . $user->id)->with('success', 'Password Changed Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function userKnowledge(User $user)
    {
        //
        return $user->KnowledgeProduct->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $this->authorize('update', $user);
        return view('user.manage_user')->with('new', false)->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'job_title' => 'required|string',
            'email' => 'required|string',
            'username' => 'required|string',
            'phone' => 'required|string',
            'access_level_id' => 'required|integer',
            'user_status_id' => 'required|integer'
        ]);
        //
        $this->authorize('update', $user);

        if ($request->hasFile('picture')) {
            $fileNameWithExt = $request->file('picture')->getClientOriginalName();
            //Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //File extension
            $extension = $request->file('picture')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('picture')->storeAs('public/user_photos', $fileNameToStore);
        } else {
            $fileNameToStore = $user->photo;
        }
        $request->request->add(['photo' => $fileNameToStore]);
        $user->update($request->all());

        UserLog::create([
            'operation' => 'Update',
            'action' => 'Updated User Profile',
            'remark' => 'Updated Profile Of "' . $user->name . '"',
            'affected_url' => 'users/' . $user->id,
            'affected_table' => 'users',
            'user_id' => Auth::Id(),
        ]);
        return redirect('users/' . $user->id)->with('success', 'User Registered');                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $this->authorize('delete', $user);

        UserLog::create([
            'operation' => 'Delete',
            'action' => 'Deleted User Information',
            'remark' => 'Removed User "' . $user->name . '" Information',
            'affected_url' => 'users/' . $user->id,
            'affected_table' => 'users',
            'user_id' => Auth::Id(),
        ]);
        if($user->knowledgeProduct->count() > 0)
            return response()->json('Error can not delete');
            
        $user->delete();

        return response()->json('Success');
    }

    public function assignRole(Request $request, User $user)
    {
        //
        $this->authorize('assignRole', $user);

        $role = Role::findById($request->role_id);
        $user->assignRole($role->name);


        UserLog::create([
            'operation' => 'create',
            'action' => 'Assign Role To User',
            'remark' => 'Assigned "' . $role->name . '" Role To User "' . $user->name . '"',
            'affected_url' => 'users/' . $user->id,
            'affected_table' => 'model_has_roles',
            'user_id' => Auth::Id(),
        ]);

        return redirect('users/' . $user->id)->with('success', 'Role Assigned');
    }

    public function revokeRole(Request $request, User $user)
    {
        //
        $this->authorize('revokeRole', $user);

        $user->removeRole($request->role);
        
        UserLog::create([
            'operation' => 'delete',
            'action' => 'Revoke Role From User',
            'remark' => 'Assigned "' . $request->role . '" Role To User "' . $user->name . '"',
            'affected_url' => 'users/' . $user->id,
            'affected_table' => 'users',
            'user_id' => Auth::Id(),
        ]);
        return response()->json(['message' => 'Success']);
    }

    public function tableData()
    {
        $users = User::All()->filter(function ($user) {
            return !$user->hasAnyPermission('all');
        });

        if (Auth::user()->hasAnyPermission('all')) {
            $users = User::All();
        }

        return Datatables::of($users)->addColumn('directorate', function ($user) {
            return $user->directorate->name;
        })->addColumn('user_status', function ($user) {
            return $user->userStatus->status;
        })->addColumn('edit', function ($user) {
            $url = url('users/' . $user->id . '/edit');
            return '<a href="' . $url . '"><i class="icon-pen6"></i></a>';
        })->addColumn('delete', function ($user) {
            return '<a href="" onclick="deleteUser(' . $user->id . ')" class="text-danger"><i class="icon-trash"></i></a>';
        })->addColumn('open', function ($user) {
            return '<a href="' . url('users/' . $user->id) . '"><i class="icon-new-tab"></i> </a>';
        })->addColumn('profile', function ($user) {
            return '<img class=" rounded-circle" src="' . asset('storage\user_photos\\' . $user->photo) . '" height="60" alt="">';
        })->rawColumns(['profile', 'open', 'edit', 'delete'])->make(true);
    }

    public function userActivityJson(User $user)
    {
        return $user->userLog->toJson();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function directorateUser()
    {
        //
        $users = Auth::user()->directorate->user;
        return view('user.directorate_users')->with('users', $users);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userActivity(User $user)
    {
        //
        $this->authorize('view', $user);

        return view('user.user_activity')->with('userLogs', $user->userLog()->orderByDesc('created_at')->get())->with('user', $user);
    }
}
