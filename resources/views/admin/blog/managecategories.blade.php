@extends('layouts.admin')

@section('content')
<div class="content">

    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4>Blog Categories</h4>
                <h6>Manage your blog categories</h6>
            </div>
        </div>
        <div class="page-btn">
            <a href="#add_blog-category" data-bs-toggle="modal" class="btn btn-added">
                <i class="ti ti-circle-plus me-1"></i>Add Category
            </a>
        </div>
    </div>

    <div class="card table-list-card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-input" style="position: relative;">
                        <input type="text" id="liveSearch" placeholder="Search categories..." class="form-control form-control-sm formsearch" autocomplete="off" style="padding-right: 60px;">
                        <button type="button" id="clearSearch" title="Clear" style="display:none; position:absolute; right:36px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#999; z-index:10; line-height:1;">
                            <i class="ti ti-x fs-14"></i>
                        </button>
                        <a class="btn btn-searchset" style="position:absolute; right:8px; top:50%; transform:translateY(-50%); z-index:9;"><i data-feather="search" class="feather-14"></i></a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table datanew" id="categoriesTable">
                    <thead class="thead-light">
                        <tr>
                            <th class="no-sort">
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th class="no-sort">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $index => $category)
                        <tr>
                            <td>
                                <label class="checkboxs">
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>
                                </label>
                            </td>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                @if($category->status)
                                    <span class="badge badge-success"><i class="ti ti-point-filled"></i> Active</span>
                                @else
                                    <span class="badge badge-danger"><i class="ti ti-point-filled"></i> Inactive</span>
                                @endif
                            </td>
                            <td>{{ $category->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="action-icon d-inline-flex">
                                    <a href="#"
                                       class="p-2 d-flex align-items-center border rounded me-2 edit-btn"
                                       data-id="{{ $category->id }}"
                                       data-name="{{ $category->name }}"
                                       data-status="{{ $category->status }}"
                                       data-bs-toggle="modal"
                                       data-bs-target="#edit_blog-category">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a href="#"
                                       class="p-2 d-flex align-items-center border rounded delete-btn"
                                       data-id="{{ $category->id }}"
                                       data-bs-toggle="modal"
                                       data-bs-target="#delete_modal">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No categories found. Add your first category.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="add_blog-category">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Blog Category</h4>
                <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.blog.categories.store') }}" method="POST">
                @csrf
                <div class="modal-body pb-0">
                    <div class="mb-3">
                        <label class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <label class="form-label mb-0">Status</label>
                        <label class="switch">
                            <input type="checkbox" name="status" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add Category Modal -->

<!-- Edit Category Modal -->
<div class="modal fade" id="edit_blog-category">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Blog Category</h4>
                <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form id="edit-form" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body pb-0">
                    <div class="mb-3">
                        <label class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit-name" class="form-control" required>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <label class="form-label mb-0">Status</label>
                        <label class="switch">
                            <input type="checkbox" name="status" id="edit-status">
                            <span class="slider round"></span>
                        </label>
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
<!-- /Edit Category Modal -->

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-soft-danger rounded-circle text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Delete Category</h4>
                <p class="mb-3">Are you sure you want to delete this category?</p>
                <form id="delete-form" action="" method="POST">
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
<!-- /Delete Modal -->

<script>
    const searchUrl = "{{ route('admin.blog.categories.search') }}";

    document.addEventListener('DOMContentLoaded', function () {

        const searchInput = document.getElementById('liveSearch');
        const clearBtn    = document.getElementById('clearSearch');
        const tbody       = document.querySelector('#categoriesTable tbody');
        let debounceTimer;

        function renderRows(categories) {
            if (categories.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7" class="text-center py-4 text-muted">
                    <i class="ti ti-mood-sad fs-24 d-block mb-1"></i>No categories found matching your search.
                </td></tr>`;
                return;
            }
            tbody.innerHTML = categories.map((cat, i) => `
                <tr>
                    <td><label class="checkboxs"><input type="checkbox"><span class="checkmarks"></span></label></td>
                    <td>${i + 1}</td>
                    <td>${cat.name}</td>
                    <td>${cat.slug}</td>
                    <td>${cat.status
                        ? '<span class="badge badge-success"><i class="ti ti-point-filled"></i> Active</span>'
                        : '<span class="badge badge-danger"><i class="ti ti-point-filled"></i> Inactive</span>'}</td>
                    <td>${cat.created_at}</td>
                    <td>
                        <div class="action-icon d-inline-flex">
                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2 edit-btn"
                               data-id="${cat.id}" data-name="${cat.name}" data-status="${cat.status}"
                               data-bs-toggle="modal" data-bs-target="#edit_blog-category">
                                <i class="ti ti-edit"></i>
                            </a>
                            <a href="#" class="p-2 d-flex align-items-center border rounded delete-btn"
                               data-id="${cat.id}"
                               data-bs-toggle="modal" data-bs-target="#delete_modal">
                                <i class="ti ti-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            `).join('');
            bindModalButtons();
            if (window.feather) feather.replace();
        }

        searchInput.addEventListener('input', function () {
            const q = this.value.trim();
            clearBtn.style.display = q ? 'block' : 'none';
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                fetch(`${searchUrl}?q=${encodeURIComponent(q)}`)
                    .then(r => r.json())
                    .then(data => renderRows(data.categories));
            }, 300);
        });

        clearBtn.addEventListener('click', function () {
            searchInput.value = '';
            clearBtn.style.display = 'none';
            searchInput.dispatchEvent(new Event('input'));
            searchInput.focus();
        });

        function bindModalButtons() {
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.getElementById('edit-name').value = this.dataset.name;
                    document.getElementById('edit-status').checked = this.dataset.status == '1';
                    document.getElementById('edit-form').action = `/admin/blog/manage-categories/${this.dataset.id}`;
                });
            });
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.getElementById('delete-form').action = `/admin/blog/manage-categories/${this.dataset.id}`;
                });
            });
        }

        bindModalButtons();

        document.getElementById('select-all').addEventListener('change', function () {
            document.querySelectorAll('tbody input[type="checkbox"]').forEach(cb => cb.checked = this.checked);
        });
    });
</script>

@endsection
