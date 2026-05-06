@extends('layouts.admin')

@section('content')
<div class="content">

    <div class="page-header">
        <div class="page-title">
            <h4 class="fw-bold">Blog Comments</h4>
            <h6>Manage blog comments</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-input" style="position:relative; min-width:260px;">
                <input type="text" id="commentSearch" class="form-control formsearch"
                       placeholder="Search comments..." autocomplete="off" style="padding-right:60px;">
                <button type="button" id="clearCommentSearch"
                        style="display:none; position:absolute; right:36px; top:50%;
                               transform:translateY(-50%); background:none; border:none;
                               cursor:pointer; color:#999; z-index:10;">
                    <i class="ti ti-x fs-14"></i>
                </button>
                <a class="btn btn-searchset"
                   style="position:absolute; right:8px; top:50%; transform:translateY(-50%); z-index:9;">
                    <i data-feather="search" class="feather-14"></i>
                </a>
            </div>
            <div class="dropdown">
                <a href="javascript:void(0);"
                   class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center"
                   data-bs-toggle="dropdown">
                    <span id="statusLabel">All</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-3">
                    <li><a href="javascript:void(0);" class="dropdown-item rounded-1 status-filter" data-status="">All</a></li>
                    <li><a href="javascript:void(0);" class="dropdown-item rounded-1 status-filter" data-status="published">Published</a></li>
                    <li><a href="javascript:void(0);" class="dropdown-item rounded-1 status-filter" data-status="pending">Pending</a></li>
                    <li><a href="javascript:void(0);" class="dropdown-item rounded-1 status-filter" data-status="unpublished">Unpublished</a></li>
                </ul>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:80px;">Type</th>
                            <th>Comment</th>
                            <th style="width:180px;">Blog</th>
                            <th style="width:130px;">By</th>
                            <th style="width:150px;">Status</th>
                            <th style="width:100px;">Date</th>
                            <th style="width:70px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="commentsBody">
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                Loading...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination bar -->
        <div class="card-footer d-flex align-items-center justify-content-between flex-wrap row-gap-2"
             id="paginationBar" style="display:none;">
            <div id="paginationInfo" class="text-muted fs-13"></div>
            <ul class="pagination pagination-sm mb-0" id="paginationLinks"></ul>
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
                <h4 class="mb-1">Delete Comment</h4>
                <p class="mb-3">Are you sure? Replies to this comment will also be deleted.</p>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-primary">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const commentSearchUrl = "{{ route('admin.blog.comments.search') }}";
    const csrfToken        = "{{ csrf_token() }}";

    let activeStatus    = '';
    let currentPage     = 1;
    let pendingDeleteId = null;

    window.iziToastInitialized = true;

    document.addEventListener('DOMContentLoaded', function () {

        const searchInput     = document.getElementById('commentSearch');
        const clearBtn        = document.getElementById('clearCommentSearch');
        const tbody           = document.getElementById('commentsBody');
        const paginationBar   = document.getElementById('paginationBar');
        const paginationInfo  = document.getElementById('paginationInfo');
        const paginationLinks = document.getElementById('paginationLinks');
        let debounceTimer;

        // ── Render rows ───────────────────────────────────────────
        function renderRows(data) {
            const comments     = data.comments     || [];
            const total        = data.total        || 0;
            const perPage      = data.per_page     || 10;
            const currentPg    = data.current_page || 1;
            const lastPage     = data.last_page    || 1;

            if (comments.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7" class="text-center py-5 text-muted">
                    <i class="ti ti-message-off fs-36 d-block mb-2"></i>No comments found.
                </td></tr>`;
                paginationBar.style.display = 'none';
                return;
            }

            tbody.innerHTML = comments.map(c => `
                <tr>
                    <td>
                        ${c.is_reply
                            ? '<span class="badge bg-soft-info shadow-none fs-11"><i class="ti ti-corner-down-right me-1"></i>Reply</span>'
                            : '<span class="badge bg-soft-success shadow-none fs-11">Comment</span>'}
                    </td>
                    <td style="max-width:260px;">
                        <p class="mb-0" style="white-space:normal; word-break:break-word;">${c.comment}</p>
                        ${c.parent_excerpt
                            ? `<small class="text-muted d-block mt-1">
                                <i class="ti ti-corner-down-right me-1"></i>Reply to: "${c.parent_excerpt}"
                               </small>`
                            : ''}
                    </td>
                    <td class="text-truncate" style="max-width:180px;" title="${c.blog}">${c.blog}</td>
                    <td>${c.author}</td>
                    <td>
                        <select class="form-select form-select-sm status-select"
                                data-id="${c.id}" style="width:135px;">
                            <option value="pending"     ${c.status === 'pending'     ? 'selected' : ''}>Pending</option>
                            <option value="published"   ${c.status === 'published'   ? 'selected' : ''}>Published</option>
                            <option value="unpublished" ${c.status === 'unpublished' ? 'selected' : ''}>Unpublished</option>
                        </select>
                    </td>
                    <td>${c.created_at}</td>
                    <td>
                        <a href="#" class="p-2 d-inline-flex align-items-center border rounded delete-comment-btn"
                           data-id="${c.id}" data-bs-toggle="modal" data-bs-target="#delete_modal" title="Delete">
                            <i class="ti ti-trash"></i>
                        </a>
                    </td>
                </tr>
            `).join('');

            // Pagination info
            const from = (currentPg - 1) * perPage + 1;
            const to   = Math.min(currentPg * perPage, total);
            paginationInfo.textContent = `Showing ${from}–${to} of ${total} comment${total !== 1 ? 's' : ''}`;

            renderPagination(currentPg, lastPage);
            paginationBar.style.display = 'flex';

            bindActions();
            if (window.feather) feather.replace();
        }

        // ── Pagination links ──────────────────────────────────────
        function renderPagination(current, last) {
            if (last <= 1) {
                paginationLinks.innerHTML = '';
                return;
            }

            let html = '';

            // Prev
            html += `<li class="page-item ${current === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${current - 1}">&laquo;</a>
            </li>`;

            // Page numbers with ellipsis
            buildPageRange(current, last).forEach(p => {
                if (p === '...') {
                    html += `<li class="page-item disabled"><span class="page-link">…</span></li>`;
                } else {
                    html += `<li class="page-item ${p === current ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${p}">${p}</a>
                    </li>`;
                }
            });

            // Next
            html += `<li class="page-item ${current === last ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${current + 1}">&raquo;</a>
            </li>`;

            paginationLinks.innerHTML = html;

            paginationLinks.querySelectorAll('a.page-link[data-page]').forEach(a => {
                a.addEventListener('click', function (e) {
                    e.preventDefault();
                    const p = parseInt(this.dataset.page);
                    if (p >= 1 && p <= last && p !== current) {
                        currentPage = p;
                        fetchComments();
                    }
                });
            });
        }

        function buildPageRange(current, last) {
            if (last <= 7) return Array.from({ length: last }, (_, i) => i + 1);
            const pages = [];
            if (current <= 4) {
                for (let i = 1; i <= 5; i++) pages.push(i);
                pages.push('...'); pages.push(last);
            } else if (current >= last - 3) {
                pages.push(1); pages.push('...');
                for (let i = last - 4; i <= last; i++) pages.push(i);
            } else {
                pages.push(1); pages.push('...');
                for (let i = current - 1; i <= current + 1; i++) pages.push(i);
                pages.push('...'); pages.push(last);
            }
            return pages;
        }

        // ── Fetch ─────────────────────────────────────────────────
        function fetchComments() {
            console.trace('fetchComments called with status: ' + activeStatus);
            tbody.innerHTML = `<tr><td colspan="7" class="text-center py-4 text-muted">
                <div class="spinner-border spinner-border-sm me-2" role="status"></div>Loading...
            </td></tr>`;
            paginationBar.style.display = 'none';

            const q = searchInput.value.trim();
            const url = `${commentSearchUrl}?q=${encodeURIComponent(q)}&status=${encodeURIComponent(activeStatus)}&page=${currentPage}`;

            fetch(url)
                .then(r => {
                    if (!r.ok) {
                        return r.text().then(t => { throw new Error(`HTTP ${r.status}: ${t.substring(0, 200)}`); });
                    }
                    return r.json();
                })
                .then(data => renderRows(data))
                .catch(err => {
                    console.error('Comment fetch error:', err);
                    tbody.innerHTML = `<tr><td colspan="7" class="text-center py-4 text-danger">
                        Failed to load comments: ${err.message}
                    </td></tr>`;
                });
        }

        // ── Search ────────────────────────────────────────────────
        searchInput.addEventListener('input', function () {
            clearBtn.style.display = this.value ? 'block' : 'none';
            clearTimeout(debounceTimer);
            currentPage = 1;
            debounceTimer = setTimeout(fetchComments, 300);
        });

        clearBtn.addEventListener('click', function () {
            searchInput.value = '';
            clearBtn.style.display = 'none';
            currentPage = 1;
            fetchComments();
            searchInput.focus();
        });

        // ── Status filter ─────────────────────────────────────────
        document.querySelectorAll('.status-filter').forEach(item => {
            item.addEventListener('click', function () {
                activeStatus = this.dataset.status;
                document.getElementById('statusLabel').textContent = this.textContent.trim();
                currentPage = 1;
                fetchComments();
            });
        });

        // ── Delete confirm ────────────────────────────────────────
        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (!pendingDeleteId) return;
            fetch(`/admin/blog/comments/${pendingDeleteId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: '_method=DELETE',
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('delete_modal'));
                    modal.hide();
                    document.getElementById('delete_modal').addEventListener('hidden.bs.modal', function handler() {
                        fetchComments();
                        iziToast.success({ message: data.message, position: 'topRight', timeout: 4000 });
                        this.removeEventListener('hidden.bs.modal', handler);
                    });
                    pendingDeleteId = null;
                }
            });
        });

        // ── Bind row actions ──────────────────────────────────────
        function bindActions() {
            document.querySelectorAll('.status-select').forEach(sel => {
                sel.addEventListener('change', function () {
                    const id = this.dataset.id;
                    fetch(`/admin/blog/comments/${id}/status`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `_method=PATCH&status=${this.value}`,
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            iziToast.success({ message: data.message, position: 'topRight', timeout: 3000 });
                        }
                    });
                });
            });

            document.querySelectorAll('.delete-comment-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    pendingDeleteId = this.dataset.id;
                });
            });
        }

        // Initial load — fetch all comments
        fetchComments();
    });
</script>
@endpush
