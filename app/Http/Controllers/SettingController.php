<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Setting;
use App\Models\Permission;
use Illuminate\Http\Request;


class SettingController extends Controller
{
    public function initSettingsToDatabase(){


        // languages (localization )
        $setting = Setting::create([
            'name'=>'languages',
            'value'=>[
                [
                    'language'=>'English',
                    'code'=>'en',
                    'direction'=>'ltr',
                    'is_active'=>false
                ],
                [
                    'language'=>'Arabic',
                    'code'=>'ar',
                    'direction'=>'rtl',
                    'is_active'=>true
                ],
                [
                    'language'=>'Urdu',
                    'code'=>'ur',
                    'direction'=>'rtl',
                    'is_active'=>false
                ]
            ]
        ]);

        // dd($setting);


        return $setting;

    }
    public function index(){
        return view('admin.settings.settings');
    }
    public function roles(){
        // Role::all()->pluck('name');
        // Permission::all()->pluck('name');
        $roles = Role::withCount('permissions', 'users')->get();

        return view('admin.settings.roles', ['roles'=>$roles]);
    }
    public function permissions($role_id){

        $allPermissions = Permission::all();

        // user has current permissions
        $roleWithPermissions = Role::with('permissions')->where('id',$role_id)->first();
        $userPermissions = $roleWithPermissions->permissions;

        $finalTransformPermissions = [];

        foreach($allPermissions as $keyPermission => $valuePermission){

            // check from all permission using user available permisson as ture
            $hasPermission = $userPermissions->firstWhere('id', $valuePermission->id);
            if($hasPermission){
                $allPermissions[$keyPermission]->hasPermission = true;
            }

            // get permission type e.g. update-post--blog [blog is $permissionType]
            // $permissionType = explode('--', $valuePermission->name)[1];
            $permissionType = $valuePermission->type;

            /**
             * $finalTransformPermissions array data schema e.g.
             *
             * [
             *     'blog'=>[
             *          [post1], [post2], [post3]
             *     ]
             *     'videos'=>[
             *          [video1], [video2], [video3]
             *     ]
             * ]
             */
            if(! @$finalTransformPermissions[$permissionType]){
                $finalTransformPermissions[$permissionType] = [];
            }

            $finalTransformPermissions[$permissionType][] =  $valuePermission;


        }

        return view('admin.settings.permissions', [
            'permissionTypes'=>$finalTransformPermissions,
            'role' => $roleWithPermissions
        ]);
    }

    public function storePermissions(Request $request){
        $request->validate([
            'role_id' => 'required',
            'permissions_type'=>'required'
        ]);

        // get role all current permissions from database
        $roleWithPermissions = Role::with('permissions')->where('id',$request->role_id)->first();
        $userPermissions = $roleWithPermissions->permissions;
        // filter role current permissions according to type e.g. type [--blog] of permission [edit-post--blog]
        $userTypePermissions = $userPermissions->filter(
            function ($permission) use($request) {
                return $permission->type == $request->permissions_type;
            }
        );

        // remove all permissions from role according to type [--blog]
        $role = Role::firstWhere('id',$request->role_id);
        if($userTypePermissions){
            $role->removePermissions($userTypePermissions);
        }
        // assign permissions to role from frontend request
        if($request->permissions){
            $role->givePermissions($request->permissions);
        }

        return back()->with('success',"{$request->permissions_type} permissions changed.");

    }
    public function createRole(Request  $request){
        $request->validate([
            'name'=>'required|unique:roles,name|min:3|max:50',
            'display_name'=>'required|min:3|max:50'
        ],
        [
            'name.unique' => 'Role Name/Code already exist, please try other one'
        ]);

        if(str_contains($request->name, ' ')){
            return back()
                ->withErrors(['Space not allowed in (Role Name/Code)'])
                ->with('error','Space not allowed in (Role Name/Code)');
        }

        Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'is_changeable' => true,
            'description' => $request->description
        ]);

        return back()->with('success',"{$request->display_name} Role added.");

    }
    public function updateRole(Request  $request){
        $request->validate([
            'name'=>'required|unique:roles,name|min:3|max:50',
            'display_name'=>'required|min:3|max:50',
            'role_id' => 'required'
        ],
        [
            'name.unique' => 'Role Name/Code already exist, please try other one'
        ]
    );

        if(str_contains($request->name, ' ')){
            return back()
                ->withErrors(['Space not allowed in (Role Name/Code)'])
                ->with('error','Space not allowed in (Role Name/Code)');
        }

        $role = Role::firstWhere('id', $request->role_id);
        if(in_array($role->name, ['super-admin','director','manager', 'admin', 'officer', 'supervisor', 'collector'])){
            return back()
                ->with('error',"{$role->display_name} role is not updatealbe.")
                ->withErrors(["{$role->display_name} role is not updatealbe."]);
        }

        $isUpdated = Role::where('id', $request->role_id)->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);

        if(! $isUpdated){
            return back()->with('error',"something went wrong while updating role.");
        }

        return back()->with('success',"{$request->display_name} role added.");

    }

    public function deleteRole(Role $role){

        if(in_array($role->name, ['super-admin','director','manager', 'admin', 'officer', 'supervisor', 'collector'])){
            return back()
                ->with('error',"{$role->display_name} role is not deleteable.")
                ->withErrors(["{$role->display_name} role is not deleteable."]);
        }

        $role->delete();

        return back()->with('success',"{$role->display_name} role deleted");
    }

    public function languages(){
        $languages = settings('languages');

        return view('admin.settings.languages', compact('languages'));
    }
    public function setLanguage(Request $request){
        settings()->setLanguage($request->language_code);

        return back()->with('success','Language has been changed.');
    }
}
