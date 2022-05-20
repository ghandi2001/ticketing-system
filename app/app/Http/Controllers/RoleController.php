<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest\StoreRequest;
use App\Http\Requests\RoleRequest\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public static function routes()
    {
        Route::resource('role', __CLASS__);
        Route::post('/role/collective/destruction', [__CLASS__, 'collectiveDestruction'])->name('role.collective.destruction');
        Route::post('/role/edit/permission/{role}', [__CLASS__, 'editPermissionOfRole'])->name('role.edit.permissions');
    }

    public function index()
    {
        checkAccess('see roles');
        return view('roles.index')->with('roles', Role::all());
    }

    public function create()
    {
        checkAccess('add role');
        return view('roles.create');
    }

    public function store(StoreRequest $request)
    {
        checkAccess('add role');
        if (Role::create(['name' => $request->name]))
            return redirect()->route('role.index')->with('message', 'insert successfully.');
        return redirect()->back()->with('message', 'insert not successfully.');
    }

    public function show(Role $role)
    {
        checkAccess('show rolePermissions');
        return view('roles.permissions')->with([
            'role' => $role,
            'permissions' => Permission::all()
        ]);
    }

    public function edit(Role $role)
    {
        checkAccess('edit role');
        return view('role.create')->with('role', $role);
    }

    public function update(Role $role, UpdateRequest $request)
    {
        checkAccess('edit role');
        $role->update(['name' => $request->name]);
        return redirect()->route('role.index')->with('message', 'update successfully.');
    }

    public function destroy(Role $role)
    {
        checkAccess('delete role');
        if ($role->name == 'superAdmin' || $role->id == 1) {
            return redirect()->back()->with('message', 'can\'t delete this role.');
        }
        if ($role->delete())
            redirect()->back()->with('message', 'delete successfully.');
        return redirect()->back()->with('message', 'delete not successfully.');
    }

    public function collectiveDestruction(Request $request)
    {
        checkAccess('delete role');
        if (in_array(1  , $request->input('data'))) {
            return redirect()->back()->with('message', 'can\'t delete this role.');
        }
        Role::whereIn('id', $request->input('data'))->delete();
        return response()->json('mission successful.', '200');
    }

    public function editPermissionOfRole(Role $role, Request $request)
    {
        checkAccess('edit rolePermissions');
        if ($role->name == 'superAdmin' || $role->id == 1) {
            return response()->json('can\'t edit this', '403');
        }
        if ($role->hasPermissionTo($request->input('data'))) {
            $role->revokePermissionTo($request->input('data'));
            return response()->json('mission successful.', '200');
        }
        $role->givePermissionTo($request->input('data'));
        return response()->json('mission successful.', '200');
    }

}
