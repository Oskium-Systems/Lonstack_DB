@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="d-lg-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="mb-1">Welcome, Admin</h2>
            </div>
            <ul class="table-top-head">
                <li>
                    <div class="input-icon-start position-relative">
                        <span class="input-icon-addon fs-16 text-gray-9">
                            <i class="ti ti-calendar"></i>
                        </span>
                        <input type="text" class="form-control" readonly value="{{ now()->format('F j, Y') }}">
                    </div>
                </li>
            </ul>
        </div>

        <div class="welcome-wrap mb-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="mb-3">
                    <h2 class="mb-1 text-white">Welcome Back, {{ Auth::user()->name }}</h2>
                    <p class="text-light">

                    </p>
                </div>
                {{-- <div class="d-flex align-items-center flex-wrap mb-1">
                    <a href="" class="btn btn-dark btn-md me-2 mb-2">

                    </a>
                    <a href="" class="btn btn-light btn-md mb-2">All Campaigns</a>
                </div> --}}
            </div>
            <div class="welcome-bg">
                <img src="{{ asset('dashboard_assets/img/bg/welcome-bg-02.svg') }}" alt="img" class="welcome-bg-01">
                <img src="{{ asset('dashboard_assets/img/bg/welcome-bg-01.svg') }}" alt="img" class="welcome-bg-03">
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-sm-6 col-12 d-flex">
                <div class="card bg-primary sale-widget flex-fill">
                    <div class="card-body d-flex align-items-center">
                        <span class="sale-icon bg-white text-primary">
                            <i class="ti ti-file-text fs-24"></i>
                        </span>
                        <div class="ms-2">
                            <p class="text-white mb-1">Total Sales</p>
                            <div class="d-inline-flex align-items-center flex-wrap gap-2">
                                <h4 class="text-white">$48,988,078</h4>
                                <span class="badge badge-soft-primary"><i class="ti ti-arrow-up me-1"></i>+22%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12 d-flex">
                <div class="card bg-secondary sale-widget flex-fill">
                    <div class="card-body d-flex align-items-center">
                        <span class="sale-icon bg-white text-secondary">
                            <i class="ti ti-repeat fs-24"></i>
                        </span>
                        <div class="ms-2">
                            <p class="text-white mb-1">Total Sales Return</p>
                            <div class="d-inline-flex align-items-center flex-wrap gap-2">
                                <h4 class="text-white">$16,478,145</h4>
                                <span class="badge badge-soft-danger"><i class="ti ti-arrow-down me-1"></i>-22%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12 d-flex">
                <div class="card bg-teal sale-widget flex-fill">
                    <div class="card-body d-flex align-items-center">
                        <span class="sale-icon bg-white text-teal">
                            <i class="ti ti-gift fs-24"></i>
                        </span>
                        <div class="ms-2">
                            <p class="text-white mb-1">Total Purchase</p>
                            <div class="d-inline-flex align-items-center flex-wrap gap-2">
                                <h4 class="text-white">$24,145,789</h4>
                                <span class="badge badge-soft-success"><i class="ti ti-arrow-up me-1"></i>+22%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
