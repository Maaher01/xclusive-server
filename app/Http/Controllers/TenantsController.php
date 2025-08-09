<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TenantsController extends Controller
{
    public function migrateTenantDatabase(string $databaseName)
    {
        Config::set('database.connections.tenant', [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => $databaseName,
            'username' => $request->db_username ?? env('DB_USERNAME', 'root'),
            'password' => $request->db_password ?? env('DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ]);

        Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path' => '/database/migrations/tenant',
            '--force' => true,
        ]);
    }

    public function onboardTenant(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'subdomain' => 'required|string',
                'db_username' => 'nullable|string',
                'db_password' => 'nullable|string'
            ]);

            $databaseName = 'tenant_' . Str::slug($request->name, '_');

            $sql = "CREATE DATABASE IF NOT EXISTS `$databaseName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";

            DB::statement($sql);

            Tenant::create([
                'name' => $request->name,
                'subdomain' => $request->subdomain,
                'database_name' => $databaseName,
                'db_username' => $request->db_username,
                'db_password' =>  $request->db_password,
            ]);

            $this->migrateTenantDatabase($databaseName, $request->db_username, $request->db_password);

            return response()->json(['message' => 'Tenant and its database created successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
