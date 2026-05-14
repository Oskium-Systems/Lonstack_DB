<div class="row">

    {{-- ── Row 1: Title + Slug ── --}}
    <div class="col-md-8 mb-3">
        <label class="form-label">Job Title <span class="text-danger">*</span></label>
        <input type="text" name="title"
               id="{{ ($edit ?? false) ? 'edit-title' : 'add-title' }}"
               class="form-control" required
               placeholder="e.g. Senior Solidity Developer">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Slug <small class="text-muted">(auto-generated)</small></label>
        <input type="text" name="slug"
               id="{{ ($edit ?? false) ? 'edit-slug' : 'add-slug' }}"
               class="form-control"
               placeholder="leave blank to auto-generate">
    </div>

    {{-- ── Row 2: Department + Experience Level ── --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Department</label>
        <input type="text" name="department"
               id="{{ ($edit ?? false) ? 'edit-department' : 'add-department' }}"
               class="form-control"
               placeholder="e.g. Engineering, Design, Marketing">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Experience Level</label>
        <input type="text" name="experience_level"
               id="{{ ($edit ?? false) ? 'edit-experience_level' : 'add-experience_level' }}"
               class="form-control"
               placeholder="e.g. Junior, Mid-level, Senior">
    </div>

    {{-- ── Row 3: Location + Work Type + Employment Type ── --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Location</label>
        <input type="text" name="location"
               id="{{ ($edit ?? false) ? 'edit-location' : 'add-location' }}"
               class="form-control" value="Remote"
               placeholder="e.g. Remote, Lagos, Nigeria">
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Work Arrangement <span class="text-danger">*</span></label>
        <select name="work_type"
                id="{{ ($edit ?? false) ? 'edit-work_type' : 'add-work_type' }}"
                class="form-select" required>
            <option value="remote">Remote</option>
            <option value="onsite">On-site</option>
            <option value="hybrid">Hybrid</option>
        </select>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Employment Type <span class="text-danger">*</span></label>
        <select name="employment_type"
                id="{{ ($edit ?? false) ? 'edit-employment_type' : 'add-employment_type' }}"
                class="form-select" required>
            <option value="full-time">Full-Time</option>
            <option value="part-time">Part-Time</option>
            <option value="contract">Contract</option>
            <option value="internship">Internship</option>
            <option value="freelance">Freelance</option>
        </select>
    </div>

    {{-- ── Row 4: Salary + Deadline + Sort ── --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Salary Range</label>
        <input type="text" name="salary_range"
               id="{{ ($edit ?? false) ? 'edit-salary_range' : 'add-salary_range' }}"
               class="form-control"
               placeholder="e.g. $3,000 – $5,000/mo">
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Application Deadline</label>
        <input type="date" name="deadline"
               id="{{ ($edit ?? false) ? 'edit-deadline' : 'add-deadline' }}"
               class="form-control">
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order"
               id="{{ ($edit ?? false) ? 'edit-sort_order' : 'add-sort_order' }}"
               class="form-control" value="0" min="0">
    </div>

    {{-- ── Tags ── --}}
    <div class="col-md-12 mb-3">
        <label class="form-label">Tech Stack / Tags <small class="text-muted">(comma-separated)</small></label>
        <input type="text" name="tags"
               id="{{ ($edit ?? false) ? 'edit-tags' : 'add-tags' }}"
               class="form-control"
               placeholder="e.g. Solidity, Node.js, React, TypeScript">
    </div>

    {{-- ── Excerpt ── --}}
    <div class="col-md-12 mb-3">
        <label class="form-label">Excerpt <small class="text-muted">(short teaser shown in the listing row)</small></label>
        <textarea name="excerpt" rows="2"
                  id="{{ ($edit ?? false) ? 'edit-excerpt' : 'add-excerpt' }}"
                  class="form-control"
                  placeholder="One or two sentences about the role."></textarea>
    </div>

    {{-- ── Divider ── --}}
    <div class="col-12 mb-3">
        <hr class="my-1">
        <p class="text-muted fs-12 mb-0">Full job content — shown on the vacancy detail page</p>
    </div>

    {{-- ── Job Description (Quill) ── --}}
    <div class="col-md-12 mb-3">
        <label class="form-label">Job Description</label>
        @if ($edit ?? false)
            <input type="hidden" name="description" id="edit-description-input">
            <div id="edit-description-editor" style="min-height:140px;"></div>
        @else
            <input type="hidden" name="description" id="add-description-input">
            <div id="add-description-editor" style="min-height:140px;"></div>
        @endif
    </div>

    {{-- ── Responsibilities (Quill) ── --}}
    <div class="col-md-12 mb-3">
        <label class="form-label">Responsibilities</label>
        @if ($edit ?? false)
            <input type="hidden" name="responsibilities" id="edit-responsibilities-input">
            <div id="edit-responsibilities-editor" style="min-height:140px;"></div>
        @else
            <input type="hidden" name="responsibilities" id="add-responsibilities-input">
            <div id="add-responsibilities-editor" style="min-height:140px;"></div>
        @endif
    </div>

    {{-- ── Requirements (Quill) ── --}}
    <div class="col-md-12 mb-3">
        <label class="form-label">Requirements <small class="text-muted">(must-have)</small></label>
        @if ($edit ?? false)
            <input type="hidden" name="requirements" id="edit-requirements-input">
            <div id="edit-requirements-editor" style="min-height:140px;"></div>
        @else
            <input type="hidden" name="requirements" id="add-requirements-input">
            <div id="add-requirements-editor" style="min-height:140px;"></div>
        @endif
    </div>

    {{-- ── Nice to Have (Quill) ── --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Nice to Have <small class="text-muted">(bonus skills)</small></label>
        @if ($edit ?? false)
            <input type="hidden" name="nice_to_have" id="edit-nice_to_have-input">
            <div id="edit-nice_to_have-editor" style="min-height:120px;"></div>
        @else
            <input type="hidden" name="nice_to_have" id="add-nice_to_have-input">
            <div id="add-nice_to_have-editor" style="min-height:120px;"></div>
        @endif
    </div>

    {{-- ── Benefits (Quill) ── --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Benefits / Perks</label>
        @if ($edit ?? false)
            <input type="hidden" name="benefits" id="edit-benefits-input">
            <div id="edit-benefits-editor" style="min-height:120px;"></div>
        @else
            <input type="hidden" name="benefits" id="add-benefits-input">
            <div id="add-benefits-editor" style="min-height:120px;"></div>
        @endif
    </div>

    {{-- ── Toggles ── --}}
    <div class="col-md-3 mb-3">
        <div class="d-flex align-items-center justify-content-between">
            <label class="form-label mb-0">Active (visible on site)</label>
            <label class="switch ms-2">
                <input type="checkbox" name="is_active" value="1"
                       id="{{ ($edit ?? false) ? 'edit-is_active' : 'add-is_active' }}"
                       {{ ($edit ?? false) ? '' : 'checked' }}>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="d-flex align-items-center justify-content-between">
            <label class="form-label mb-0">Featured 🔥</label>
            <label class="switch ms-2">
                <input type="checkbox" name="is_featured" value="1"
                       id="{{ ($edit ?? false) ? 'edit-is_featured' : 'add-is_featured' }}">
                <span class="slider round"></span>
            </label>
        </div>
    </div>

</div>
