@extends('layouts.admin')
@section('content')
<div class="content">

    {{-- Welcome Banner --}}
    <div class="welcome-wrap mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div class="mb-3">
                <h2 class="mb-1 text-white">Welcome Back, {{ Auth::user()->name }}</h2>
                <p class="text-light opacity-75">{{ now()->format('l, F j, Y') }}</p>
            </div>
        </div>
        <div class="welcome-bg">
            <img src="{{ asset('dashboard_assets/img/bg/welcome-bg-02.svg') }}" alt="img" class="welcome-bg-01">
            <img src="{{ asset('dashboard_assets/img/bg/welcome-bg-01.svg') }}" alt="img" class="welcome-bg-03">
        </div>
    </div>

    {{-- CMS Stats Row --}}
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-primary sale-widget flex-fill">
                <div class="card-body d-flex align-items-center">
                    <span class="sale-icon bg-white text-primary">
                        <i class="ti ti-stack fs-24"></i>
                    </span>
                    <div class="ms-2">
                        <p class="text-white mb-1">Total Services</p>
                        <div class="d-inline-flex align-items-center flex-wrap gap-2">
                            <h4 class="text-white">{{ $stats['total_services'] }}</h4>
                            <span class="badge badge-soft-primary">
                                {{ $stats['active_services'] }} active
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-secondary sale-widget flex-fill">
                <div class="card-body d-flex align-items-center">
                    <span class="sale-icon bg-white text-secondary">
                        <i class="ti ti-category fs-24"></i>
                    </span>
                    <div class="ms-2">
                        <p class="text-white mb-1">Service Categories</p>
                        <div class="d-inline-flex align-items-center flex-wrap gap-2">
                            <h4 class="text-white">{{ $stats['total_categories'] }}</h4>
                            <span class="badge badge-soft-primary">
                                {{ $stats['active_categories'] }} active
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-teal sale-widget flex-fill">
                <div class="card-body d-flex align-items-center">
                    <span class="sale-icon bg-white text-teal">
                        <i class="ti ti-article fs-24"></i>
                    </span>
                    <div class="ms-2">
                        <p class="text-white mb-1">Blog Posts</p>
                        <div class="d-inline-flex align-items-center flex-wrap gap-2">
                            <h4 class="text-white">—</h4>
                            <span class="badge badge-soft-success">coming soon</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-info sale-widget flex-fill">
                <div class="card-body d-flex align-items-center">
                    <span class="sale-icon bg-white text-info">
                        <i class="ti ti-mail-opened fs-24"></i>
                    </span>
                    <div class="ms-2">
                        <p class="text-white mb-1">Enquiries</p>
                        <div class="d-inline-flex align-items-center flex-wrap gap-2">
                            <h4 class="text-white">—</h4>
                            <span class="badge badge-soft-success">coming soon</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Overview Row --}}
    <div class="row">

        {{-- Services by Category --}}
        <div class="col-xl-6 col-sm-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-inline-flex align-items-center">
                        <span class="title-icon bg-soft-primary fs-16 me-2">
                            <i class="ti ti-stack"></i>
                        </span>
                        <h5 class="card-title mb-0">Services by Category</h5>
                    </div>
                    <a href="{{ route('admin.services.categories.index') }}"
                       class="fs-13 fw-medium text-decoration-underline">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Category</th>
                                    <th>Icon</th>
                                    <th class="text-center">Services</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                <tr>
                                    <td><strong>{{ $category->name }}</strong></td>
                                    <td>
                                        @if($category->icon)
                                            <i class="{{ $category->icon }} fs-18"></i>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary">{{ $category->services_count }}</span>
                                    </td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge badge-success badge-xs d-inline-flex align-items-center">
                                                <i class="ti ti-point-filled me-1"></i>Active
                                            </span>
                                        @else
                                            <span class="badge badge-danger badge-xs d-inline-flex align-items-center">
                                                <i class="ti ti-point-filled me-1"></i>Inactive
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No categories yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recently Added Services --}}
        <div class="col-xl-6 col-sm-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-inline-flex align-items-center">
                        <span class="title-icon bg-soft-info fs-16 me-2">
                            <i class="ti ti-clock"></i>
                        </span>
                        <h5 class="card-title mb-0">Recently Added Services</h5>
                    </div>
                    <a href="{{ route('admin.services.index') }}"
                       class="fs-13 fw-medium text-decoration-underline">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Service</th>
                                    <th>Category</th>
                                    <th>Badge</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentServices as $service)
                                <tr>
                                    <td>
                                        <strong>{{ $service->name }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ $service->category->name }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($service->badge === 'hot')
                                            <span class="badge bg-danger">HOT 🔥</span>
                                        @elseif($service->badge === 'new')
                                            <span class="badge bg-success">NEW</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($service->is_active)
                                            <span class="badge badge-success badge-xs d-inline-flex align-items-center">
                                                <i class="ti ti-point-filled me-1"></i>Active
                                            </span>
                                        @else
                                            <span class="badge badge-danger badge-xs d-inline-flex align-items-center">
                                                <i class="ti ti-point-filled me-1"></i>Inactive
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No services yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Quick Links --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-inline-flex align-items-center">
                        <span class="title-icon bg-soft-success fs-16 me-2">
                            <i class="ti ti-bolt"></i>
                        </span>
                        <h5 class="card-title mb-0">Quick Actions</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.services.categories.index') }}" class="btn btn-outline-primary">
                            <i class="ti ti-category me-1"></i> Manage Categories
                        </a>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
                            <i class="ti ti-stack me-1"></i> Manage Services
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-info">
                            <i class="ti ti-settings me-1"></i> General Settings
                        </a>
                        <a href="{{ route('admin.profile.index') }}" class="btn btn-outline-dark">
                            <i class="ti ti-user-circle me-1"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
