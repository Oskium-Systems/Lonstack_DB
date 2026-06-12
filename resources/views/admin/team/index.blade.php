@extends('layouts.admin')

@section('content')
<div class="content">

    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4>Team Members</h4>
                <h6>Manage your team members</h6>
            </div>
        </div>
        <div class="page-btn">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_team">
                <i class="ti ti-circle-plus me-1"></i>Add Member
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:80px;">Photo</th>
                            <th>Name</th>
                            <th>Role / Dept</th>
                            <th>Bio</th>
                            <th style="width:130px;">Social</th>
                            <th style="width:100px;">Status</th>
                            <th style="width:60px;">Sort</th>
                            <th style="width:90px;">Date</th>
                            <th style="width:80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="teamBody">
                        @forelse ($teams as $t)
                        <tr data-id="{{ $t->id }}">
                            <td>
                                @if ($t->photo)
                                    <img src="{{ asset('storage/' . $t->photo) }}"
                                         class="rounded" style="width:60px;height:60px;object-fit:cover;" alt="">
                                @else
                                    <div class="rounded d-flex align-items-center justify-content-center fw-bold"
                                         style="width:60px;height:60px;background:var(--primary);color:#fff;font-size:22px;">
                                        {{ $t->initial }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <p class="fw-medium mb-0">{{ $t->name }}</p>
                                @if ($t->experience)
                                    <small class="text-muted">{{ $t->experience }}</small>
                                @endif
                            </td>
                            <td class="text-muted fs-13">
                                {{ $t->role }}
                                @if ($t->department)
                                    <br><small>{{ $t->department }}</small>
                                @endif
                            </td>
                            <td style="max-width:220px;">
                                <p class="mb-0 text-truncate text-muted fs-13">{{ $t->bio }}</p>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    @if ($t->facebook)
                                        <a href="{{ $t->facebook }}" target="_blank" class="badge badge-soft-primary border-0 p-1" title="Facebook"><i class="ti ti-brand-facebook"></i></a>
                                    @endif
                                    @if ($t->twitter)
                                        <a href="{{ $t->twitter }}" target="_blank" class="badge badge-soft-info border-0 p-1" title="Twitter"><i class="ti ti-brand-twitter"></i></a>
                                    @endif
                                    @if ($t->linkedin)
                                        <a href="{{ $t->linkedin }}" target="_blank" class="badge badge-soft-primary border-0 p-1" title="LinkedIn"><i class="ti ti-brand-linkedin"></i></a>
                                    @endif
                                    @if ($t->youtube)
                                        <a href="{{ $t->youtube }}" target="_blank" class="badge badge-soft-danger border-0 p-1" title="YouTube"><i class="ti ti-brand-youtube"></i></a>
                                    @endif
                                    @if ($t->github)
                                        <a href="{{ $t->github }}" target="_blank" class="badge badge-soft-dark border-0 p-1" title="GitHub"><i class="ti ti-brand-github"></i></a>
                                    @endif
                                    @if ($t->website)
                                        <a href="{{ $t->website }}" target="_blank" class="badge badge-soft-secondary border-0 p-1" title="Website"><i class="ti ti-world"></i></a>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if ($t->is_active)
                                    <button type="button" class="badge badge-success border-0 toggle-status-btn"
                                            data-id="{{ $t->id }}" data-status="1"
                                            style="cursor:pointer;" title="Click to deactivate">
                                        <i class="ti ti-point-filled"></i> Active
                                    </button>
                                @else
                                    <button type="button" class="badge badge-danger border-0 toggle-status-btn"
                                            data-id="{{ $t->id }}" data-status="0"
                                            style="cursor:pointer;" title="Click to activate">
                                        <i class="ti ti-point-filled"></i> Inactive
                                    </button>
                                @endif
                            </td>
                            <td class="text-muted fs-13">{{ $t->sort_order }}</td>
                            <td class="text-muted fs-13">{{ $t->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <a href="#" class="p-1 edit-btn"
                                       data-id="{{ $t->id }}"
                                       data-name="{{ $t->name }}"
                                       data-slug="{{ $t->slug }}"
                                       data-role="{{ $t->role }}"
                                       data-department="{{ $t->department }}"
                                       data-bio="{{ $t->bio }}"
                                       data-experience="{{ $t->experience }}"
                                       data-facebook="{{ $t->facebook }}"
                                       data-twitter="{{ $t->twitter }}"
                                       data-linkedin="{{ $t->linkedin }}"
                                       data-youtube="{{ $t->youtube }}"
                                       data-github="{{ $t->github }}"
                                       data-website="{{ $t->website }}"
                                       data-status="{{ $t->is_active ? 1 : 0 }}"
                                       data-sort="{{ $t->sort_order }}"
                                       data-photo="{{ $t->photo ? asset('storage/' . $t->photo) : '' }}"
                                       data-bs-toggle="modal" data-bs-target="#edit_team">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a href="#" class="p-1 delete-btn"
                                       data-id="{{ $t->id }}"
                                       data-bs-toggle="modal" data-bs-target="#delete_modal">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr id="emptyRow">
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="ti ti-users fs-36 d-block mb-2"></i>
                                No team members yet. Add your first one.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($teams->hasPages())
        <div class="card-footer d-flex align-items-center justify-content-between flex-wrap row-gap-2">
            <p class="text-muted fs-13 mb-0">
                Showing {{ $teams->firstItem() }}–{{ $teams->lastItem() }} of {{ $teams->total() }} members
            </p>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item {{ $teams->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $teams->previousPageUrl() ?? '#' }}">&laquo;</a>
                </li>
                @foreach ($teams->getUrlRange(1, $teams->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $teams->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
                @endforeach
                <li class="page-item {{ !$teams->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $teams->nextPageUrl() ?? '#' }}">&raquo;</a>
                </li>
            </ul>
        </div>
        @endif
    </div>
</div>

<!-- ═══════════════════════════ ADD MODAL ═══════════════════════════ -->
<div class="modal fade" id="add_team">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Team Member</h4>
                <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal"><i class="ti ti-x"></i></button>
            </div>
            <form id="add-form" action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">

                        {{-- Name & Slug --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="add-name" class="form-control" required
                                   placeholder="e.g. Jane Doe">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug <small class="text-muted">(auto-generated)</small></label>
                            <input type="text" name="slug" id="add-slug" class="form-control"
                                   placeholder="jane-doe">
                        </div>

                        {{-- Role & Department --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <input type="text" name="role" class="form-control" required
                                   placeholder="e.g. Senior Developer">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Department</label>
                            <input type="text" name="department" class="form-control"
                                   placeholder="e.g. Engineering">
                        </div>

                        {{-- Photo --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo" id="add-photo" class="form-control" accept="image/*">
                            <div id="add-photo-preview" class="mt-2" style="display:none;">
                                <img id="add-photo-img" src="" alt=""
                                     class="rounded" style="width:80px;height:80px;object-fit:cover;">
                            </div>
                            <small class="text-muted">Optional. Max 2MB. JPG/PNG/WEBP.</small>
                        </div>

                        {{-- Bio --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Bio</label>
                            <textarea name="bio" class="form-control" rows="3"
                                      placeholder="Short biography..."></textarea>
                        </div>

                        {{-- Experience --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Experience</label>
                            <input type="text" name="experience" class="form-control"
                                   placeholder="e.g. 5+ years">
                        </div>

                        {{-- Sort & Active --}}
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="0" min="0">
                        </div>
                        <div class="col-md-3 mb-3 d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-between w-100 mt-3">
                                <label class="form-label mb-0">Active</label>
                                <label class="switch ms-2">
                                    <input type="checkbox" name="is_active" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                        {{-- Social Links --}}
                        <div class="col-12 mb-2">
                            <p class="fw-medium mb-2 text-muted fs-13">Social / Links</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="ti ti-brand-facebook me-1 text-primary"></i>Facebook</label>
                            <input type="url" name="facebook" class="form-control" placeholder="https://facebook.com/...">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="ti ti-brand-twitter me-1 text-info"></i>Twitter / X</label>
                            <input type="url" name="twitter" class="form-control" placeholder="https://twitter.com/...">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="ti ti-brand-linkedin me-1 text-primary"></i>LinkedIn</label>
                            <input type="url" name="linkedin" class="form-control" placeholder="https://linkedin.com/in/...">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="ti ti-brand-youtube me-1 text-danger"></i>YouTube</label>
                            <input type="url" name="youtube" class="form-control" placeholder="https://youtube.com/...">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="ti ti-brand-github me-1"></i>GitHub</label>
                            <input type="url" name="github" class="form-control" placeholder="https://github.com/...">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="ti ti-world me-1 text-secondary"></i>Website</label>
                            <input type="url" name="website" class="form-control" placeholder="https://...">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ═══════════════════════════ EDIT MODAL ═══════════════════════════ -->
<div class="modal fade" id="edit_team">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Team Member</h4>
                <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal"><i class="ti ti-x"></i></button>
            </div>
            <form id="edit-form" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body pb-0">
                    <div class="row">

                        {{-- Name & Slug --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="edit-name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" id="edit-slug" class="form-control">
                        </div>

                        {{-- Role & Department --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <input type="text" name="role" id="edit-role" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Department</label>
                            <input type="text" name="department" id="edit-department" class="form-control">
                        </div>

                        {{-- Photo --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Photo</label>
                            <div id="edit-photo-preview" class="mb-2" style="display:none;">
                                <img id="edit-photo-img" src="" alt=""
                                     class="rounded" style="width:80px;height:80px;object-fit:cover;">
                                <p class="text-muted fs-12 mt-1">Current photo — upload a new one to replace it.</p>
                            </div>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>

                        {{-- Bio --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Bio</label>
                            <textarea name="bio" id="edit-bio" class="form-control" rows="3"></textarea>
                        </div>

                        {{-- Experience --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Experience</label>
                            <input type="text" name="experience" id="edit-experience" class="form-control">
                        </div>

                        {{-- Sort & Active --}}
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" id="edit-sort" class="form-control" min="0">
                        </div>
                        <div class="col-md-3 mb-3 d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-between w-100 mt-3">
                                <label class="form-label mb-0">Active</label>
                                <label class="switch ms-2">
                                    <input type="checkbox" name="is_active" id="edit-status">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                        {{-- Social Links --}}
                        <div class="col-12 mb-2">
                            <p class="fw-medium mb-2 text-muted fs-13">Social / Links</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="ti ti-brand-facebook me-1 text-primary"></i>Facebook</label>
                            <input type="url" name="facebook" id="edit-facebook" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="ti ti-brand-twitter me-1 text-info"></i>Twitter / X</label>
                            <input type="url" name="twitter" id="edit-twitter" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="ti ti-brand-linkedin me-1 text-primary"></i>LinkedIn</label>
                            <input type="url" name="linkedin" id="edit-linkedin" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="ti ti-brand-youtube me-1 text-danger"></i>YouTube</label>
                            <input type="url" name="youtube" id="edit-youtube" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="ti ti-brand-github me-1"></i>GitHub</label>
                            <input type="url" name="github" id="edit-github" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="ti ti-world me-1 text-secondary"></i>Website</label>
                            <input type="url" name="website" id="edit-website" class="form-control">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ═══════════════════════════ DELETE MODAL ═══════════════════════════ -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-soft-danger rounded-circle text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Delete Team Member</h4>
                <p class="mb-3">Are you sure you want to delete this team member? This action cannot be undone.</p>
                <form id="delete-form" action="#" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
const TEAM_BASE = "{{ url('admin/team') }}";
const csrfToken = "{{ csrf_token() }}";

document.addEventListener('DOMContentLoaded', function () {

    let addSubmitting    = false;
    let editSubmitting   = false;
    let deleteSubmitting = false;

    const tbody    = document.getElementById('teamBody');
    const addForm  = document.getElementById('add-form');
    const editForm = document.getElementById('edit-form');
    const delForm  = document.getElementById('delete-form');

    if (!addForm || !editForm || !delForm || !tbody) return; // safety guard

    // ─── ADD photo preview ───────────────────────────────────────────────────
    document.getElementById('add-photo').addEventListener('change', function () {
        const preview = document.getElementById('add-photo-preview');
        const img     = document.getElementById('add-photo-img');
        if (this.files && this.files[0]) {
            img.src = URL.createObjectURL(this.files[0]);
            preview.style.display = 'block';
        }
    });

    // ─── ADD name → slug auto-fill ───────────────────────────────────────────
    document.getElementById('add-name').addEventListener('input', function () {
        const slugField = document.getElementById('add-slug');
        if (!slugField._manuallyEdited) {
            slugField.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-');
        }
    });
    document.getElementById('add-slug').addEventListener('input', function () {
        this._manuallyEdited = this.value.length > 0;
    });

    // ─── ADD submit ──────────────────────────────────────────────────────────
    addForm.addEventListener('submit', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        if (addSubmitting || addForm.dataset.submitting === '1') return;
        addSubmitting = true;
        addForm.dataset.submitting = '1';

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: new FormData(this),
        })
        .then(res => res.json())
        .then(data => {
            addSubmitting = false;
            addForm.dataset.submitting = '0';
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('add_team')).hide();
                this.reset();
                document.getElementById('add-photo-preview').style.display = 'none';
                document.getElementById('add-slug')._manuallyEdited = false;

                iziToast.success({ message: data.message, position: 'topRight' });

                removeEmpty();
                const tr = document.createElement('tr');
                tr.dataset.id = data.team.id;
                tr.innerHTML  = rowHtml(data.team);
                tbody.insertBefore(tr, tbody.firstChild);
            } else if (data.errors) {
                // Show first validation error
                const first = Object.values(data.errors)[0];
                iziToast.error({ message: Array.isArray(first) ? first[0] : first, position: 'topRight' });
            } else {
                iziToast.error({ message: data.message || 'Something went wrong.', position: 'topRight' });
            }
        })
        .catch(err => {
            addSubmitting = false;
            addForm.dataset.submitting = '0';
            console.error('Team store error:', err);
            iziToast.error({ message: 'Request failed. Check console for details.', position: 'topRight' });
        });
    });

    // ─── EDIT submit ─────────────────────────────────────────────────────────
    editForm.addEventListener('submit', function (e) {
        e.preventDefault();
        if (editSubmitting) return;
        editSubmitting = true;

        const fd = new FormData(this);
        fd.append('_method', 'PUT');

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: fd,
        })
        .then(res => res.json())
        .then(data => {
            editSubmitting = false;
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('edit_team')).hide();
                iziToast.success({ message: data.message, position: 'topRight' });
                updateRow(data.team);
            } else if (data.errors) {
                const first = Object.values(data.errors)[0];
                iziToast.error({ message: Array.isArray(first) ? first[0] : first, position: 'topRight' });
            } else {
                iziToast.error({ message: data.message || 'Update failed.', position: 'topRight' });
            }
        })
        .catch(err => {
            editSubmitting = false;
            console.error('Team update error:', err);
            iziToast.error({ message: 'Update failed. Check console.', position: 'topRight' });
        });
    });

    // ─── DELETE submit ───────────────────────────────────────────────────────
    delForm.addEventListener('submit', function (e) {
        e.preventDefault();
        if (deleteSubmitting) return;
        deleteSubmitting = true;

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/x-www-form-urlencoded',
                'Accept': 'application/json',
            },
            body: '_method=DELETE',
        })
        .then(res => res.json())
        .then(data => {
            deleteSubmitting = false;
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('delete_modal')).hide();
                iziToast.success({ message: data.message, position: 'topRight' });

                const id  = delForm.dataset.id;
                const row = tbody.querySelector(`tr[data-id="${id}"]`);
                if (row) row.remove();
                checkEmpty();
            }
        })
        .catch(err => {
            deleteSubmitting = false;
            console.error('Team delete error:', err);
        });
    });

    // ─── DELEGATION ──────────────────────────────────────────────────────────
    tbody.addEventListener('click', function (e) {

        // EDIT — populate modal
        const editBtn = e.target.closest('.edit-btn');
        if (editBtn) {
            const d = editBtn.dataset;
            document.getElementById('edit-name').value       = d.name       || '';
            document.getElementById('edit-slug').value       = d.slug       || '';
            document.getElementById('edit-role').value       = d.role       || '';
            document.getElementById('edit-department').value = d.department || '';
            document.getElementById('edit-bio').value        = d.bio        || '';
            document.getElementById('edit-experience').value = d.experience || '';
            document.getElementById('edit-facebook').value   = d.facebook   || '';
            document.getElementById('edit-twitter').value    = d.twitter    || '';
            document.getElementById('edit-linkedin').value   = d.linkedin   || '';
            document.getElementById('edit-youtube').value    = d.youtube    || '';
            document.getElementById('edit-github').value     = d.github     || '';
            document.getElementById('edit-website').value    = d.website    || '';
            document.getElementById('edit-sort').value       = d.sort       || '0';
            document.getElementById('edit-status').checked   = d.status     == '1';

            const preview = document.getElementById('edit-photo-preview');
            const img     = document.getElementById('edit-photo-img');
            if (d.photo) {
                img.src = d.photo;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }

            editForm.action = `${TEAM_BASE}/${d.id}`;
        }

        // DELETE
        const delBtn = e.target.closest('.delete-btn');
        if (delBtn) {
            delForm.action     = `${TEAM_BASE}/${delBtn.dataset.id}`;
            delForm.dataset.id = delBtn.dataset.id;
        }

        // TOGGLE STATUS
        const togBtn = e.target.closest('.toggle-status-btn');
        if (togBtn) {
            fetch(`${TEAM_BASE}/${togBtn.dataset.id}/status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                },
                body: '_method=PATCH',
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const on = data.is_active;
                    togBtn.className      = `badge ${on ? 'badge-success' : 'badge-danger'} border-0 toggle-status-btn`;
                    togBtn.dataset.status = on ? '1' : '0';
                    togBtn.innerHTML      = `<i class="ti ti-point-filled"></i> ${on ? 'Active' : 'Inactive'}`;
                    togBtn.title          = on ? 'Click to deactivate' : 'Click to activate';
                    iziToast.success({ message: data.message, position: 'topRight' });
                }
            });
        }
    });

    // ─── HELPERS ─────────────────────────────────────────────────────────────
    function updateRow(t) {
        const row = tbody.querySelector(`tr[data-id="${t.id}"]`);
        if (!row) return;
        row.innerHTML = rowHtml(t);
    }

    function removeEmpty() {
        const el = document.getElementById('emptyRow');
        if (el) el.remove();
    }

    function checkEmpty() {
        if (!tbody.querySelector('tr')) {
            tbody.innerHTML = `
                <tr id="emptyRow">
                    <td colspan="9" class="text-center py-5 text-muted">
                        <i class="ti ti-users fs-36 d-block mb-2"></i>
                        No team members yet. Add your first one.
                    </td>
                </tr>`;
        }
    }

    function photoHtml(t) {
        if (t.photo) {
            return `<img src="${esc(t.photo)}" class="rounded" style="width:60px;height:60px;object-fit:cover;" alt="">`;
        }
        return `<div class="rounded d-flex align-items-center justify-content-center fw-bold"
                     style="width:60px;height:60px;background:var(--primary);color:#fff;font-size:22px;">
                    ${esc(t.initial)}
                </div>`;
    }

    function socialHtml(t) {
        let h = '<div class="d-flex flex-wrap gap-1">';
        if (t.facebook)  h += `<a href="${esc(t.facebook)}"  target="_blank" class="badge badge-soft-primary border-0 p-1" title="Facebook"><i class="ti ti-brand-facebook"></i></a>`;
        if (t.twitter)   h += `<a href="${esc(t.twitter)}"   target="_blank" class="badge badge-soft-info border-0 p-1"    title="Twitter"><i class="ti ti-brand-twitter"></i></a>`;
        if (t.linkedin)  h += `<a href="${esc(t.linkedin)}"  target="_blank" class="badge badge-soft-primary border-0 p-1" title="LinkedIn"><i class="ti ti-brand-linkedin"></i></a>`;
        if (t.youtube)   h += `<a href="${esc(t.youtube)}"   target="_blank" class="badge badge-soft-danger border-0 p-1"  title="YouTube"><i class="ti ti-brand-youtube"></i></a>`;
        if (t.github)    h += `<a href="${esc(t.github)}"    target="_blank" class="badge badge-soft-dark border-0 p-1"    title="GitHub"><i class="ti ti-brand-github"></i></a>`;
        if (t.website)   h += `<a href="${esc(t.website)}"   target="_blank" class="badge badge-soft-secondary border-0 p-1" title="Website"><i class="ti ti-world"></i></a>`;
        h += '</div>';
        return h;
    }

    function rowHtml(t) {
        const isActive = t.is_active == 1;
        const dept     = t.department ? `<br><small>${esc(t.department)}</small>` : '';
        const exp      = t.experience ? `<small class="text-muted">${esc(t.experience)}</small>` : '';
        const bio      = t.bio        ? `<p class="mb-0 text-truncate text-muted fs-13">${esc(t.bio)}</p>` : '';

        return `
            <td>${photoHtml(t)}</td>
            <td><p class="fw-medium mb-0">${esc(t.name)}</p>${exp}</td>
            <td class="text-muted fs-13">${esc(t.role)}${dept}</td>
            <td style="max-width:220px;">${bio}</td>
            <td>${socialHtml(t)}</td>
            <td>
                <button type="button"
                        class="badge ${isActive ? 'badge-success' : 'badge-danger'} border-0 toggle-status-btn"
                        data-id="${t.id}" data-status="${isActive ? 1 : 0}"
                        style="cursor:pointer;"
                        title="${isActive ? 'Click to deactivate' : 'Click to activate'}">
                    <i class="ti ti-point-filled"></i> ${isActive ? 'Active' : 'Inactive'}
                </button>
            </td>
            <td class="text-muted fs-13">${t.sort_order}</td>
            <td class="text-muted fs-13">${t.created_at}</td>
            <td>
                <div class="d-flex align-items-center gap-1">
                    <a href="#" class="p-1 edit-btn"
                       data-id="${t.id}"
                       data-name="${esc(t.name)}"
                       data-slug="${esc(t.slug || '')}"
                       data-role="${esc(t.role)}"
                       data-department="${esc(t.department || '')}"
                       data-bio="${esc(t.bio || '')}"
                       data-experience="${esc(t.experience || '')}"
                       data-facebook="${esc(t.facebook || '')}"
                       data-twitter="${esc(t.twitter || '')}"
                       data-linkedin="${esc(t.linkedin || '')}"
                       data-youtube="${esc(t.youtube || '')}"
                       data-github="${esc(t.github || '')}"
                       data-website="${esc(t.website || '')}"
                       data-status="${isActive ? 1 : 0}"
                       data-sort="${t.sort_order}"
                       data-photo="${esc(t.photo || '')}"
                       data-bs-toggle="modal" data-bs-target="#edit_team">
                        <i class="ti ti-edit"></i>
                    </a>
                    <a href="#" class="p-1 delete-btn"
                       data-id="${t.id}"
                       data-bs-toggle="modal" data-bs-target="#delete_modal">
                        <i class="ti ti-trash"></i>
                    </a>
                </div>
            </td>`;
    }

    function esc(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }

}); // end DOMContentLoaded
</script>
@endpush
