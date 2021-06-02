<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Modules\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    protected $user, $role;

    public function __construct(User $user, Role $role)
    {
        $this->user    = $user;
        $this->role = $role;
        $this->middleware(['can:users']);
    }


    public function roles(Request $request, $idUser)
    {   
        if( !$user = $this->user->find($idUser) )
        {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $roles = $user->roles()->paginate();

        return view('admin.pages.users.roles.index', compact('user', 'roles'));
    }


    public function rolesAvailable(Request $request, $idUser)
    {   
        if( !$user = $this->user->find($idUser) )
        {
            return redirect()->back();
        }

        $filters = $request->except('_token');
        
        $roles = $user->rolesAvailable( $request->filter);

        return view('admin.pages.users.roles.available', compact('user', 'roles', 'filters'));
    }


    public function attachRolesUser(Request $request, $idUser)
    {   
        if( !$user = $this->user->find($idUser) )
        {
            return redirect()->back();
        }

        if( !$request->roles || count($request->roles) == 0 )
        {
            return redirect()
                        ->back()
                        ->with('info', 'A seleção de pelo menos uma função é obrigatório!');
        }

        $user->roles()->attach($request->roles);

        return redirect()->route('users.roles', $user->id);
    }


    public function  detachRoleUser($idUser, $idRole)
    {
        $user = $this->user->find($idUser);
        $role = $this->role->find($idRole);

        if(!$user || !$role) {
            return redirect()->back();
        }

        $user->roles()->detach($role);

        return redirect()->route('users.roles', $user->id);
    }

    public function users($idRole)
    {   
        $role = $this->role->find($idRole);

        if( !$role )
        {
            return redirect()->back();
        }

        $users = $role->users()->paginate();

        return view('admin.pages.roles.users.index', compact('users', 'role'));
    }
}
