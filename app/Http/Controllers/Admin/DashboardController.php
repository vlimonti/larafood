<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Permission;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Tables;
use App\Models\Tenant;
use App\Modules\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tenant = auth()->user()->tenant;

        $totalUsers = User::where('tenant_id', $tenant->id)->count();
        $totalTables = Tables::count();
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalTenants = Tenant::count();
        $totalPlans = Plan::count();
        $totalRoles = Role::count();
        $totalProfiles = Profile::count();
        $totalPermissions = Permission::count();

        return view('admin.pages.dashboard.index', 
                    compact(
                        'totalUsers', 'totalTables', 'totalCategories', 'totalProducts', 
                        'totalTenants', 'totalPlans', 'totalRoles', 'totalProfiles', 'totalPermissions'
                    )
                );
    }
}
