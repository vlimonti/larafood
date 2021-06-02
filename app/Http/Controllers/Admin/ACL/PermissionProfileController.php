<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile    = $profile;
        $this->permission = $permission;
        $this->middleware(['can:profiles']);
    }


    public function permissions(Request $request, $idProfile)
    {   
        if( !$profile = $this->profile->find($idProfile) )
        {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.index', compact('profile', 'permissions'));
    }


    public function permissionsAvailable(Request $request, $idProfile)
    {   
        if( !$profile = $this->profile->find($idProfile) )
        {
            return redirect()->back();
        }

        $filters = $request->except('_token');
        
        $permissions = $profile->permissionsAvailable( $request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions', 'filters'));
    }


    public function attachPermissionsProfile(Request $request, $idProfile)
    {   
        if( !$profile = $this->profile->find($idProfile) )
        {
            return redirect()->back();
        }

        if( !$request->permissions || count($request->permissions) == 0 )
        {
            return redirect()
                        ->back()
                        ->with('info', 'A seleção de pelo menos uma permissão é obrigatório!');
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions', $profile->id);
    }


    public function  detachPermissionProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if(!$profile || !$permission) {
            return redirect()->back();
        }

        $profile->permissions()->detach($permission);

        return redirect()->route('profiles.permissions', $profile->id);
    }


    public function profiles($idPermission)
    {   
        $permission = $this->permission->find($idPermission);

        if( !$permission )
        {
            return redirect()->back();
        }

        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.index', compact('profiles', 'permission'));
    }


    public function profilesAvailable(Request $request, $idPermission)
    {
        if( !$permission = $this->permission->find($idPermission) )
        {
            return redirect()->back();
        }

        $filters = $request->except('_token');
        
        $profiles = $permission->profilesAvailable( $request->filter);

        return view('admin.pages.permissions.profiles.available', compact('profiles', 'permission', 'filters'));
    }

    public function attachProfilesPermission(Request $request, $idPermission)
    {   
        if( !$permission = $this->permission->find($idPermission) )
        {
            return redirect()->back();
        }

        if( !$request->profiles || count($request->profiles) == 0 )
        {
            return redirect()
                        ->back()
                        ->with('info', 'A seleção de pelo menos um perfil é obrigatório!');
        }

        $permission->profiles()->attach($request->profiles);

        return redirect()->route('permissions.profiles', $permission->id);
    }


    public function  detachProfilePermission($idPermission, $idProfile)
    {
        $permission = $this->permission->find($idPermission);
        $profile = $this->profile->find($idProfile);

        if(!$profile || !$permission) {
            return redirect()->back();
        }

        $permission->profiles()->detach($profile);

        return redirect()->route('permissions.profiles', $permission->id);
    }
}
