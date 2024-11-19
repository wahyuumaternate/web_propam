<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('page.role', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('page.role_add', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $request->name]);
        if ($request->has('permissions')) {
            // Konversi ID ke nama permission
            $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissionNames);
        }

        notify()->success('Role berhasil ditambahkan.');
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('page.role_edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        if ($id != 1) {
            # code...
            $role = Role::findOrFail($id);
    
            $request->validate([
                'name' => 'required|unique:roles,name,' . $id,
                'permissions' => 'array',
            ]);
    
            $role->update(['name' => $request->name]);
            if ($request->has('permissions')) {
                // Konversi ID ke nama permission
                $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
                $role->syncPermissions($permissionNames);
            }
    
            notify()->success('Role berhasil diperbarui.');
            return redirect()->route('roles.index');
        }else{
            notify()->success('Role gagal diupdate.');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        if ($id != 1) {
            $role = Role::findOrFail($id);
            $role->delete();
            notify()->success('Role berhasil dihapus.');
            return redirect()->route('roles.index');
        }else{
            notify()->success('Role gagal dihapus.');
            return redirect()->back();
        }
    }
}
