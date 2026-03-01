/**
 * ClassHub - Classes Module JavaScript
 * Professional modals and interactive features
 */

(function() {
    'use strict';

    // ============================================
    // Modal Manager Class
    // ============================================
    class ClasseModalManager {
        constructor() {
            this.modals = document.querySelectorAll('.classe-modal');
            this.init();
        }

        init() {
            this.modals.forEach(modal => {
                modal.addEventListener('show.bs.modal', (e) => {
                    this.onModalShow(e);
                });
                modal.addEventListener('hidden.bs.modal', (e) => {
                    this.onModalHidden(e);
                });
            });
        }

        onModalShow(event) {
            const button = event.relatedTarget;
            if (button) {
                const modal = event.target;
                const title = modal.querySelector('.modal-title');
                const icon = button.getAttribute('data-modal-icon') || 'ri-information-line';

                if (title && !button.getAttribute('data-modal-title')) {
                    title.innerHTML = `<i class="${icon} me-2"></i>${title.textContent}`;
                }
            }
        }

        onModalHidden(event) {
            // Reset form if exists
            const form = event.target.querySelector('form');
            if (form) {
                form.reset();
                form.classList.remove('was-validated');
            }
        }

        // Show modal programmatically
        show(modalId, options = {}) {
            const modal = document.getElementById(modalId);
            if (modal) {
                const bsModal = new bootstrap.Modal(modal);
                bsModal.show(options);
            }
        }

        // Hide modal programmatically
        hide(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                const bsModal = bootstrap.Modal.getInstance(modal);
                if (bsModal) {
                    bsModal.hide();
                }
            }
        }
    }

    // ============================================
    // Toast Notification System
    // ============================================
    class ClasseToast {
        constructor() {
            this.container = null;
            this.createContainer();
        }

        createContainer() {
            if (!document.getElementById('classe-toast-container')) {
                this.container = document.createElement('div');
                this.container.id = 'classe-toast-container';
                this.container.className = 'classe-toast-container';
                document.body.appendChild(this.container);
            } else {
                this.container = document.getElementById('classe-toast-container');
            }
        }

        show(message, type = 'info', duration = 4000) {
            const toast = document.createElement('div');
            toast.className = `classe-toast classe-toast-${type}`;

            const icons = {
                success: 'ri-check-line',
                error: 'ri-error-warning-line',
                warning: 'ri-alert-line',
                info: 'ri-information-line'
            };

            toast.innerHTML = `
                <i class="${icons[type] || icons.info}"></i>
                <span>${message}</span>
                <button type="button" class="btn-close ms-auto" onclick="classeToast.hide(this.parentElement)">
                    <i class="ri-close-line"></i>
                </button>
            `;

            this.container.appendChild(toast);

            // Auto hide
            setTimeout(() => {
                this.hide(toast);
            }, duration);

            return toast;
        }

        hide(toast) {
            if (toast && toast.parentElement) {
                toast.style.animation = 'slideOutRight 0.3s ease-out forwards';
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }
        }

        success(message, duration) {
            return this.show(message, 'success', duration);
        }

        error(message, duration) {
            return this.show(message, 'error', duration);
        }

        warning(message, duration) {
            return this.show(message, 'warning', duration);
        }

        info(message, duration) {
            return this.show(message, 'info', duration);
        }
    }

    // ============================================
    // Confirmation Dialog
    // ============================================
    class ClasseConfirm {
        constructor() {
            this.modalTemplate = `
                <div class="modal fade classe-modal classe-modal-danger" id="classe-confirm-modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <i class="ri-alert-line me-2"></i>
                                    <span data-modal-title>Confirmation</span>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center py-4">
                                <div class="confirm-icon mb-3">
                                    <i class="ri-error-warning-line text-danger" style="font-size: 4rem;"></i>
                                </div>
                                <p class="mb-0" id="classe-confirm-message">Êtes-vous sûr de vouloir effectuer cette action?</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                    <i class="ri-arrow-left-line me-1"></i> Annuler
                                </button>
                                <button type="button" class="btn btn-danger" id="classe-confirm-btn">
                                    <i class="ri-check-line me-1"></i> Confirmer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            this.createModal();
        }

        createModal() {
            if (!document.getElementById('classe-confirm-modal')) {
                document.body.insertAdjacentHTML('beforeend', this.modalTemplate);
            }
        }

        show(options = {}) {
            return new Promise((resolve) => {
                const modal = document.getElementById('classe-confirm-modal');
                const messageEl = document.getElementById('classe-confirm-message');
                const confirmBtn = document.getElementById('classe-confirm-btn');
                const titleEl = modal.querySelector('[data-modal-title]');

                // Set custom message
                messageEl.textContent = options.message || 'Êtes-vous sûr de vouloir effectuer cette action?';

                // Set custom title
                titleEl.textContent = options.title || 'Confirmation';

                // Handle confirm button click
                const handleConfirm = () => {
                    resolve(true);
                    bsModal.hide();
                    confirmBtn.removeEventListener('click', handleConfirm);
                };

                confirmBtn.addEventListener('click', handleConfirm);

                // Show modal
                const bsModal = new bootstrap.Modal(modal);
                bsModal.show();
            });
        }
    }

    // ============================================
    // Form Handler
    // ============================================
    class ClasseFormHandler {
        constructor() {
            this.forms = document.querySelectorAll('.classe-form');
            this.init();
        }

        init() {
            this.forms.forEach(form => {
                form.addEventListener('submit', (e) => this.handleSubmit(e));
            });
        }

        handleSubmit(event) {
            const form = event.target;
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }

        validate(formElement) {
            if (formElement.checkValidity()) {
                return true;
            }
            formElement.classList.add('was-validated');
            return false;
        }

        showErrors(errors) {
            Object.keys(errors).forEach(field => {
                const input = document.querySelector(`[name="${field}"]`);
                if (input) {
                    input.classList.add('is-invalid');
                    const feedback = input.parentElement.querySelector('.invalid-feedback');
                    if (feedback) {
                        feedback.textContent = errors[field];
                    }
                }
            });
        }

        clearErrors() {
            const inputs = document.querySelectorAll('.is-invalid');
            inputs.forEach(input => {
                input.classList.remove('is-invalid');
            });
        }
    }

    // ============================================
    // Table Actions Handler
    // ============================================
    class ClasseTableActions {
        constructor() {
            this.init();
        }

        init() {
            // Delete confirmation
            document.addEventListener('click', (e) => {
                const deleteBtn = e.target.closest('[data-action="delete"]');
                if (deleteBtn) {
                    e.preventDefault();
                    this.handleDelete(deleteBtn);
                }

                const confirmBtn = e.target.closest('[data-action="confirm-delete"]');
                if (confirmBtn) {
                    e.preventDefault();
                    this.handleConfirmDelete(confirmBtn);
                }
            });
        }

        async handleDelete(button) {
            const form = button.closest('form');
            const message = button.getAttribute('data-message') || 'Êtes-vous sûr de vouloir supprimer cet élément?';
            const title = button.getAttribute('data-title') || 'Confirmation de suppression';

            const confirmed = await classeConfirm.show({ message, title });

            if (confirmed) {
                if (form) {
                    form.submit();
                } else {
                    const url = button.getAttribute('href');
                    if (url && url !== '#') {
                        window.location.href = url;
                    }
                }
            }
        }

        async handleConfirmDelete(button) {
            const message = button.getAttribute('data-message') || 'Êtes-vous sûr de vouloir supprimer cet élément?';
            const title = button.getAttribute('data-title') || 'Confirmation de suppression';

            const confirmed = await classeConfirm.show({ message, title });

            if (confirmed) {
                const url = button.getAttribute('data-url');
                const method = button.getAttribute('data-method') || 'DELETE';
                const csrf = button.getAttribute('data-csrf');

                try {
                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Content-Type': 'application/json'
                        }
                    });

                    if (response.ok) {
                        classeToast.success('Élément supprimé avec succès!');
                        // Reload page or remove row
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        throw new Error('Erreur lors de la suppression');
                    }
                } catch (error) {
                    classeToast.error('Erreur lors de la suppression');
                }
            }
        }
    }

    // ============================================
    // Search & Filter
    // ============================================
    class ClasseSearchFilter {
        constructor() {
            this.searchInput = document.getElementById('classe-search');
            this.filterSelect = document.getElementById('classe-filter');
            this.table = document.getElementById('classes-table');
            this.rows = this.table ? this.table.querySelectorAll('tbody tr') : [];
            this.init();
        }

        init() {
            if (this.searchInput) {
                this.searchInput.addEventListener('input', (e) => this.search(e.target.value));
            }
            if (this.filterSelect) {
                this.filterSelect.addEventListener('change', (e) => this.filter(e.target.value));
            }
        }

        search(query) {
            query = query.toLowerCase();
            this.rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        }

        filter(value) {
            this.rows.forEach(row => {
                if (!value || value === '') {
                    row.style.display = '';
                } else {
                    const filterValue = row.getAttribute(`data-filter-${this.filterSelect.name}`);
                    row.style.display = filterValue === value ? '' : 'none';
                }
            });
        }
    }

    // ============================================
    // Bulk Actions
    // ============================================
    class ClasseBulkActions {
        constructor() {
            this.checkboxes = document.querySelectorAll('.classe-checkbox');
            this.bulkActions = document.querySelector('.classe-bulk-actions');
            this.selectAll = document.getElementById('classe-select-all');
            this.init();
        }

        init() {
            if (this.selectAll) {
                this.selectAll.addEventListener('change', (e) => this.selectAllRows(e.target.checked));
            }

            this.checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => this.updateBulkActions());
            });
        }

        selectAllRows(checked) {
            this.checkboxes.forEach(checkbox => {
                checkbox.checked = checked;
            });
            this.updateBulkActions();
        }

        updateBulkActions() {
            const checked = document.querySelectorAll('.classe-checkbox:checked');
            if (this.bulkActions) {
                if (checked.length > 0) {
                    this.bulkActions.classList.add('show');
                    const countEl = this.bulkActions.querySelector('.selected-count');
                    if (countEl) {
                        countEl.textContent = checked.length;
                    }
                } else {
                    this.bulkActions.classList.remove('show');
                }
            }
        }

        getSelectedIds() {
            const checked = document.querySelectorAll('.classe-checkbox:checked');
            return Array.from(checked).map(c => c.value);
        }
    }

    // ============================================
    // Initialize on DOM Ready
    // ============================================
    let classeModalManager;
    let classeToast;
    let classeConfirm;
    let classeFormHandler;
    let classeTableActions;
    let classeSearchFilter;
    let classeBulkActions;

    document.addEventListener('DOMContentLoaded', function() {
        classeModalManager = new ClasseModalManager();
        classeToast = new ClasseToast();
        classeConfirm = new ClasseConfirm();
        classeFormHandler = new ClasseFormHandler();
        classeTableActions = new ClasseTableActions();
        classeSearchFilter = new ClasseSearchFilter();
        classeBulkActions = new ClasseBulkActions();

        // Show toast from session flash data
        const toastData = document.querySelector('[data-toast-message]');
        if (toastData) {
            const message = toastData.getAttribute('data-toast-message');
            const type = toastData.getAttribute('data-toast-type') || 'info';
            classeToast.show(message, type);
        }
    });

    // Expose to global scope
    window.classeToast = {
        show: (msg, type) => classeToast.show(msg, type),
        success: (msg) => classeToast.success(msg),
        error: (msg) => classeToast.error(msg),
        warning: (msg) => classeToast.warning(msg),
        info: (msg) => classeToast.info(msg)
    };

    window.classeConfirm = {
        show: (options) => classeConfirm.show(options)
    };

    window.classeModal = {
        show: (id) => classeModalManager.show(id),
        hide: (id) => classeModalManager.hide(id)
    };

})();
