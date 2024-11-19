<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
{
    // Daftar Hak Akses (Permissions)
    $permissions = [
        'lihat_dashboard',    // Dashboard view permission
            
            'lihat_kasus',        // View case permission
            'tambah_kasus',       // Add case permission
            'edit_kasus',         // Edit case permission
            'update_status_kasus',// Update case status permission
            'hapus_kasus',        // Delete case permission
            'export_kasus',       // Export case permission
            
    
            // Kategori
            'lihat_kategori',    // View category permission
            'tambah_kategori',   // Add category permission
            'edit_kategori',     // Edit category permission
            'hapus_kategori',    // Delete category permission
    
            // Pangkat
            'lihat_pangkat',    // View rank permission
            'tambah_pangkat',   // Add rank permission
            'edit_pangkat',     // Edit rank permission
            'hapus_pangkat',    // Delete rank permission
    
            // Satker Permissions
            'lihat_satker',    // View Satker permission
            'tambah_satker',   // Add Satker permission
            'edit_satker',     // Edit Satker permission
            'hapus_satker',    // Delete Satker permission

            // Status Permissions
            'lihat_status',    // View Status permission
            'tambah_status',   // Add Status permission
            'edit_status',     // Edit Status permission
            'hapus_status',    // Delete Status permission

            // Pengaturan Permissions
            'lihat_activity_logs',    // View activity logs permission
            'export_activity_logs',   // Export activity logs permission

            // Hukuman Permissions
            'lihat_hukuman',          // View hukuman permission
            'tambah_hukuman',         // Add hukuman permission
            'edit_hukuman',           // Edit hukuman permission
            'hapus_hukuman',          // Delete hukuman permission

            // Pelanggaran Permissions
            'lihat_pelanggaran',      // View pelanggaran permission
            'tambah_pelanggaran',     // Add pelanggaran permission
            'edit_pelanggaran',       // Edit pelanggaran permission
            'hapus_pelanggaran',      // Delete pelanggaran permission

            // SKHP Permissions
            'lihat_skhp',       // View SKHP permission
            'tambah_skhp',      // Create SKHP permission
            'edit_skhp',        // Edit SKHP permission
            'hapus_skhp',       // Delete SKHP permission
            'download_skhp',    // Download SKHP permission
            'lihat_skhp_tamplate', // View SKHP template permission
            'edit_skhp_tamplate',  // Edit SKHP template permission

            // Role Permissions
            'lihat_role',       // View roles permission
            'tambah_role',      // Add role permission
            'edit_role',        // Edit role permission
            'hapus_role',       // Delete role permission
            'lihat_pengaturan',

            'lihat_grafik_kode_etik',
            'lihat_grafik_disiplin',
            'lihat_grafik_sendiri',
    ];

    // Membuat Hak Akses (Permissions)
    foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
    }

    // Membuat Peran (Roles) dan Menambahkan Hak Akses (Permissions)
    $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
    $admin->syncPermissions(
        [
            'lihat_dashboard',    // Dashboard view permission
            
            'lihat_kasus',        // View case permission
            'tambah_kasus',       // Add case permission
            'edit_kasus',         // Edit case permission
            'update_status_kasus',// Update case status permission
            'hapus_kasus',        // Delete case permission
            'export_kasus',       // Export case permission
            
    
            // Kategori
            'lihat_kategori',    // View category permission
            'tambah_kategori',   // Add category permission
            'edit_kategori',     // Edit category permission
            'hapus_kategori',    // Delete category permission
    
            // Pangkat
            'lihat_pangkat',    // View rank permission
            'tambah_pangkat',   // Add rank permission
            'edit_pangkat',     // Edit rank permission
            'hapus_pangkat',    // Delete rank permission
    
            // Satker Permissions
            'lihat_satker',    // View Satker permission
            'tambah_satker',   // Add Satker permission
            'edit_satker',     // Edit Satker permission
            'hapus_satker',    // Delete Satker permission

            // Status Permissions
            'lihat_status',    // View Status permission
            'tambah_status',   // Add Status permission
            'edit_status',     // Edit Status permission
            'hapus_status',    // Delete Status permission

            // Pengaturan Permissions
            'lihat_activity_logs',    // View activity logs permission
            'export_activity_logs',   // Export activity logs permission

            // Hukuman Permissions
            'lihat_hukuman',          // View hukuman permission
            'tambah_hukuman',         // Add hukuman permission
            'edit_hukuman',           // Edit hukuman permission
            'hapus_hukuman',          // Delete hukuman permission

            // Pelanggaran Permissions
            'lihat_pelanggaran',      // View pelanggaran permission
            'tambah_pelanggaran',     // Add pelanggaran permission
            'edit_pelanggaran',       // Edit pelanggaran permission
            'hapus_pelanggaran',      // Delete pelanggaran permission

            // SKHP Permissions
            'lihat_skhp',       // View SKHP permission
            'tambah_skhp',      // Create SKHP permission
            'edit_skhp',        // Edit SKHP permission
            'hapus_skhp',       // Delete SKHP permission
            'download_skhp',    // Download SKHP permission
            'lihat_skhp_tamplate', // View SKHP template permission
            'edit_skhp_tamplate',  // Edit SKHP template permission

            // Role Permissions
            'lihat_role',       // View roles permission
            'tambah_role',      // Add role permission
            'edit_role',        // Edit role permission
            'hapus_role',       // Delete role permission
            'lihat_pengaturan',

            'lihat_grafik_kode_etik',
            'lihat_grafik_disiplin',
            'lihat_grafik_sendiri',

        ]
    );

    $kabidKasubid = Role::firstOrCreate(['name' => 'Kabid dan Kasubid', 'guard_name' => 'web']);
    $kabidKasubid->syncPermissions(['lihat_dashboard', 'lihat_kasus']);

    $opWabprof = Role::firstOrCreate(['name' => 'Operator Wabprof', 'guard_name' => 'web']);
    $opWabprof->syncPermissions([
        'tambah_kasus',
        'lihat_grafik_kode_etik',
        'lihat_grafik_sendiri',
    ]);

    $opProvos = Role::firstOrCreate(['name' => 'Operator Provos', 'guard_name' => 'web']);
    $opProvos->syncPermissions([
        'tambah_kasus',
        'lihat_grafik_disiplin',
        'lihat_grafik_sendiri',
    ]);

    $opBidang = Role::firstOrCreate(['name' => 'Operator Bidang', 'guard_name' => 'web']);
    $opBidang->syncPermissions([
        'tambah_kasus',
        'lihat_grafik_sendiri',
    ]);

    $user = User::find(1); // Find a user by ID
    $user->assignRole('Admin'); // Assign the 'Admin' role to the user
}

}
