@extends('layouts.admin')

@section('content')
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h4>Service Categories</h4>
                <h6>Manage your service categories</h6>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="ti ti-circle-plus me-1"></i>Add Category
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
                                <th>Services</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $category->name }}</strong></td>
                                    <td><code>{{ $category->slug }}</code></td>
                                    <td>
                                        @if ($category->icon)
                                            <i class="{{ $category->icon }} fs-18"></i>
                                            <small class="text-muted ms-1">{{ $category->icon }}</small>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $category->services_count }}</span>
                                    </td>
                                    <td>{{ $category->sort_order }}</td>
                                    <td>
                                        @if ($category->is_active)
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
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#editCategoryModal" data-id="{{ $category->id }}"
                                                data-name="{{ $category->name }}" data-icon="{{ $category->icon }}"
                                                data-sort="{{ $category->sort_order }}"
                                                data-active="{{ $category->is_active ? '1' : '0' }}">
                                                <i data-feather="edit" class="feather-14"></i>
                                            </a>
                                            <form action="{{ route('admin.services.categories.destroy', $category) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this category? All services under it will also be deleted.')">
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
                                        No categories yet. Add your first one!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($categories->hasPages())
                    <div class="p-3">
                        {{ $categories->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>

    {{-- ── ADD MODAL ── --}}
    <div class="modal fade" id="addCategoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Service Category</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.services.categories.store') }}" method="POST" data-submit-spinner
                    data-spinner-text="Saving Category...">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Web3 Services"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon <small class="text-muted">(Tabler icon class)</small></label>
                            <input type="text" name="icon" class="form-control" placeholder="e.g. ti ti-coin-bitcoin">
                            <small class="text-muted">Browse icons at <a href="https://tabler.io/icons"
                                    target="_blank">tabler.io/icons</a></small>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" name="sort_order" class="form-control" value="0"
                                        min="0">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                            checked>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex gap-2">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-secondary">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ── EDIT MODAL ── --}}
    <div class="modal fade" id="editCategoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Service Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editCategoryForm" method="POST" data-submit-spinner data-spinner-text="Updating Category...">
                    @csrf @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon <small class="text-muted">(Tabler icon class)</small></label>
                            <input type="text" name="icon" id="edit_icon" class="form-control"
                                placeholder="e.g. ti ti-coin-bitcoin">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" name="sort_order" id="edit_sort" class="form-control"
                                        min="0">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" name="is_active"
                                            id="edit_active" value="1">
                                        <label class="form-check-label">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex gap-2">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-secondary">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('editCategoryModal').addEventListener('show.bs.modal', function(e) {
                const btn = e.relatedTarget;
                const form = document.getElementById('editCategoryForm');

                form.action = `/admin/services/categories/${btn.dataset.id}`;
                document.getElementById('edit_name').value = btn.dataset.name;
                document.getElementById('edit_icon').value = btn.dataset.icon || '';
                document.getElementById('edit_sort').value = btn.dataset.sort;
                document.getElementById('edit_active').checked = btn.dataset.active === '1';
            });
        </script>
    @endpush
@endsection
