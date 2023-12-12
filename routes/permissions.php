<?php

use App\Models\User;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;

function createRoles(){

    // delete all old roles first then create
    Role::query()->delete();

    // $owner = Role::create([
    //     'name' => 'owner',
    //     'display_name' => 'Project Owner', // optional
    //     'description' => 'User is the owner of a given project', // optional
    // ]);
     //////////////////////////////////////////////
    // create roles and assign existing permissions

    // can permform (super-admin) roles

    Role::create([
        'name' => 'super-admin',
        'display_name' => 'Super Admin', // optional
        'is_changeable' => false,
        'description' => 'Super Admin can have all permissions and privileges to perform all operations', // optional
    ]);
    Role::create([
        'name' => 'director',
        'display_name' => 'Director', // optional
        'is_changeable' => false,
        'description' => 'Director is a Super Admin who can have all permissions and privileges to perform all operations', // optional
    ]);

    Role::create([
        'name' => 'manager',
        'display_name' => 'Manager', // optional
        'is_changeable' => false,
        'description' => 'Manager is a Super Admin who can have all permissions and privileges to perform all operations', // optional
    ]);

    $admin = Role::create([
        'name' => 'admin',
        'display_name' => 'Admin', // optional
        'is_changeable' => false,
        'description' => 'Admin can perform specific actions provided by Super Admin', // optional
    ]);

    $admin->givePermissions([
        "add-additional-document",
        "add-claim",
        "add-comment-claim",
        "add-remark",
        "approve-claim",
        "bulk-import-claims",
        "call-again",
        "call-history",
        "change-claim-status",
        "change-language",
        "change-user-status",
        "create-mada-settlement",
        "edit-target",
        "delegation",
        "edit-claim",

        "finance-report",
        "re-assign-claim",
        "reject-claim",
        "resend-sms",
        "sadad-invoice",
        "set-target",
        "sms-history",
        "view-languages"
    ]);




    // Role::create([
    //     'name' => 'supervisor',
    //     'display_name' => 'Supervisor', // optional
    //     'is_changeable' => true,
    //     'description' => 'Supervisor can perform specific actions provided by Super Admin', // optional
    // ]);

    $officer = Role::create([
        'name' => 'officer',
        'display_name' => 'Officer', // optional
        'is_changeable' => false,
        'description' => 'Officer can perform specific actions', // optional
    ]);

    $officer->givePermissions([

        "add-claim",

        "add-remark",

        "call-again",
        "call-history",

        "create-mada-settlement",
        "edit-target",
        "delegation",
        "edit-claim",

        "finance-report",
        "re-assign-claim",
        "reject-claim",
        "resend-sms",
        "sadad-invoice",

        "sms-history",

    ]);

    $supervisor = Role::create([
        'name' => 'supervisor',
        'display_name' => 'Supervisor', // optional
        'is_changeable' => false,
        'description' => 'Supervisor can perform specific actions', // optional
    ]);

    $supervisor->givePermissions([
        "add-additional-document",
        "add-claim",
        "add-comment-claim",
        "add-remark",
        "approve-claim",
        "bulk-import-claims",
        "call-again",
        "call-history",
        "change-claim-status",

        "create-mada-settlement",
        "edit-target",
        "delegation",
        "edit-claim",

        "finance-report",
        "re-assign-claim",
        "reject-claim",
        "resend-sms",
        "sadad-invoice",
        "set-target",
        "sms-history",

    ]);


    Role::create([
        'name' => 'collector',
        'display_name' => 'Collector', // optional
        'is_changeable' => false,
        'description' => 'Collector can perform specific actions', // optional
    ]);

    return ['success'=>'roles created'];

};
function createPermissions(){
    // delete all permission first then  create
    Permission::query()->delete();
/****************************
     * ***************************
     * define and creaete permissions
     * all project permissions will be
     * define and generate by this route
     *****************************
     ########## IMPORTANT for permission #############
     separate permission by groups
     and permission group can be denoted by (--name) symbole
     e.g. add-post--blog, delete-post--blog, update-post--blog

     here goup is (--blog)
     ----- benefits of groups -----
     so we can query like;

     Perission::where('name','like','%--blog%');

     with laravel
     *****************************/

    // $createPost = Permission::create([
    //     'name' => 'create-post',
    //     'display_name' => 'Create Posts', // optional
    //     'description' => 'create new blog posts', // optional
    // ]);

    // role and permissionis
    // Permission::create(['name' => 'create-role', 'display_name'=>'Add Role', 'type'=>'role']);
    // Permission::create(['name' => 'update-role', 'display_name'=>'Edit Role', 'type'=>'role']);
    // Permission::create(['name' => 'delete-role', 'display_name'=>'Delete Role', 'type'=>'role']);
    // Permission::create(['name' => 'assign-role', 'display_name'=>'Assign Role', 'type'=>'role']);
    // Permission::create(['name' => 'assign-permissions', 'display_name'=>'Assign Permissions', 'type'=>'role']);

    ////////// Claim permissions ////////////
    // Permission::create(['name' => 'create-claim', 'display_name'=>'Add Claim', 'type'=>'claim']);
    // Permission::create(['name' => 'update-claim', 'display_name'=>'Edit Claim', 'type'=>'claim']);
    // Permission::create(['name' => 'delete-claim', 'display_name'=>'Delete Claim', 'type'=>'claim']);

    // Permission::create(['name' => 'create-blog', 'display_name'=>'Add Claim', 'type'=>'blog']);
    // Permission::create(['name' => 'update-blog', 'display_name'=>'Edit Claim', 'type'=>'blog']);
    // Permission::create(['name' => 'delete-blog', 'display_name'=>'Delete Claim', 'type'=>'blog']);

    // Permission::create(['name' => 'create-type', 'display_name'=>'Add Claim', 'type'=>'video']);
    // Permission::create(['name' => 'update-type', 'display_name'=>'Edit Claim', 'type'=>'video']);
    // Permission::create(['name' => 'delete-type', 'display_name'=>'Delete Claim', 'type'=>'video']);

    Permission::create(['name' => 'view-languages', 'display_name'=>'View Languages', 'type'=>'settings']);

    // claims
    Permission::create(['name' => 'add-claim', 'display_name'=>'Add Claim', 'type'=>'claim']);
    Permission::create(['name' => 'edit-claim', 'display_name'=>'Edit Claim', 'type'=>'claim']);
    Permission::create(['name' => 'approve-claim', 'display_name'=>'Approve Claim', 'type'=>'claim']);
    Permission::create(['name' => 'reject-claim', 'display_name'=>'Reject Claim', 'type'=>'claim']);
    Permission::create(['name' => 'change-claim-status', 'display_name'=>'Change Claim Status', 'type'=>'claim']);
    Permission::create(['name' => 'add-comment-claim', 'display_name'=>'Add Comment', 'type'=>'claim']);
    Permission::create(['name' => 'call-history', 'display_name'=>'Call History', 'type'=>'claim']);
    Permission::create(['name' => 'sms-history', 'display_name'=>'SMS History', 'type'=>'claim']);
    Permission::create(['name' => 'create-mada-settlement', 'display_name'=>'Create Mada Settlement', 'type'=>'claim']);
    Permission::create(['name' => 'sadad-invoice', 'display_name'=>'Sadad Invoice', 'type'=>'claim']);
    Permission::create(['name' => 'finance-report', 'display_name'=>'Finance Report', 'type'=>'claim']);
    Permission::create(['name' => 'add-remark', 'display_name'=>'Add Remark', 'type'=>'claim']);
    Permission::create(['name' => 'add-additional-document', 'display_name'=>'Add Additional Document', 'type'=>'claim']);

    // call sms response
    // Permission::create(['name' => 'sms-status', 'display_name'=>'SMS status', 'type'=>'response']);
    Permission::create(['name' => 'resend-sms', 'display_name'=>'Resend SMS', 'type'=>'response']);
    // Permission::create(['name' => 'call-status', 'display_name'=>'Call Status', 'type'=>'response']);
    Permission::create(['name' => 'call-again', 'display_name'=>'Call Again', 'type'=>'response']);

    // users
    Permission::create(['name' => 'add-user', 'display_name'=>'Register User', 'type'=>'user']);
    Permission::create(['name' => 'edit-user', 'display_name'=>'Edit User', 'type'=>'user']);

    // Permission::create(['name' => 'add-officer', 'display_name'=>'Register Officer', 'type'=>'user']);
    // Permission::create(['name' => 'edit-officer', 'display_name'=>'Edit Officer', 'type'=>'user']);

    // Permission::create(['name' => 'add-supervisor', 'display_name'=>'Register supervisor', 'type'=>'user']);
    // Permission::create(['name' => 'edit-supervisor', 'display_name'=>'Edit supervisor', 'type'=>'user']);

    // Permission::create(['name' => 'add-admin', 'display_name'=>'Register admin', 'type'=>'user']);
    // Permission::create(['name' => 'edit-admin', 'display_name'=>'Edit admin', 'type'=>'user']);

    // Permission::create(['name' => 'add-collector', 'display_name'=>'Register collector', 'type'=>'user']);
    // Permission::create(['name' => 'edit-collector', 'display_name'=>'Edit collector', 'type'=>'user']);

    Permission::create(['name' => 'change-user-status', 'display_name'=>'Change User Status', 'type'=>'user']);

    //settings
    Permission::create(['name' => 'change-language', 'display_name'=>'Change Language', 'type'=>'setting']);

    // roles
    // Permission::create(['name' => 'add-role', 'display_name'=>'Add Role', 'type'=>'role']);
    // Permission::create(['name' => 'edit-role', 'display_name'=>'Edit Role', 'type'=>'role']);
    // Permission::create(['name' => 'assign-role', 'display_name'=>'Assign Role', 'type'=>'role']);

    // ================ from drawing - permissions =====================
    Permission::create(['name' => 're-assign-claim', 'display_name'=>'Re-assign Claim', 'type'=>'claim']);
    Permission::create(['name' => 'bulk-import-claims', 'display_name'=>'Bulk Import Claims', 'type'=>'claim']);
    Permission::create(['name' => 'delegation', 'display_name'=>'Delegation', 'type'=>'other']);

    Permission::create(['name' => 'set-target', 'display_name'=>'Set Target', 'type'=>'recovery targets']);
    Permission::create(['name' => 'edit-target', 'display_name'=>'Create Target', 'type'=>'recovery targets']);

    return ['success'=>'permissions created'];
};





