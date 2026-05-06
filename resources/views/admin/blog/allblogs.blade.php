@extends('layouts.admin')

@section('content')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.min.css" rel="stylesheet">
@endpush


<div class="content">

    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4>Blogs</h4>
                <h6>Manage your blogs</h6>
            </div>
        </div>
        <div class="page-btn">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_blog">
                <i class="ti ti-circle-plus me-1"></i>Add Blog
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                <div class="search-input" style="position: relative; min-width: 280px;">
                    <input type="text" id="blogSearch" class="form-control formsearch" placeholder="Search blogs..." autocomplete="off" style="padding-right: 60px;">
                    <button type="button" id="clearBlogSearch" title="Clear" style="display:none; position:absolute; right:36px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#999; z-index:10;">
                        <i class="ti ti-x fs-14"></i>
                    </button>
                    <a class="btn btn-searchset" style="position:absolute; right:8px; top:50%; transform:translateY(-50%); z-index:9;">
                        <i data-feather="search" class="feather-14"></i>
                    </a>
                </div>
                <div class="d-flex align-items-center flex-wrap row-gap-3">
                    <div class="dropdown me-3">
                        <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
                            <span id="statusLabel">Active</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3">
                            <li><a href="javascript:void(0);" class="dropdown-item rounded-1 status-filter" data-status="">All</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item rounded-1 status-filter" data-status="1">Active</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item rounded-1 status-filter" data-status="0">Inactive</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
                            Sort By : Latest
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3">
                            <li><a href="javascript:void(0);" class="dropdown-item rounded-1">Recently Added</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item rounded-1">Ascending</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item rounded-1">Descending</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Cards -->
    <div class="row" id="blogGrid">
        @forelse($blogs as $blog)
        <div class="col-xxl-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="img-sec w-100 position-relative mb-3">
                        <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('dashboard_assets/img/bg/hero.jpg') }}"
                             class="img-fluid rounded w-100" alt="img" style="height:200px; object-fit:cover;">
                        <div class="mt-1 d-flex align-items-center justify-content-between">
                            <span class="badge bg-soft-info shadow-none fs-10 fw-medium">{{ $blog->category->name ?? 'Uncategorized' }}</span>
                            @if($blog->status)
                                <span class="badge badge-success"><i class="ti ti-point-filled"></i> Active</span>
                            @else
                                <span class="badge badge-danger"><i class="ti ti-point-filled"></i> Inactive</span>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="d-flex align-items-center text-muted fs-13">
                            <i class="ti ti-calendar me-1"></i> {{ $blog->created_at->format('d M Y') }}
                        </span>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('admin.blog.show', $blog->id) }}" class="p-1 d-flex align-items-center me-1" title="View Details">
                                <i class="ti ti-eye"></i>
                            </a>
                            <a href="#" class="p-1 d-flex align-items-center me-1 edit-blog-btn"
                               data-id="{{ $blog->id }}"
                               data-title="{{ $blog->title }}"
                               data-category="{{ $blog->category_id }}"
                               data-excerpt="{{ $blog->excerpt }}"
                               data-description="{{ e($blog->description) }}"
                               data-tags="{{ $blog->tags }}"
                               data-status="{{ $blog->status ? 1 : 0 }}"
                               data-featured="{{ $blog->featured ? 1 : 0 }}"
                               data-meta-title="{{ $blog->meta_title }}"
                               data-meta-description="{{ $blog->meta_description }}"
                               data-image="{{ $blog->image ? asset('storage/' . $blog->image) : '' }}"
                               data-bs-toggle="modal" data-bs-target="#edit_blog">
                                <i class="ti ti-edit"></i>
                            </a>
                            <a href="#" class="p-1 d-flex align-items-center delete-blog-btn"
                               data-id="{{ $blog->id }}"
                               data-bs-toggle="modal" data-bs-target="#delete_modal">
                                <i class="ti ti-trash"></i>
                            </a>
                        </div>
                    </div>
                    <h5 class="fs-15 text-truncate mb-0">{{ $blog->title }}</h5>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted" id="emptyState">
            <i class="ti ti-article fs-36 d-block mb-2"></i>
            No blogs found. Add your first blog post.
        </div>
        @endforelse
    </div>

</div>

<!-- Add Blog Modal -->
<div class="modal fade" id="add_blog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Blog</h4>
                <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal"><i class="ti ti-x"></i></button>
            </div>
            <form id="add-blog-form" action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Featured Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">Max 2MB. JPG, PNG accepted.</small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Blog Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tags</label>
                            <input type="text" name="tags" class="form-control" placeholder="Comma separated e.g. laravel, php">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Excerpt</label>
                            <input type="text" name="excerpt" class="form-control" placeholder="Short summary">
                        </div>
              <div class="col-md-12 mb-3">
    <label class="form-label">Description <span class="text-danger">*</span></label>
    <div id="add-description-editor" style="height: 200px;"></div>
    <input type="hidden" name="description" id="add-description-input">
