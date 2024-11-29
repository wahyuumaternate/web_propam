<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::with('roles', 'permissions')->get();
        return view('page.pengguna', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('page.pengguna_create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign roles and permissions
        if ($request->has('roles')) {
            $roles = Role::whereIn('id', (array) $request->roles)->get(); // Konversi ke array jika perlu
            $user->syncRoles($roles);
        } else {
            $user->syncRoles([]);
        }
        

        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get(); // Ambil permission berdasarkan ID
            $user->givePermissionTo($permissions); // Berikan permissions ke user
        }

        notify()->success('User berhasil ditambahkan.');
        // ->with('success', 'User berhasil ditambahkan.');
        return redirect()->route('users.index');
      
    }

    // public function show(User $user)
    // {
    //     return view('users.show', compact('user'));
    // }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('page.pengguna_create', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        if ($user->id != 1) {
            # code...
            if ($request->has('roles')) {
                $roles = Role::whereIn('id', (array) $request->roles)->get(); // Konversi ke array jika perlu
                $user->syncRoles($roles);
            } else {
                $user->syncRoles([]);
            }
    
            if ($request->has('permissions')) {
                $permissions = Permission::whereIn('id', $request->permissions)->get(); // Ambil koleksi permission berdasarkan ID
                $user->syncPermissions($permissions); // Sinkronkan permissions ke user
            } else {
                $user->syncPermissions([]); // Hapus semua permissions jika tidak ada yang dipilih
            }
        }

        notify()->success('User berhasil diperbarui.');
        return redirect()->route('users.index');
    }
    
    public function destroy(User $user)
    {
        if ($user->id != 1) {
            $user->delete();
            notify()->success('User berhasil dihapus.');
            return redirect()->route('users.index');
        }else{
            notify()->success('User gagal dihapus.');
            return redirect()->route('users.index');
        }
    }
}
