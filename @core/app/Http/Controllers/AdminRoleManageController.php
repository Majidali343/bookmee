<?php

namespace App\Http\Controllers;
use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRoleManageController extends Controller
{
    const BASE_PATH ='backend.admin-role-manage.';
    public function __construct()
    {
        $this->middleware(['auth:admin']);

    }
    public function new_user(){
        $roles = Role::pluck('name','name')->all();
        return view(self::BASE_PATH.'add-new-user',compact('roles'));
    }
    public function new_user_add(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'username' => 'required|string|max:191|unique:admins',
            'email' => 'required|email|max:191',
            'role' => 'required|string|max:191',
            'image' => 'nullable|string',
            'password' => 'required|min:8|confirmed',
            'description' => 'nullable|string',
            'designation' => 'nullable|string',
        ]);
        $admin = Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'image' => $request->image,
            'password' => Hash::make($request->password),
            'description' => $request->description,
            'designation' => $request->designation,
        ]);
        $admin->assignRole($request->role);
        return redirect()->back()->with(['msg' => __('New Admin Added'),'type' =>'success' ]);
    }

    public function all_user(){
        $all_user = Admin::all()->except(Auth::id());
        return view(self::BASE_PATH.'all-user')->with(['all_user' => $all_user]);
    }
    public function user_edit($id){
        $admin = Admin::findOrFail($id);
        $roles = Role::pluck('name','name')->all();
        $adminRole = $admin->roles->pluck('name','name')->all();
        return view(self::BASE_PATH.'edit-user',compact('roles','adminRole','admin'));
    }
    public function user_update(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'role' => 'required|string|max:191',
            'image' => 'nullable|string',
             'description' =>'nullable',
            'designation' => 'nullable',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'image' => $request->image,
             'description' => $request->description,
            'designation' => $request->designation,
        ];

        $admin = Admin::findOrFail($request->user_id);
        $admin->update($data);
        DB::table('model_has_roles')->where('model_id',$admin->id)->delete();
        $admin->assignRole($request->role);

        return redirect()->back()->with(['msg' => __('Admin Details Updated'),'type' =>'success' ]);
    }
    public function new_user_delete(Request $request,$id){
        Admin::findOrFail($id)->delete();
        return redirect()->back()->with(['msg' => __('Admin Deleted'),'type' =>'danger' ]);
    }
    public function user_password_change(Request $request){
        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = Admin::findOrFail($request->ch_user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with(['msg'=> __('Password Change Success..'),'type'=> 'success']);

    }

    // ============================================== Admin Role Codes ==========================================

    public function all_admin_role(){
        $roles = Role::all();
        return view(self::BASE_PATH.'role.index',compact('roles'));
    }

    public function new_admin_role_index(){
        $permissions = Permission::all();
        return view(self::BASE_PATH.'role.create',compact('permissions'));
    }

    public function store_new_admin_role(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191|unique:roles,name'
        ]);
        $role = Role::create(['name' => $request->name,'guard_name' => 'admin']);
        $role->syncPermissions($request->permission);
        return back()->with(FlashMsg::settings_update('New Role Created'));
    }

    public function edit_admin_role($id){
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view(self::BASE_PATH.'role.edit',compact('role','permissions','rolePermissions'));
    }

    public function update_admin_role(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'permission' => 'required|array',
        ]);
        $role = Role::find($request->id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->permission);

        return back()->with(FlashMsg::settings_update('Role Updated'));
    }

    public function delete_admin_role($id){
        Role::findOrfail($id)->delete();
        return back()->with(FlashMsg::settings_delete('Role Deleted'));
    }
}
