<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')
            ->orderBy('sort_order')
            ->paginate(20);

        $categories = ServiceCategory::active()->get();

        return view('admin.services.index', compact('services', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'name'                => 'required|string|max:150',
            'short_description'   => 'nullable|string|max:255',
            'badge'               => 'nullable|in:hot,new,none',
            'sort_order'          => 'nullable|integer|min:0',
        ]);

        $data['slug']      = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['badge']     = $data['badge'] ?? 'none';

        Service::create($data);

        return back()->with('success', 'Service created successfully.');
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'name'                => 'required|string|max:150',
            'short_description'   => 'nullable|string|max:255',
            'badge'               => 'nullable|in:hot,new,none',
            'sort_order'          => 'nullable|integer|min:0',
        ]);

        $data['slug']      = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active', false);
        $data['badge']     = $data['badge'] ?? 'none';

        $service->update($data);

        return back()->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return back()->with('success', 'Service deleted.');
    }
}
