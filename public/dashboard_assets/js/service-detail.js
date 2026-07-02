/**
 * service-detail.js
 * Handles:
 *  1. Tab persistence via sessionStorage
 *  2. Quill editors — inline editors on DOMContentLoaded,
 *     modal editors lazily on first show.bs.modal (fixes hidden-element rendering)
 *  3. Image / avatar live preview
 *  4. Modal add/edit wiring (form action, method field, field pre-fill)
 */

// ─────────────────────────────────────────────
// QUILL TOOLBAR CONFIG (shared)
// ─────────────────────────────────────────────
var QUILL_TOOLBAR = [
    [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
    ['bold', 'italic', 'underline', 'strike'],
    [{ color: [] }, { background: [] }],
    [{ list: 'ordered' }, { list: 'bullet' }],
    [{ align: [] }],
    ['link', 'image'],
    ['clean']
];

// ─────────────────────────────────────────────
// HELPERS
// ─────────────────────────────────────────────

/**
 * Mount a Quill instance on an element.
 * Guards against double-mounting with data-quill-mounted flag.
 * Stores the instance on el.__quill for later access.
 */
function mountQuill(editorEl) {
    if (!editorEl) return null;
    if (editorEl.getAttribute('data-quill-mounted') === '1') return editorEl.__quill;

    editorEl.setAttribute('data-quill-mounted', '1');

    var inputId = editorEl.getAttribute('data-quill-input');
    var inputEl = document.getElementById(inputId);

    var quill = new Quill(editorEl, {
        theme: 'snow',
        placeholder: 'Write here...',
        modules: { toolbar: QUILL_TOOLBAR }
    });

    editorEl.__quill = quill;

    // Pre-fill with existing content from the hidden input
    if (inputEl && inputEl.value && inputEl.value.trim() !== '') {
        quill.clipboard.dangerouslyPasteHTML(inputEl.value);
    }

    // Sync Quill HTML → hidden input on form submit
    var form = editorEl.closest('form');
    if (form && inputEl) {
        form.addEventListener('submit', function () {
            inputEl.value = quill.root.innerHTML;
        });
    }

    return quill;
}

/** Decode HTML entities from a data-* attribute (e.g. &lt;p&gt; → <p>) */
function decodeHtml(str) {
    var txt = document.createElement('textarea');
    txt.innerHTML = str || '';
    return txt.value;
}

/** Set Quill content from HTML string, also syncs the hidden input */
function setQuill(editorEl, inputId, html) {
    if (!editorEl) return;
    // Lazily mount if not yet initialised (modal was hidden on page load)
    var quill = editorEl.__quill || mountQuill(editorEl);
    if (!quill) return;

    var decoded = decodeHtml(html);
    quill.clipboard.dangerouslyPasteHTML(decoded);

    var inputEl = document.getElementById(inputId);
    if (inputEl) inputEl.value = decoded;
}

/** Inject or remove a hidden _method spoofing field */
function setMethod(containerId, method) {
    var container = document.getElementById(containerId);
    if (!container) return;
    container.innerHTML = method
        ? '<input type="hidden" name="_method" value="' + method + '">'
        : '';
}

// ─────────────────────────────────────────────
// DOM READY
// ─────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function () {

    // ── 1. TAB PERSISTENCE ──
    // Uses sessionStorage so the URL never changes and refresh
    // doesn't cause a 404.
    var TAB_KEY = 'svc_detail_tab_' + window.location.pathname;
    var tabLinks = document.querySelectorAll('#detailTabs .nav-link');

    var savedTab = sessionStorage.getItem(TAB_KEY);
    if (savedTab) {
        var savedLink = document.querySelector('#detailTabs .nav-link[href="' + savedTab + '"]');
        if (savedLink) {
            tabLinks.forEach(function (l) {
                l.classList.remove('active');
                var pane = document.querySelector(l.getAttribute('href'));
                if (pane) pane.classList.remove('show', 'active');
            });
            savedLink.classList.add('active');
            var savedPane = document.querySelector(savedTab);
            if (savedPane) savedPane.classList.add('show', 'active');
        }
    }

    tabLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            sessionStorage.setItem(TAB_KEY, this.getAttribute('href'));
        });
    });


    // ── 2. INLINE QUILL EDITORS ──
    // Only mount editors that are NOT inside a modal (visible on page load).
    // Modal editors are mounted lazily on show.bs.modal below.
    if (typeof Quill !== 'undefined') {
        document.querySelectorAll('[data-quill-editor]').forEach(function (editorEl) {
            // Skip editors inside modals — they'll be mounted on first open
            if (editorEl.closest('.modal')) return;
            mountQuill(editorEl);
        });
    }


    // ── 3. IMAGE / AVATAR LIVE PREVIEW ──
    document.querySelectorAll('input[type="file"][data-preview-target]').forEach(function (input) {
        input.addEventListener('change', function () {
            if (!this.files || !this.files[0]) return;

            var imgEl = document.querySelector(this.getAttribute('data-preview-target'));
            if (!imgEl) return;

            var wrapSel = this.getAttribute('data-preview-wrap');
            var reader = new FileReader();

            reader.onload = function (e) {
                imgEl.src = e.target.result;
                if (wrapSel) {
                    var wrap = document.querySelector(wrapSel);
                    if (wrap) wrap.style.display = 'block';
                }
            };

            reader.readAsDataURL(this.files[0]);
        });
    });


    // ── 4. MODAL WIRING ──
    // Each modal reads data-store-url and data-update-base from its own div.
    // On show.bs.modal:
    //   - Modal Quill editors are lazily mounted (first open only)
    //   - Add mode: clear fields, POST action
    //   - Edit mode: pre-fill fields from data-* attrs, PATCH action

    // ── BENEFIT MODAL ──
    var benefitModal = document.getElementById('benefitModal');
    if (benefitModal) {
        var bStoreUrl   = benefitModal.getAttribute('data-store-url') || '';
        var bUpdateBase = benefitModal.getAttribute('data-update-base') || '';
        var bEditor     = document.getElementById('b_description_editor');

        benefitModal.addEventListener('show.bs.modal', function (e) {
            // Guard: only run if this is the services benefit modal (b_* IDs must exist)
            if (!document.getElementById('b_section_heading')) return;

            // Lazily mount Quill on first open
            if (typeof Quill !== 'undefined') mountQuill(bEditor);

            var btn  = e.relatedTarget;
            var mode = btn ? btn.getAttribute('data-mode') : 'add';
            var form = document.getElementById('benefitForm');

            document.getElementById('benefitModalTitle').textContent =
                mode === 'edit' ? 'Edit Benefit' : 'Add Benefit';

            if (mode === 'edit') {
                form.action = bUpdateBase + '/' + btn.getAttribute('data-id');
                setMethod('benefitMethodField', 'PATCH');
                document.getElementById('b_section_heading').value  = btn.getAttribute('data-section-heading') || '';
                document.getElementById('b_section_subtitle').value = btn.getAttribute('data-section-subtitle') || '';
                document.getElementById('b_title').value            = btn.getAttribute('data-title') || '';
                document.getElementById('b_sort').value             = btn.getAttribute('data-sort') || 0;
                setQuill(bEditor, 'b_description_input', btn.getAttribute('data-description') || '');
            } else {
                form.action = bStoreUrl;
                setMethod('benefitMethodField', null);
                document.getElementById('b_section_heading').value  = '';
                document.getElementById('b_section_subtitle').value = '';
                document.getElementById('b_title').value            = '';
                document.getElementById('b_sort').value             = 0;
                setQuill(bEditor, 'b_description_input', '');
            }
            feather.replace();
        });
    }

    // ── PROCESS MODAL ──
    var processModal = document.getElementById('processModal');
    if (processModal) {
        var pStoreUrl   = processModal.getAttribute('data-store-url') || '';
        var pUpdateBase = processModal.getAttribute('data-update-base') || '';
        var pEditor     = document.getElementById('p_description_editor');

        processModal.addEventListener('show.bs.modal', function (e) {
            // Guard: only run if this is the services process modal (p_* IDs must exist)
            if (!document.getElementById('p_section_heading')) return;

            if (typeof Quill !== 'undefined') mountQuill(pEditor);

            var btn  = e.relatedTarget;
            var mode = btn ? btn.getAttribute('data-mode') : 'add';
            var form = document.getElementById('processForm');

            document.getElementById('processModalTitle').textContent =
                mode === 'edit' ? 'Edit Process Step' : 'Add Process Step';

            if (mode === 'edit') {
                form.action = pUpdateBase + '/' + btn.getAttribute('data-id');
                setMethod('processMethodField', 'PATCH');
                document.getElementById('p_section_heading').value  = btn.getAttribute('data-section-heading') || '';
                document.getElementById('p_section_subtitle').value = btn.getAttribute('data-section-subtitle') || '';
                document.getElementById('p_title').value            = btn.getAttribute('data-title') || '';
                document.getElementById('p_sort').value             = btn.getAttribute('data-sort') || 0;
                setQuill(pEditor, 'p_description_input', btn.getAttribute('data-description') || '');
            } else {
                form.action = pStoreUrl;
                setMethod('processMethodField', null);
                document.getElementById('p_section_heading').value  = '';
                document.getElementById('p_section_subtitle').value = '';
                document.getElementById('p_title').value            = '';
                document.getElementById('p_sort').value             = 0;
                setQuill(pEditor, 'p_description_input', '');
            }
            feather.replace();
        });
    }

    // ── TECH GROUP MODAL ──
    var techGroupModal = document.getElementById('techGroupModal');
    if (techGroupModal) {
        var tgStoreUrl   = techGroupModal.getAttribute('data-store-url') || '';
        var tgUpdateBase = techGroupModal.getAttribute('data-update-base') || '';

        techGroupModal.addEventListener('show.bs.modal', function (e) {
            var btn  = e.relatedTarget;
            var mode = btn ? btn.getAttribute('data-mode') : 'add';
            var form = document.getElementById('techGroupForm');

            document.getElementById('techGroupModalTitle').textContent =
                mode === 'edit' ? 'Edit Tech Group' : 'Add Tech Group';

            if (mode === 'edit') {
                form.action = tgUpdateBase + '/' + btn.getAttribute('data-id');
                setMethod('techGroupMethodField', 'PATCH');
                document.getElementById('tg_section_heading').value  = btn.getAttribute('data-section-heading') || '';
                document.getElementById('tg_section_subtitle').value = btn.getAttribute('data-section-subtitle') || '';
                document.getElementById('tg_group_name').value       = btn.getAttribute('data-group-name') || '';
                document.getElementById('tg_sort').value             = btn.getAttribute('data-sort') || 0;
            } else {
                form.action = tgStoreUrl;
                setMethod('techGroupMethodField', null);
                document.getElementById('tg_section_heading').value  = '';
                document.getElementById('tg_section_subtitle').value = '';
                document.getElementById('tg_group_name').value       = '';
                document.getElementById('tg_sort').value             = 0;
            }
        });
    }

    // ── TESTIMONIAL MODAL ──
    var testimonialModal = document.getElementById('testimonialModal');
    if (testimonialModal) {
        var tmStoreUrl   = testimonialModal.getAttribute('data-store-url') || '';
        var tmUpdateBase = testimonialModal.getAttribute('data-update-base') || '';

        testimonialModal.addEventListener('show.bs.modal', function (e) {
            var btn  = e.relatedTarget;
            var mode = btn ? btn.getAttribute('data-mode') : 'add';
            var form = document.getElementById('testimonialForm');

            document.getElementById('testimonialModalTitle').textContent =
                mode === 'edit' ? 'Edit Testimonial' : 'Add Testimonial';

            if (mode === 'edit') {
                form.action = tmUpdateBase + '/' + btn.getAttribute('data-id');
                setMethod('testimonialMethodField', 'PATCH');
                document.getElementById('t_section_heading').value  = btn.getAttribute('data-section-heading') || '';
                document.getElementById('t_section_subtitle').value = btn.getAttribute('data-section-subtitle') || '';
                document.getElementById('t_quote').value            = btn.getAttribute('data-quote') || '';
                document.getElementById('t_client_name').value      = btn.getAttribute('data-client-name') || '';
                document.getElementById('t_client_role').value      = btn.getAttribute('data-client-role') || '';
                document.getElementById('t_rating').value           = btn.getAttribute('data-rating') || 5;
                document.getElementById('t_sort').value             = btn.getAttribute('data-sort') || 0;
            } else {
                form.action = tmStoreUrl;
                setMethod('testimonialMethodField', null);
                ['t_section_heading', 't_section_subtitle', 't_quote', 't_client_name', 't_client_role']
                    .forEach(function (id) { document.getElementById(id).value = ''; });
                document.getElementById('t_rating').value = 5;
                document.getElementById('t_sort').value   = 0;
            }
        });
    }

    // ── FAQ MODAL ──
    var faqModal = document.getElementById('faqModal');
    if (faqModal) {
        var fStoreUrl   = faqModal.getAttribute('data-store-url') || '';
        var fUpdateBase = faqModal.getAttribute('data-update-base') || '';
        var fEditor     = document.getElementById('f_answer_editor');

        faqModal.addEventListener('show.bs.modal', function (e) {
            // Guard: only run if this is the services faq modal (f_* IDs must exist)
            if (!document.getElementById('f_section_heading')) return;

            if (typeof Quill !== 'undefined') mountQuill(fEditor);

            var btn  = e.relatedTarget;
            var mode = btn ? btn.getAttribute('data-mode') : 'add';
            var form = document.getElementById('faqForm');

            document.getElementById('faqModalTitle').textContent =
                mode === 'edit' ? 'Edit FAQ' : 'Add FAQ';

            if (mode === 'edit') {
                form.action = fUpdateBase + '/' + btn.getAttribute('data-id');
                setMethod('faqMethodField', 'PATCH');
                document.getElementById('f_section_heading').value  = btn.getAttribute('data-section-heading') || '';
                document.getElementById('f_section_subtitle').value = btn.getAttribute('data-section-subtitle') || '';
                document.getElementById('f_question').value         = btn.getAttribute('data-question') || '';
                document.getElementById('f_sort').value             = btn.getAttribute('data-sort') || 0;
                setQuill(fEditor, 'f_answer_input', btn.getAttribute('data-answer') || '');
            } else {
                form.action = fStoreUrl;
                setMethod('faqMethodField', null);
                document.getElementById('f_section_heading').value  = '';
                document.getElementById('f_section_subtitle').value = '';
                document.getElementById('f_question').value         = '';
                document.getElementById('f_sort').value             = 0;
                setQuill(fEditor, 'f_answer_input', '');
            }
        });
    }

});
