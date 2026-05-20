@extends('layouts.admin')

@section('content')
<div class="content">

  <div class="page-header">
    <div class="page-title">
      <h4>Technologies</h4>
      <h6>Manage technology pages</h6>
    </div>
    <div class="page-btn">
      <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addTechModal">
        <i class="ti ti-circle-plus me-1"></i>Add Technology
      </a>
    </div>
  </div>

  <div class="card">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Slug</th>
              <th>Icon</th>
              <th>Order</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @forelse($technologies as $tech)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td><strong>{{ $tech->name }}</strong></td>
              <td><code>{{ $tech->slug }}</code></td>
              <td>
                @if($tech->icon)
                <i class="{{ $tech->icon }} fs-18"></i>
                <small class="text-muted ms-1">{{ $tech->icon }}</small>
                @else
                <span class="text-muted">—</span>
                @endif
              </td>
              <td>{{ $tech->sort_order }}</td>
              <td>
                @if($tech->is_active)
                <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                  <i class="ti ti-point-filled me-1"></i>Active
                </span>
                @else
                <span class="badge badge-danger d-inline-flex align-items-center badge-xs">
                  <i class="ti ti-point-filled me-1"></i>Inactive
                </span>
                @endif
              </td>
              <td class="action-table-data">
                <div class="edit-delete-action">
                  {{-- Open the tabbed detail editor --}}
                  <a class="me-2 p-2" href="{{ route('admin.technologies.detail', $tech) }}"
                    title="Edit detail sections">
                    <i data-feather="layers" class="feather-14"></i>
                  </a>
                  {{-- Edit basic info --}}
                  <a class="me-2 p-2" href="#"
                    data-bs-toggle="modal" data-bs-target="#editTechModal"
                    data-id="{{ $tech->id }}"
                    data-slug="{{ $tech->slug }}"
                    data-name="{{ $tech->name }}"
                    data-icon="{{ $tech->icon }}"
                    data-short-description="{{ $tech->short_description }}"
                    data-meta-title="{{ $tech->meta_title }}"
                    data-meta-description="{{ $tech->meta_description }}"
                    data-sort="{{ $tech->sort_order }}"
                    data-active="{{ $tech->is_active ? '1' : '0' }}">
                    <i data-feather="edit" class="feather-14"></i>
                  </a>
                  <form action="{{ route('admin.technologies.destroy', $tech) }}"
                    method="POST" onsubmit="return confirm('Delete this technology and all its sections?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="p-2 border-0 bg-transparent text-danger">
                      <i data-feather="trash-2" class="feather-14"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="text-center text-muted py-4">No technologies yet.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($technologies->hasPages())
      <div class="d-flex justify-content-end p-3">
        {{ $technologies->links() }}
      </div>
      @endif
    </div>
  </div>

</div>

{{-- ── ADD MODAL ── --}}
<div class="modal fade" id="addTechModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Technology</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('admin.technologies.store') }}" method="POST"
        data-submit-spinner data-spinner-text="Creating...">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control"
              placeholder="e.g. Laravel" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Icon <small class="text-muted">(Tabler icon class)</small></label>
            <input type="text" name="icon" class="form-control"
              placeholder="e.g. ti ti-brand-laravel">
            <small class="text-muted">Browse at <a href="https://tabler.io/icons" target="_blank">tabler.io/icons</a></small>
          </div>
          <div class="mb-3">
            <label class="form-label">Short Description <small class="text-muted">(shown in nav menu)</small></label>
            <input type="text" name="short_description" class="form-control"
              placeholder="e.g. Elegant PHP solutions for modern web apps" maxlength="120">
          </div>
          <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control"
              placeholder="SEO page title">
          </div>
          <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control" rows="2"
              placeholder="SEO page description"></textarea>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="0" min="0">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Status</label>
                <div class="form-check form-switch mt-2">
                  <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                  <label class="form-check-label">Active</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex gap-2">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary">Save Technology</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ── EDIT MODAL ── --}}
<div class="modal fade" id="editTechModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Technology</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="editTechForm" method="POST" data-submit-spinner data-spinner-text="Updating...">
        @csrf @method('PATCH')
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="et_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Icon</label>
            <input type="text" name="icon" id="et_icon" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Short Description <small class="text-muted">(shown in nav menu)</small></label>
            <input type="text" name="short_description" id="et_short_description" class="form-control" maxlength="120">
          </div>
          <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" id="et_meta_title" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" id="et_meta_description" class="form-control" rows="2"></textarea>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" id="et_sort" class="form-control" min="0">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Status</label>
                <div class="form-check form-switch mt-2">
                  <input class="form-check-input" type="checkbox" name="is_active" id="et_active" value="1">
                  <label class="form-check-label">Active</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex gap-2">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary">Update Technology</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
  // Pre-fill the edit modal with the clicked row's data
  document.getElementById('editTechModal').addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    const form = document.getElementById('editTechForm');

    form.action = `/admin/technologies/${btn.dataset.slug}`;

    document.getElementById('et_name').value = btn.dataset.name || '';
    document.getElementById('et_icon').value = btn.dataset.icon || '';
    document.getElementById('et_short_description').value = btn.dataset.shortDescription || '';
    document.getElementById('et_meta_title').value = btn.dataset.metaTitle || '';
    document.getElementById('et_meta_description').value = btn.dataset.metaDescription || '';
    document.getElementById('et_sort').value = btn.dataset.sort || 0;
    document.getElementById('et_active').checked = btn.dataset.active === '1';
  });
</script>
@endpush

@endsection