</div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Description</label>
                            <input type="text" name="meta_description" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label mb-0">Status</label>
                                <label class="switch ms-2">
                                    <input type="checkbox" name="status" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label mb-0">Featured</label>
                                <label class="switch ms-2">
                                    <input type="checkbox" name="featured">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Blog</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add Blog Modal -->

<!-- Edit Blog Modal -->
<div class="modal fade" id="edit_blog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Blog</h4>
                <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal"><i class="ti ti-x"></i></button>
            </div>
            <form id="edit-blog-form" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Featured Image</label>
                            <div id="edit-current-image" class="mb-2" style="display:none;">
                                <img id="edit-image-preview" src="" alt="Current Image" class="img-fluid rounded" style="max-height:120px; object-fit:cover;">
                                <p class="text-muted fs-12 mt-1">Current image — upload a new one to replace it.</p>
                            </div>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">Leave empty to keep current image.</small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Blog Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="edit-title" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" id="edit-category" class="form-select">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tags</label>
                            <input type="text" name="tags" id="edit-tags" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Excerpt</label>
                            <input type="text" name="excerpt" id="edit-excerpt" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
    <label class="form-label">Description <span class="text-danger">*</span></label>
    <div id="edit-description-editor" style="height: 200px;"></div>
    <input type="hidden" name="description" id="edit-description">
