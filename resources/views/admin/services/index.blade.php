@extends('layouts.admin')

@section('content')
<div class="content">

  <div class="page-header">
    <div class="page-title">
      <h4>Services</h4>
      <h6>Manage your services</h6>
    </div>
    <div class="page-btn">
      <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
        <i class="ti ti-circle-plus me-1"></i>Add Service
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
              <th>Category</th>
              <th>Short Description</th>
              <th>Badge</th>
              <th>Order</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @forelse($services as $service)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                <strong>{{ $service->name }}</strong>
                <br>
                <code class="text-muted fs-11">{{ $service->slug }}</code>
              </td>
              <td>
                <span class="badge bg-light text-dark border">
                  {{ $service->category->name }}
                </span>
              </td>
              <td>
                <span class="text-muted"
                  style="max-width:220px; display:block; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                  {{ $service->short_description ?? '—' }}
                </span>
              </td>
              <td>
                @if ($service->badge === 'hot')
                <span class="badge bg-danger">HOT 🔥</span>
                @elseif($service->badge === 'new')
                <span class="badge bg-success">NEW</span>
                @else
                <span class="text-muted">—</span>
                @endif
              </td>
              <td>{{ $service->sort_order }}</td>
              <td>
                @if ($service->is_active)
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
                  {{-- Link to the tabbed detail editor for this service --}}
                  <a class="me-2 p-2" href="{{ route('admin.services.detail', $service) }}"
                    title="Edit detail sections">
                    <i data-feather="layers" class="feather-14"></i>
                  </a>
                  
                  <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                    data-bs-target="#editServiceModal" data-id="{{ $service->id }}"
                    data-category="{{ $service->service_category_id }}"
                    data-name="{{ $service->name }}"
                    data-short="{{ $service->short_description }}"
                    data-badge="{{ $service->badge }}" data-sort="{{ $service->sort_order }}"
                    data-active="{{ $service->is_active ? '1' : '0' }}">
                    <i data-feather="edit" class="feather-14"></i>
                  </a>
                  <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                    onsubmit="return confirm('Delete this service?')">
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
              <td colspan="8" class="text-center text-muted py-4">
                No services yet. Add your first one!
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if ($services->hasPages())
      <div class="d-flex justify-content-end p-3">
        {{ $services->links() }}
      </div>
      @endif

    </div>
  </div>
</div>

{{-- ── ADD MODAL ── --}}
<div class="modal fade" id="addServiceModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('admin.services.store') }}" method="POST" data-submit-spinner data-spinner-text="Creating Service...">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Category <span class="text-danger">*</span></label>
            <select name="service_category_id" class="form-select" required>
              <option value="">Select category</option>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control"
              placeholder="e.g. Blockchain Development" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Short Description</label>
            <textarea name="short_description" class="form-control" rows="2"
              placeholder="Brief description shown in the nav menu" maxlength="255"></textarea>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Badge</label>
                <select name="badge" class="form-select">
                  <option value="none">None</option>
                  <option value="hot">HOT 🔥</option>
                  <option value="new">NEW</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="0"
                  min="0">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="form-check form-switch mt-1">
              <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
              <label class="form-check-label">Active</label>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex gap-2">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary">Save Service</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ── EDIT MODAL ── --}}
<div class="modal fade" id="editServiceModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="editServiceForm" method="POST" data-submit-spinner data-spinner-text="Updating Service...">
        @csrf @method('PATCH')
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Category <span class="text-danger">*</span></label>
            <select name="service_category_id" id="edit_category" class="form-select" required>
              <option value="">Select category</option>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="edit_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Short Description</label>
            <textarea name="short_description" id="edit_short" class="form-control" rows="2" maxlength="255"></textarea>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Badge</label>
                <select name="badge" id="edit_badge" class="form-select">
                  <option value="none">None</option>
                  <option value="hot">HOT 🔥</option>
                  <option value="new">NEW</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" id="edit_sort" class="form-control"
                  min="0">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="form-check form-switch mt-1">
              <input class="form-check-input" type="checkbox" name="is_active" id="edit_active"
                value="1">
              <label class="form-check-label">Active</label>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex gap-2">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary">Update Service</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.getElementById('editServiceModal').addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    const form = document.getElementById('editServiceForm');

    form.action = `/admin/services/${btn.dataset.id}`;

    document.getElementById('edit_category').value = btn.dataset.category;
    document.getElementById('edit_name').value = btn.dataset.name;
    document.getElementById('edit_short').value = btn.dataset.short || '';
    document.getElementById('edit_badge').value = btn.dataset.badge || 'none';
    document.getElementById('edit_sort').value = btn.dataset.sort;
    document.getElementById('edit_active').checked = btn.dataset.active === '1';
  });
</script>
@endpush
@endsection