function assignRoleToUser(){

    // delete all old records
    DB::table('role_user')->delete();


    $superAdmin = User::firstOrCreate(
        ['email' =>  'superadmin@taheiya.com'],
        [
                    'name' => 'Sir Abdullah',
                    'password' => bcrypt('qwert123'),
                    'status' => 1
        ],
    );
    // $user = User::firstWhere('email','superadmin@gmail.com');
    $superAdmin->addRole('super-admin');

    $manager = User::firstOrCreate(
        ['email' =>  'manager@taheiya.com'],
        [
                    'name' => 'Miss Mehwish',
                    'password' => bcrypt('qwert123'),
                    'status' => 1
        ],
    );
    $manager->addRole('manager');

    $director = User::firstOrCreate(
        ['email' =>  'director@taheiya.com'],
        [
                    'name' => 'Miss Ambreen',
                    'password' => bcrypt('qwert123'),
                    'status' => 1
        ],
    );
    $director->addRole('director');


    $admin = User::firstOrCreate(
        ['email' =>  'admin@taheiya.com'],
        [
                    'name' => 'Muhammad Amir',
                    'password' => bcrypt('qwert123'),
                    'status' => 1
        ],
    );
    $admin->addRole('admin');

    $officer = User::firstOrCreate(
        ['email' =>  'officer@taheiya.com'],
        [
                    'name' => 'Muhammad Ansar',
                    'password' => bcrypt('qwert123'),
                    'status' => 1
        ],
    );
    $officer->addRole('officer');

    $supervisor = User::firstOrCreate(
        ['email' =>  'supervisor@taheiya.com'],
        [
                    'name' => 'Mubeen Boss',
                    'password' => bcrypt('qwert123'),
                    'status' => 1
        ],
    );
    $supervisor->addRole('supervisor');

    $collector = User::firstOrCreate(
        ['email' =>  'collector@taheiya.com'],
        [
                    'name' => 'Bushra bibi',
                    'password' => bcrypt('qwert123'),
                    'status' => 1
        ],
    );
    $collector->addRole('collector');



    // admin
    // $user = User::firstWhere('email','admin@gmail.com');
    // $user->addRole('admin');


    $admins = User::where('roll',0)->get();
    foreach($admins as $admin){
        $admin->addRole('admin');
    }

    $officers = User::where('roll',1)->get();

    foreach($officers as $officer){
        $officer->addRole('officer');
    }


    $financeofficers = User::where('roll',3)->get();
    foreach($financeofficers as $financeofficer){
        $financeofficer->addRole('officer');
    }

    $collectors = User::where('roll',5)->get();
    foreach($collectors as $collector){
        $collector->addRole('collector');
    }



    return User::with('roles')->get();
};


Route::get('/migrate/roles-permissions',function(){
    createPermissions();
    createRoles();
    assignRoleToUser();

    return ["data"=>"successfully created and migrates (Roles & Permissions"];
});


Route::get('all/permissions/list', function(){
    return Permission::pluck('name');
});
