@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Profile</h4>
            <h6>Admin Profile</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Profile</h4>
        </div>
        <div class="card-body profile-body">
            <!-- Profile Form -->
            <form id="profileForm" action="{{ route('admin.profile.update') }}" method="POST"
                enctype="multipart/form-data" data-submit-spinner
                    data-spinner-text="Processing...">
                @csrf
                @method('PATCH')
                <h5 class="mb-2"><i class="ti ti-user text-primary me-1"></i>Basic Information</h5>
                <div class="profile-pic-upload image-field">
                    <div class="profile-pic p-2">
                        <img src="{{ asset(auth()->user()->profile?->profile_image ? 'storage/' . auth()->user()->profile->profile_image : 'dashboard_assets/img/user-icon.jpg') }}"
                            class="object-fit-cover h-100 rounded-1" alt="user" id="profileImagePreview">
                    </div>
                    <div class="mb-3">
                        <div class="image-upload mb-0 d-inline-flex">
                            <input type="file" name="profile_image" id="profileImageInput"
                                accept="image/jpeg,image/png">
                            <div class="btn btn-primary fs-13">Change Image</div>
                        </div>
                        <p class="mt-2">Accepted File format JPG, PNG</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Full Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', auth()->user()->name) }}" required>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Email<span class="text-danger ms-1">*</span></label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', auth()->user()->email) }}" placeholder="" required>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', auth()->user()->profile?->phone) }}" placeholder="Phone Number">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Address"
                                value="{{ old('address', auth()->user()->profile?->address) }}">
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">

                        <button type="submit" class="btn btn-secondary shadow-none">Save Changes</button>
                    </div>
                </div>
            </form>

            <!-- Password Change Form -->
            <form id="passwordForm" action="{{ route('admin.profile.password') }}" method="POST" class="mt-4" data-submit-spinner
                    data-spinner-text="Processing...">
                @csrf
                @method('PATCH')
                <h5 class="mb-2"><i class="ti ti-lock text-primary me-1"></i>Change Password</h5>
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Current Password<span class="text-danger ms-1">*</span></label>
                            <div class="pass-group">
                                <input type="password" name="current_password" class="pass-input form-control" required>
                                <i class="ti ti-eye-off toggle-password"></i>
                            </div>
                            @error('current_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">New Password<span class="text-danger ms-1">*</span></label>
                            <div class="pass-group">
                                <input type="password" name="new_password" class="pass-input form-control" required>
                                <i class="ti ti-eye-off toggle-password"></i>
                            </div>
                            @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Confirm Password<span class="text-danger ms-1">*</span></label>
                            <div class="pass-group">
                                <input type="password" name="new_password_confirmation"
                                    class="pass-input form-control" required>
                                <i class="ti ti-eye-off toggle-password"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">

                        <button type="submit" class="btn btn-secondary shadow-none">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Image preview functionality
    document.getElementById('profileImageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImagePreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Password toggle functionality
    document.querySelectorAll('.toggle-password').forEach(item => {
        item.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.classList.toggle('ti-eye-off');
            this.classList.toggle('ti-eye');
        });
    });
</script>
@endpush
@endsection
