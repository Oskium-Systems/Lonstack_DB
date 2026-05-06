@extends('layouts.admin')

@section('content')
<div class="content">

    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4>Testimonials</h4>
                <h6>Manage your testimonials</h6>
            </div>
        </div>
        <div class="page-btn">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_testimonial">
                <i class="ti ti-circle-plus me-1"></i>Add Testimonial
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:70px;">Avatar</th>
                            <th>Name</th>
                            <th>Position / Company</th>
                            <th>Content</th>
                            <th style="width:110px;">Rating</th>
                            <th style="width:100px;">Status</th>
                            <th style="width:90px;">Date</th>
                            <th style="width:80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="testimonialBody">
                        @forelse ($testimonials as $t)
                        <tr data-id="{{ $t->id }}">
                            <td>
                                @if ($t->avatar)
                                    <img src="{{ asset('storage/' . $t->avatar) }}"
                                         class="rounded-circle" style="width:42px;height:42px;object-fit:cover;" alt="">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-7"
                                         style="width:42px;height:42px;background:var(--primary);color:#fff;font-size:18px;">
                                        {{ $t->initial }}
                                    </div>
                                @endif
                            </td>
                            <td class="fw-medium">{{ $t->name }}</td>
                            <td class="text-muted fs-13">
                                {{ $t->position }}
                                @if ($t->company)
                                    <span class="text-muted"> · </span>{{ $t->company }}
                                @endif
                            </td>
                            <td style="max-width:260px;">
                                <p class="mb-0 text-truncate">{{ $t->content }}</p>
                            </td>
                            <td>
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="ti ti-star-filled {{ $i <= $t->rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </td>
                            <td>
                                @if ($t->status)
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
                            <td class="text-muted fs-13">{{ $t->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <a href="#" class="p-1 edit-btn"
                                       data-id="{{ $t->id }}"
                                       data-name="{{ $t->name }}"
                                       data-position="{{ $t->position }}"
                                       data-company="{{ $t->company }}"
                                       data-content="{{ $t->content }}"
                                       data-rating="{{ $t->rating }}"
                                       data-status="{{ $t->status ? 1 : 0 }}"
                                       data-sort="{{ $t->sort_order }}"
                                       data-avatar="{{ $t->avatar ? asset('storage/' . $t->avatar) : '' }}"
                                       data-bs-toggle="modal" data-bs-target="#edit_testimonial">
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
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="ti ti-quote fs-36 d-block mb-2"></i>
                                No testimonials yet. Add your first one.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($testimonials->hasPages())
        <div class="card-footer d-flex align-items-center justify-content-between flex-wrap row-gap-2">
            <p class="text-muted fs-13 mb-0">
                Showing {{ $testimonials->firstItem() }}–{{ $testimonials->lastItem() }} of {{ $testimonials->total() }} testimonials
            </p>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item {{ $testimonials->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $testimonials->previousPageUrl() ?? '#' }}">&laquo;</a>
                </li>
                @foreach ($testimonials->getUrlRange(1, $testimonials->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $testimonials->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
                @endforeach
                <li class="page-item {{ !$testimonials->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $testimonials->nextPageUrl() ?? '#' }}">&raquo;</a>
                </li>
            </ul>
        </div>
        @endif
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="add_testimonial">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Testimonial</h4>
                <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal"><i class="ti ti-x"></i></button>
            </div>
            <form id="add-form" action="{{ route('admin.testimonial.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Avatar Photo</label>
                            <input type="file" name="avatar" class="form-control" accept="image/*">
                            <small class="text-muted">Optional. Max 1MB. JPG/PNG.</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Position / Role</label>
                            <input type="text" name="position" class="form-control" placeholder="e.g. CTO">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Company</label>
                            <input type="text" name="company" class="form-control" placeholder="e.g. FinEdge Inc.">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Rating <span class="text-danger">*</span></label>
                            <select name="rating" class="form-select" required>
                                <option value="5" selected>★★★★★ (5)</option>
                                <option value="4">★★★★☆ (4)</option>
                                <option value="3">★★★☆☆ (3)</option>
                                <option value="2">★★☆☆☆ (2)</option>
                                <option value="1">★☆☆☆☆ (1)</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="0" min="0">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Testimonial Content <span class="text-danger">*</span></label>
                            <textarea name="content" class="form-control" rows="4" required
                                      placeholder="What did the client say?"></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label mb-0">Visible on site</label>
                                <label class="switch ms-2">
                                    <input type="checkbox" name="status" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Testimonial</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edit_testimonial">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Testimonial</h4>
                <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal"><i class="ti ti-x"></i></button>
            </div>
            <form id="edit-form" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Avatar Photo</label>
                            <div id="edit-avatar-preview" class="mb-2" style="display:none;">
                                <img id="edit-avatar-img" src="" alt="" class="rounded-circle"
                                     style="width:60px;height:60px;object-fit:cover;">
                                <p class="text-muted fs-12 mt-1">Current photo — upload a new one to replace it.</p>
                            </div>
                            <input type="file" name="avatar" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="edit-name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Position / Role</label>
                            <input type="text" name="position" id="edit-position" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Company</label>
                            <input type="text" name="company" id="edit-company" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Rating <span class="text-danger">*</span></label>
                            <select name="rating" id="edit-rating" class="form-select" required>
                                <option value="5">★★★★★ (5)</option>
                                <option value="4">★★★★☆ (4)</option>
                                <option value="3">★★★☆☆ (3)</option>
                                <option value="2">★★☆☆☆ (2)</option>
                                <option value="1">★☆☆☆☆ (1)</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" id="edit-sort" class="form-control" min="0">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Testimonial Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="edit-content" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label mb-0">Visible on site</label>
                                <label class="switch ms-2">
                                    <input type="checkbox" name="status" id="edit-status">
                                    <span class="slider round"></span>
                                </label>
                            </div>
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

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-soft-danger rounded-circle text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Delete Testimonial</h4>
                <p class="mb-3">Are you sure you want to delete this testimonial?</p>
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
// Build route base URLs from Laravel so JS always uses the correct paths
const TESTIMONIAL_BASE = "{{ url('admin/testimonial') }}";
const csrfToken = "{{ csrf_token() }}";

if (!window._testimonialInitialized) {
    window._testimonialInitialized = true;

    let addSubmitting    = false;
    let editSubmitting   = false;
    let deleteSubmitting = false;

    const tbody = document.getElementById('testimonialBody');

    // ─── ADD ────────────────────────────────────────────────────────────────
    document.getElementById('add-form').addEventListener('submit', function (e) {
        e.preventDefault();
        if (addSubmitting) return;
        addSubmitting = true;

        fetch(this.action, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            body: new FormData(this),
        })
        .then(res => res.json())
        .then(data => {
            addSubmitting = false;

            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('add_testimonial')).hide();
                this.reset();

                iziToast.success({ message: data.message, position: 'topRight' });

                // Remove "no testimonials" placeholder if present
                removeEmpty();

                // ✅ Prepend new row so it appears at the top
                const tr = document.createElement('tr');
                tr.dataset.id = data.testimonial.id;
                tr.innerHTML = rowHtml(data.testimonial);
                tbody.insertBefore(tr, tbody.firstChild);
            }
        })
        .catch(() => { addSubmitting = false; });
    });

    // ─── EDIT ────────────────────────────────────────────────────────────────
    document.getElementById('edit-form').addEventListener('submit', function (e) {
        e.preventDefault();
        if (editSubmitting) return;
        editSubmitting = true;

        const fd = new FormData(this);
        fd.append('_method', 'PUT');

        fetch(this.action, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            body: fd,
        })
        .then(res => res.json())
        .then(data => {
            editSubmitting = false;

            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('edit_testimonial')).hide();

                iziToast.success({ message: data.message, position: 'topRight' });

                // ✅ Update the existing row in place — no page reload needed
                updateRow(data.testimonial);
            }
        })
        .catch(() => { editSubmitting = false; });
    });

    // ─── DELETE ──────────────────────────────────────────────────────────────
    document.getElementById('delete-form').addEventListener('submit', function (e) {
        e.preventDefault();
        if (deleteSubmitting) return;
        deleteSubmitting = true;

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: '_method=DELETE',
        })
        .then(res => res.json())
        .then(data => {
            deleteSubmitting = false;

            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('delete_modal')).hide();

                iziToast.success({ message: data.message, position: 'topRight' });

                // ✅ Remove the row from the DOM directly — no page reload needed
                const id = this.dataset.id;
                const row = tbody.querySelector(`tr[data-id="${id}"]`);
                if (row) row.remove();

                // Show empty state if no rows left
                checkEmpty();
            }
        })
        .catch(() => { deleteSubmitting = false; });
    });

    // ─── DELEGATION (edit / delete / toggle) ─────────────────────────────────
    tbody.addEventListener('click', function (e) {

        // EDIT — populate modal with existing data
        if (e.target.closest('.edit-btn')) {
            const btn = e.target.closest('.edit-btn');

            document.getElementById('edit-name').value     = btn.dataset.name     || '';
            document.getElementById('edit-position').value = btn.dataset.position || '';
            document.getElementById('edit-company').value  = btn.dataset.company  || '';
            document.getElementById('edit-content').value  = btn.dataset.content  || '';
            document.getElementById('edit-rating').value   = btn.dataset.rating   || '5';
            document.getElementById('edit-sort').value     = btn.dataset.sort     || '0';
            document.getElementById('edit-status').checked = btn.dataset.status   == '1';

            const preview = document.getElementById('edit-avatar-preview');
            const img     = document.getElementById('edit-avatar-img');

            if (btn.dataset.avatar) {
                img.src = btn.dataset.avatar;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }

            // ✅ Use the correct route URL
            document.getElementById('edit-form').action = `${TESTIMONIAL_BASE}/${btn.dataset.id}`;
        }

        // DELETE — set the correct form action + store id for DOM removal
        if (e.target.closest('.delete-btn')) {
            const btn  = e.target.closest('.delete-btn');
            const form = document.getElementById('delete-form');

            // ✅ Use the correct route URL
            form.action      = `${TESTIMONIAL_BASE}/${btn.dataset.id}`;
            form.dataset.id  = btn.dataset.id;
        }

        // TOGGLE STATUS
        if (e.target.closest('.toggle-status-btn')) {
            const btn = e.target.closest('.toggle-status-btn');
            const id  = btn.dataset.id;

            fetch(`${TESTIMONIAL_BASE}/${id}/status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: '_method=PATCH',
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const isActive = data.status;

                    btn.className    = `badge ${isActive ? 'badge-success' : 'badge-danger'} border-0 toggle-status-btn`;
                    btn.dataset.status = isActive ? '1' : '0';
                    btn.innerHTML    = `<i class="ti ti-point-filled"></i> ${isActive ? 'Active' : 'Inactive'}`;
                    btn.title        = isActive ? 'Click to deactivate' : 'Click to activate';

                    iziToast.success({ message: data.message, position: 'topRight' });
                }
            });
        }
    });

    // ─── HELPERS ─────────────────────────────────────────────────────────────

    function updateRow(t) {
        const row = tbody.querySelector(`tr[data-id="${t.id}"]`);
        if (!row) return;

        // Rebuild inner HTML but keep the <tr> element (preserves position)
        row.innerHTML = rowHtml(t);
    }

    function removeEmpty() {
        const empty = document.getElementById('emptyRow');
        if (empty) empty.remove();
    }

    function checkEmpty() {
        if (tbody.querySelectorAll('tr').length === 0) {
            tbody.innerHTML = `
                <tr id="emptyRow">
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="ti ti-quote fs-36 d-block mb-2"></i>
                        No testimonials yet. Add your first one.
                    </td>
                </tr>`;
        }
    }

    function starsHtml(rating) {
        let h = '';
        for (let i = 1; i <= 5; i++) {
            h += `<i class="ti ti-star-filled ${i <= rating ? 'text-warning' : 'text-muted'}"></i>`;
        }
        return h;
    }

    function avatarHtml(t) {
        if (t.avatar) {
            return `<img src="${t.avatar}" class="rounded-circle" style="width:42px;height:42px;object-fit:cover;" alt="">`;
        }
        return `<div class="rounded-circle d-flex align-items-center justify-content-center fw-7"
                    style="width:42px;height:42px;background:var(--primary);color:#fff;font-size:18px;">
                    ${t.initial}
                </div>`;
    }

    function rowHtml(t) {
        const company  = t.company ? ` <span class="text-muted"> · </span>${t.company}` : '';
        const isActive = t.status == 1;

        return `
            <td>${avatarHtml(t)}</td>
            <td class="fw-medium">${t.name}</td>
            <td class="text-muted fs-13">${t.position || ''}${company}</td>
            <td style="max-width:260px;"><p class="mb-0 text-truncate">${t.content}</p></td>
            <td>${starsHtml(t.rating)}</td>
            <td>
                <button type="button"
                        class="badge ${isActive ? 'badge-success' : 'badge-danger'} border-0 toggle-status-btn"
                        data-id="${t.id}" data-status="${isActive ? 1 : 0}"
                        style="cursor:pointer;"
                        title="${isActive ? 'Click to deactivate' : 'Click to activate'}">
                    <i class="ti ti-point-filled"></i> ${isActive ? 'Active' : 'Inactive'}
                </button>
            </td>
            <td class="text-muted fs-13">${t.created_at}</td>
            <td>
                <div class="d-flex align-items-center gap-1">
                    <a href="#" class="p-1 edit-btn"
                       data-id="${t.id}"
                       data-name="${t.name}"
                       data-position="${t.position || ''}"
                       data-company="${t.company || ''}"
                       data-content="${t.content.replace(/"/g, '&quot;').replace(/'/g, '&#39;')}"
                       data-rating="${t.rating}"
                       data-status="${isActive ? 1 : 0}"
                       data-sort="${t.sort_order}"
                       data-avatar="${t.avatar || ''}"
                       data-bs-toggle="modal" data-bs-target="#edit_testimonial">
                        <i class="ti ti-edit"></i>
                    </a>
                    <a href="#" class="p-1 delete-btn"
                       data-id="${t.id}"
                       data-bs-toggle="modal" data-bs-target="#delete_modal">
                        <i class="ti ti-trash"></i>
                    </a>
                </div>
            </td>
        `;
    }
}
</script>
@endpush