</div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" id="edit-meta-title" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Description</label>
                            <input type="text" name="meta_description" id="edit-meta-description" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label mb-0">Status</label>
                                <label class="switch ms-2">
                                    <input type="checkbox" name="status" id="edit-status">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label mb-0">Featured</label>
                                <label class="switch ms-2">
                                    <input type="checkbox" name="featured" id="edit-featured">
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
<!-- /Edit Blog Modal -->

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-soft-danger rounded-circle text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Delete Blog</h4>
                <p class="mb-3">Are you sure you want to delete this blog?</p>
                <form id="delete-blog-form" action="#" method="POST">
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

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.min.js"></script>
<script>
    const blogSearchUrl = "{{ route('admin.blog.search') }}";
    const csrfToken     = "{{ csrf_token() }}";
    let activeStatus    = '1';

    window.iziToastInitialized = true;

    // ── Init Quill editors ────────────────────────────────────────
    const quillOptions = {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['blockquote', 'code-block'],
                ['link'],
                [{ align: [] }],
                ['clean']
            ]
        }
    };

    const addQuill  = new Quill('#add-description-editor', quillOptions);
    const editQuill = new Quill('#edit-description-editor', quillOptions);

    document.addEventListener('DOMContentLoaded', function () {

        const searchInput = document.getElementById('blogSearch');
        const clearBtn    = document.getElementById('clearBlogSearch');
        const grid        = document.getElementById('blogGrid');
        let debounceTimer;

        // ── Render cards ──────────────────────────────────────────
        function renderCards(blogs) {
            if (blogs.length === 0) {
                grid.innerHTML = `<div class="col-12 text-center py-5 text-muted">
                    <i class="ti ti-mood-sad fs-36 d-block mb-2"></i>No blogs found.
                </div>`;
                return;
            }
            grid.innerHTML = blogs.map(b => `
                <div class="col-xxl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="img-sec w-100 position-relative mb-3">
                                <img src="${b.image}" class="img-fluid rounded w-100" style="height:200px;object-fit:cover;" alt="">
                                <div class="mt-1 d-flex align-items-center justify-content-between">
                                    <span class="badge bg-soft-info shadow-none fs-10 fw-medium">${b.category}</span>
                                    ${b.status
                                        ? '<span class="badge badge-success"><i class="ti ti-point-filled"></i> Active</span>'
                                        : '<span class="badge badge-danger"><i class="ti ti-point-filled"></i> Inactive</span>'}
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted fs-13"><i class="ti ti-calendar me-1"></i>${b.created_at}</span>
                                <div class="d-flex align-items-center">
                                    <a href="/admin/blog/${b.id}" class="p-1 d-flex align-items-center me-1" title="View Details">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                    <a href="#" class="p-1 d-flex align-items-center me-1 edit-blog-btn"
                                       data-id="${b.id}" data-title="${b.title}"
                                       data-category="${b.category_id || ''}"
                                       data-excerpt="${b.excerpt || ''}"
                                       data-description="${(b.description || '').replace(/"/g, '&quot;')}"
                                       data-tags="${b.tags || ''}" data-status="${b.status}"
                                       data-featured="${b.featured}"
                                       data-meta-title="${b.meta_title || ''}"
                                       data-meta-description="${b.meta_description || ''}"
                                       data-image="${b.image}"
                                       data-bs-toggle="modal" data-bs-target="#edit_blog">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a href="#" class="p-1 d-flex align-items-center delete-blog-btn"
                                       data-id="${b.id}"
                                       data-bs-toggle="modal" data-bs-target="#delete_modal">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </div>
                            </div>
                            <h5 class="fs-15 text-truncate mb-0">${b.title}</h5>
                        </div>
                    </div>
                </div>
            `).join('');
            bindModalButtons();
            if (window.feather) feather.replace();
        }

        // ── Fetch blogs ───────────────────────────────────────────
        function fetchBlogs() {
            const q = searchInput.value.trim();
            fetch(`${blogSearchUrl}?q=${encodeURIComponent(q)}&status=${activeStatus}`)
                .then(r => r.json())
                .then(data => renderCards(data.blogs));
        }

        // ── Search ────────────────────────────────────────────────
        searchInput.addEventListener('input', function () {
            clearBtn.style.display = this.value ? 'block' : 'none';
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(fetchBlogs, 300);
        });

        clearBtn.addEventListener('click', function () {
            searchInput.value = '';
            clearBtn.style.display = 'none';
            fetchBlogs();
            searchInput.focus();
        });

        // ── Status filter ─────────────────────────────────────────
        document.querySelectorAll('.status-filter').forEach(item => {
            item.addEventListener('click', function () {
                activeStatus = this.dataset.status;
                document.getElementById('statusLabel').textContent =
                    activeStatus === '' ? 'Select Status' : (activeStatus === '1' ? 'Active' : 'Inactive');
                fetchBlogs();
            });
        });

        // ── Add Blog (AJAX) ───────────────────────────────────────
        document.getElementById('add-blog-form').addEventListener('submit', function (e) {
            e.preventDefault();
            // Sync Quill HTML into the hidden input before submitting
            document.getElementById('add-description-input').value = addQuill.root.innerHTML;

            fetch(this.action, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken },
                body: new FormData(this),
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    bootstrap.Modal.getInstance(document.getElementById('add_blog')).hide();
                    this.reset();
                    addQuill.setContents([]); // Clear Quill editor
                    fetchBlogs();
                    iziToast.success({ message: data.message, position: 'topRight', timeout: 4000 });
                }
            });
        });

        // ── Edit Blog (AJAX) ──────────────────────────────────────
        document.getElementById('edit-blog-form').addEventListener('submit', function (e) {
            e.preventDefault();
            // Sync Quill HTML into the hidden input before submitting
            document.getElementById('edit-description').value = editQuill.root.innerHTML;

            const formData = new FormData(this);
            formData.append('_method', 'PUT');
            fetch(this.action, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken },
                body: formData,
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    bootstrap.Modal.getInstance(document.getElementById('edit_blog')).hide();
                    fetchBlogs();
                    iziToast.success({ message: data.message, position: 'topRight', timeout: 4000 });
                }
            });
        });

        // ── Delete Blog (AJAX) ────────────────────────────────────
        document.getElementById('delete-blog-form').addEventListener('submit', function (e) {
            e.preventDefault();
            fetch(this.action, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/x-www-form-urlencoded' },
                body: '_method=DELETE',
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    bootstrap.Modal.getInstance(document.getElementById('delete_modal')).hide();
                    fetchBlogs();
                    iziToast.success({ message: data.message, position: 'topRight', timeout: 4000 });
                }
            });
        });

        // ── Bind modal buttons ────────────────────────────────────
        function bindModalButtons() {
            document.querySelectorAll('.edit-blog-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.getElementById('edit-title').value            = this.dataset.title || '';
                    document.getElementById('edit-excerpt').value          = this.dataset.excerpt || '';
                    document.getElementById('edit-tags').value             = this.dataset.tags || '';
                    document.getElementById('edit-meta-title').value       = this.dataset.metaTitle || '';
                    document.getElementById('edit-meta-description').value = this.dataset.metaDescription || '';
                    document.getElementById('edit-status').checked         = this.dataset.status == '1';
                    document.getElementById('edit-featured').checked       = this.dataset.featured == '1';

                    // Load description into Quill (supports HTML content)
                    editQuill.root.innerHTML = this.dataset.description || '';

                    const catSelect = document.getElementById('edit-category');
                    if (catSelect) catSelect.value = this.dataset.category || '';

                    const previewWrap = document.getElementById('edit-current-image');
                    const previewImg  = document.getElementById('edit-image-preview');
                    if (this.dataset.image && !this.dataset.image.includes('hero.jpg')) {
                        previewImg.src = this.dataset.image;
                        previewWrap.style.display = 'block';
                    } else {
                        previewWrap.style.display = 'none';
                    }
                    document.getElementById('edit-blog-form').action = `/admin/blog/${this.dataset.id}`;
                });
            });

            document.querySelectorAll('.delete-blog-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.getElementById('delete-blog-form').action = `/admin/blog/${this.dataset.id}`;
                });
            });
        }

        bindModalButtons();
        fetchBlogs();

    }); // end DOMContentLoaded
</script>

@endpush
