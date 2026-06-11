@extends('layouts.admin')

@section('content')
<div class="content">

  <div class="page-header">
    <div class="page-title">
      <h4>CV Submissions</h4>
      <h6>CVs submitted via the careers page</h6>
    </div>
    <div class="page-btn">
      <span class="badge bg-primary fs-13">{{ $submissions->total() }} total</span>
    </div>
  </div>

  <div class="card">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table mb-0">
          <thead class="thead-light">
            <tr>
              <th>Applicant</th>
              <th>Position</th>
              <th>CV File</th>
              <th>Size</th>
              <th style="width:140px;">Status</th>
              <th style="width:100px;">Submitted</th>
              <th style="width:100px;">Actions</th>
            </tr>
          </thead>
          <tbody id="cvBody">
            @forelse ($submissions as $sub)
            <tr data-id="{{ $sub->id }}">
              <td>
                <div class="fw-medium">{{ $sub->name }}</div>
                <small class="text-muted">{{ $sub->email }}</small>
                @if ($sub->phone)
                <br><small class="text-muted">{{ $sub->phone }}</small>
                @endif
              </td>
              <td class="text-muted fs-13">{{ $sub->position ?? '—' }}</td>
              <td>
                <a href="{{ route('admin.cv-submissions.download', $sub->id) }}"
                  class="d-flex align-items-center gap-2 text-primary fw-medium"
                  style="font-size:13px;">
                  <i class="ti ti-file-download fs-18"></i>
                  {{ Str::limit($sub->cv_original_name, 28) }}
                </a>
              </td>
              <td class="text-muted fs-13">{{ $sub->file_size_formatted }}</td>
              <td>
                <span class="badge badge-{{ $sub->status_color }} cv-status-badge"
                  id="status-badge-{{ $sub->id }}">
                  {{ $sub->status_label }}
                </span>
              </td>
              <td class="text-muted fs-13">{{ $sub->created_at->format('d M Y') }}</td>
              <td>
                <div class="d-flex align-items-center gap-1">
                  <a href="#" class="p-1 view-btn"
                    data-id="{{ $sub->id }}"
                    data-name="{{ $sub->name }}"
                    data-email="{{ $sub->email }}"
                    data-phone="{{ $sub->phone }}"
                    data-position="{{ $sub->position }}"
                    data-message="{{ $sub->message }}"
                    data-cv-name="{{ $sub->cv_original_name }}"
                    data-submitted="{{ $sub->created_at->format('d M Y H:i') }}"
                    data-status="{{ $sub->status }}"
                    data-admin-notes="{{ $sub->admin_notes }}"
                    data-bs-toggle="modal" data-bs-target="#view_modal"
                    title="View details">
                    <i class="ti ti-eye"></i>
                  </a>
                  <a href="{{ route('admin.cv-submissions.download', $sub->id) }}"
                    class="p-1" title="Download CV">
                    <i class="ti ti-download"></i>
                  </a>
                  <a href="#" class="p-1 delete-btn"
                    data-id="{{ $sub->id }}"
                    data-bs-toggle="modal" data-bs-target="#delete_modal"
                    title="Delete">
                    <i class="ti ti-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            @empty
            <tr id="emptyRow">
              <td colspan="7" class="text-center py-5 text-muted">
                <i class="ti ti-file-description fs-36 d-block mb-2"></i>
                No CV submissions yet.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    @if ($submissions->hasPages())
    <div class="card-footer d-flex align-items-center justify-content-between flex-wrap row-gap-2">
      <p class="text-muted fs-13 mb-0">
        Showing {{ $submissions->firstItem() }}–{{ $submissions->lastItem() }} of {{ $submissions->total() }}
      </p>
      <ul class="pagination pagination-sm mb-0">
        <li class="page-item {{ $submissions->onFirstPage() ? 'disabled' : '' }}">
          <a class="page-link" href="{{ $submissions->previousPageUrl() ?? '#' }}">&laquo;</a>
        </li>
        @foreach ($submissions->getUrlRange(1, $submissions->lastPage()) as $page => $url)
        <li class="page-item {{ $page == $submissions->currentPage() ? 'active' : '' }}">
          <a class="page-link" href="{{ $url }}">{{ $page }}</a>
        </li>
        @endforeach
        <li class="page-item {{ !$submissions->hasMorePages() ? 'disabled' : '' }}">
          <a class="page-link" href="{{ $submissions->nextPageUrl() ?? '#' }}">&raquo;</a>
        </li>
      </ul>
    </div>
    @endif
  </div>
</div>

