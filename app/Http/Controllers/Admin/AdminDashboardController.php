<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;

class AdminDashboardController extends Controller
{
    public function adminDashboard()
    {
        $stats = [
            'total_services'    => Service::count(),
            'active_services'   => Service::where('is_active', true)->count(),
            'total_categories'  => ServiceCategory::count(),
            'active_categories' => ServiceCategory::where('is_active', true)->count(),
        ];

        $categories = ServiceCategory::withCount('services')
            ->orderBy('sort_order')
            ->get();

        $recentServices = Service::with('category')
            ->latest()
            ->take(6)
            ->get();

        return view('admin.index', compact('stats', 'categories', 'recentServices'));
    }
}
