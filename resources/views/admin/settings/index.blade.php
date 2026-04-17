@extends('layouts.admin')

@section('content')
    <div class="content">

        <div class="page-header">
            <div>
                <h4 class="fw-bold mb-1">General Settings</h4>
                <h6 class="text-muted">Manage your website configuration</h6>
            </div>
        </div>



        <form action="{{ route('admin.settings.update') }}" method="POST" data-submit-spinner
                    data-spinner-text="Processing...">
            @csrf

            <div class="accordions-items-seperate" id="settingsAccordion">

                {{-- Company Info --}}
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header">
                        <div class="accordion-button bg-white" data-bs-toggle="collapse" data-bs-target="#companyInfo">
                            <h5>🏢 Company Information</h5>
                        </div>
                    </h2>
                    <div id="companyInfo" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" name="company_name"
                                        class="form-control @error('company_name') is-invalid @enderror"
                                        value="{{ old('company_name', $settings->company_name) }}" required>
                                    @error('company_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Company Email</label>
                                    <input type="email" name="company_email"
                                        class="form-control @error('company_email') is-invalid @enderror"
                                        value="{{ old('company_email', $settings->company_email) }}"
                                        placeholder="info@lonstack.com">
                                    @error('company_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Support Email</label>
                                    <input type="email" name="support_email"
                                        class="form-control @error('support_email') is-invalid @enderror"
                                        value="{{ old('support_email', $settings->support_email) }}"
                                        placeholder="support@lonstack.com">
                                    @error('support_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="company_phone"
                                        class="form-control @error('company_phone') is-invalid @enderror"
                                        value="{{ old('company_phone', $settings->company_phone) }}"
                                        placeholder="+1 (123) 456 789">
                                    @error('company_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="company_address"
                                        class="form-control @error('company_address') is-invalid @enderror"
                                        value="{{ old('company_address', $settings->company_address) }}"
                                        placeholder="55 Main Street, San Francisco, CA">
                                    @error('company_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SEO --}}
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#seoSettings">
                            <h5>🔍 SEO Settings</h5>
                        </div>
                    </h2>
                    <div id="seoSettings" class="accordion-collapse collapse">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title"
                                        class="form-control @error('meta_title') is-invalid @enderror"
                                        value="{{ old('meta_title', $settings->meta_title) }}"
                                        placeholder="Lonstack Software - IT Solutions & Software Development">
                                    <small class="text-muted">Recommended: 50–60 characters</small>
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" rows="3" class="form-control @error('meta_description') is-invalid @enderror"
                                        placeholder="A short description of your website for search engines...">{{ old('meta_description', $settings->meta_description) }}</textarea>
                                    <small class="text-muted">Recommended: 150–160 characters</small>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Meta Keywords</label>
                                    <input type="text" name="meta_keywords"
                                        class="form-control @error('meta_keywords') is-invalid @enderror"
                                        value="{{ old('meta_keywords', $settings->meta_keywords) }}"
                                        placeholder="software development, IT company, blockchain, AI solutions">
                                    <small class="text-muted">Separate keywords with commas</small>
                                    @error('meta_keywords')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Meta Author</label>
                                    <input type="text" name="meta_author"
                                        class="form-control @error('meta_author') is-invalid @enderror"
                                        value="{{ old('meta_author', $settings->meta_author) }}"
                                        placeholder="Lonstack Software">
                                    @error('meta_author')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Social Media --}}
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#socialMedia">
                            <h5>🌐 Social Media Links</h5>
                            <span class="badge bg-secondary ms-2">Optional</span>
                        </div>
                    </h2>
                    <div id="socialMedia" class="accordion-collapse collapse">
                        <div class="accordion-body border-top">
                            <div class="row">
                                @foreach ([
            'site_fb' => ['label' => 'Facebook', 'placeholder' => 'https://facebook.com/lonstack'],
            'site_instagram' => ['label' => 'Instagram', 'placeholder' => 'https://instagram.com/lonstack'],
            'site_twitter' => ['label' => 'X (Twitter)', 'placeholder' => 'https://x.com/lonstack'],
            'site_linkedin' => ['label' => 'LinkedIn', 'placeholder' => 'https://linkedin.com/company/lonstack'],
            'site_youtube' => ['label' => 'YouTube', 'placeholder' => 'https://youtube.com/@lonstack'],
            'site_tiktok' => ['label' => 'TikTok', 'placeholder' => 'https://tiktok.com/@lonstack'],
            'site_github' => ['label' => 'GitHub', 'placeholder' => 'https://github.com/lonstack'],
            'site_whatsapp' => ['label' => 'WhatsApp Number', 'placeholder' => '+2348012345678'],
        ] as $field => $meta)
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{ $meta['label'] }}</label>
                                        <input type="{{ $field === 'site_whatsapp' ? 'text' : 'url' }}"
                                            name="{{ $field }}"
                                            class="form-control @error($field) is-invalid @enderror"
                                            value="{{ old($field, $settings->$field) }}"
                                            placeholder="{{ $meta['placeholder'] }}">
                                        @error($field)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Maintenance Mode --}}
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#maintenanceSettings">
                            <h5>🚧 Maintenance Mode</h5>
                            @if ($settings->maintenance_mode)
                                <span class="badge bg-danger ms-2">Currently ON</span>
                            @else
                                <span class="badge bg-success ms-2">Currently OFF</span>
                            @endif
                        </div>
                    </h2>
                    <div id="maintenanceSettings" class="accordion-collapse collapse">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="maintenance_mode"
                                            id="maintenance_mode" value="1"
                                            {{ old('maintenance_mode', $settings->maintenance_mode) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="maintenance_mode">
                                            Enable Maintenance Mode
                                        </label>
                                    </div>
                                    <small class="text-muted">When enabled, visitors will see the maintenance page.
                                        Logged-in admins can still access the site.</small>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Maintenance Message</label>
                                    <textarea name="maintenance_message" rows="3"
                                        class="form-control @error('maintenance_message') is-invalid @enderror"
                                        placeholder="We are currently performing scheduled maintenance. We will be back shortly.">{{ old('maintenance_message', $settings->maintenance_message) }}</textarea>
                                    @error('maintenance_message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- end accordion --}}

            <div class="d-flex justify-content-end mb-4">
                <button type="submit" class="btn btn-secondary px-4">
                    <i class="ti ti-device-floppy me-1"></i> Save Settings
                </button>
            </div>

        </form>
    </div>
@endsection