{{-- ── VIEW / STATUS MODAL ── --}}
<div class="modal fade" id="view_modal">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">CV Submission Details</h4>
        <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal">
          <i class="ti ti-x"></i>
        </button>
      </div>
      <div class="modal-body">

        {{-- Applicant info --}}
        <div class="row g-3 mb-4">
          <div class="col-sm-6">
            <label class="form-label text-muted fs-12 mb-1">Full Name</label>
            <div id="v-name" class="fw-medium"></div>
          </div>
          <div class="col-sm-6">
            <label class="form-label text-muted fs-12 mb-1">Email</label>
            <div id="v-email"></div>
          </div>
          <div class="col-sm-6">
            <label class="form-label text-muted fs-12 mb-1">Phone</label>
            <div id="v-phone" class="text-muted">—</div>
          </div>
          <div class="col-sm-6">
            <label class="form-label text-muted fs-12 mb-1">Applying for</label>
            <div id="v-position" class="text-muted">—</div>
          </div>
          <div class="col-sm-6">
            <label class="form-label text-muted fs-12 mb-1">Submitted</label>
            <div id="v-submitted" class="text-muted fs-13"></div>
          </div>
          <div class="col-sm-6">
            <label class="form-label text-muted fs-12 mb-1">CV File</label>
            <div id="v-cv-download"></div>
          </div>
        </div>

        {{-- Message --}}
        <div class="mb-4" id="v-message-wrap" style="display:none;">
          <label class="form-label text-muted fs-12 mb-1">Cover Note / Message</label>
          <div id="v-message" class="p-3 bg-light rounded fs-13" style="line-height:1.7; white-space:pre-wrap;"></div>
        </div>

        <hr>

        {{-- Status update form --}}
        <form id="status-form">
          <div class="row g-3">
            <div class="col-sm-6">
              <label class="form-label fw-medium">Update Status</label>
              <select id="v-status" name="status" class="form-select">
                <option value="new">New</option>
                <option value="reviewed">Reviewed</option>
                <option value="shortlisted">Shortlisted</option>
                <option value="rejected">Rejected</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label fw-medium">Admin Notes</label>
              <textarea id="v-admin-notes" name="admin_notes" class="form-control" rows="3"
                placeholder="Internal notes (not visible to applicant)..."></textarea>
            </div>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
        <button type="button" id="save-status-btn" class="btn btn-primary">Save Status</button>
      </div>
    </div>
  </div>
</div>

{{-- ── DELETE MODAL ── --}}
<div class="modal fade" id="delete_modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <span class="avatar avatar-xl bg-soft-danger rounded-circle text-danger mb-3">
          <i class="ti ti-trash-x fs-36"></i>
        </span>
        <h4 class="mb-1">Delete Submission</h4>
        <p class="mb-3">This will permanently delete the record and the CV file. This cannot be undone.</p>
        <div class="d-flex justify-content-center">
          <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Cancel</button>
          <button type="button" id="confirm-delete-btn" class="btn btn-primary">Yes, Delete</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  const CV_BASE = "{{ url('admin/cv-submissions') }}";
  const csrfToken = "{{ csrf_token() }}";
  let currentId = null;
  let deleteBusy = false;
  let statusBusy = false;
  const tbody = document.getElementById('cvBody');

  // ── VIEW MODAL ────────────────────────────────────────────
  tbody.addEventListener('click', function(e) {
    const viewBtn = e.target.closest('.view-btn');
    if (viewBtn) {
      const d = viewBtn.dataset;
      currentId = d.id;

      document.getElementById('v-name').textContent = d.name || '—';
      document.getElementById('v-email').textContent = d.email || '—';
      document.getElementById('v-phone').textContent = d.phone || '—';
      document.getElementById('v-position').textContent = d.position || '—';
      document.getElementById('v-submitted').textContent = d.submitted || '—';
      document.getElementById('v-admin-notes').value = d.adminNotes || '';
      document.getElementById('v-status').value = d.status || 'new';

      // CV download link
      document.getElementById('v-cv-download').innerHTML =
        `<a href="${CV_BASE}/${d.id}/download" class="btn btn-sm btn-outline-primary">
                <i class="ti ti-download me-1"></i>${d.cvName}
             </a>`;

      // Message
      const msgWrap = document.getElementById('v-message-wrap');
      const msg = (d.message || '').trim();
      if (msg) {
        document.getElementById('v-message').textContent = msg;
        msgWrap.style.display = 'block';
      } else {
        msgWrap.style.display = 'none';
      }
    }

    // ── DELETE ────────────────────────────────────────────
    const delBtn = e.target.closest('.delete-btn');
    if (delBtn) {
      currentId = delBtn.dataset.id;
    }
  });

  // Save status
  document.getElementById('save-status-btn').addEventListener('click', function() {
    if (statusBusy || !currentId) return;
    statusBusy = true;

    const status = document.getElementById('v-status').value;
    const notes = document.getElementById('v-admin-notes').value;

    fetch(`${CV_BASE}/${currentId}/status`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `_method=PATCH&status=${encodeURIComponent(status)}&admin_notes=${encodeURIComponent(notes)}`,
      })
      .then(r => r.json())
      .then(data => {
        statusBusy = false;
        if (data.success) {
          bootstrap.Modal.getInstance(document.getElementById('view_modal')).hide();
          iziToast.success({
            message: data.message,
            position: 'topRight'
          });

          // Update badge in row
          const badge = document.getElementById(`status-badge-${currentId}`);
          if (badge) {
            badge.className = `badge badge-${data.status_color} cv-status-badge`;
            badge.textContent = data.status_label;
          }
        }
      })
      .catch(() => {
        statusBusy = false;
      });
  });

  // Confirm delete
  document.getElementById('confirm-delete-btn').addEventListener('click', function() {
    if (deleteBusy || !currentId) return;
    deleteBusy = true;

    fetch(`${CV_BASE}/${currentId}`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: '_method=DELETE',
      })
      .then(r => r.json())
      .then(data => {
        deleteBusy = false;
        if (data.success) {
          bootstrap.Modal.getInstance(document.getElementById('delete_modal')).hide();
          iziToast.success({
            message: data.message,
            position: 'topRight'
          });
          const row = tbody.querySelector(`tr[data-id="${currentId}"]`);
          if (row) row.remove();
          if (!tbody.querySelector('tr')) {
            tbody.innerHTML = `<tr id="emptyRow">
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="ti ti-file-description fs-36 d-block mb-2"></i>
                        No CV submissions yet.
                    </td></tr>`;
          }
        }
      })
      .catch(() => {
        deleteBusy = false;
      });
  });
</script>
@endpush