{{-- Beautiful Modal Component --}}
{{-- Usage: @include('layouts.components.beautiful-modal', ['id' => 'modal-id', 'title' => 'Modal Title', 'content' => 'Content here']) --}}

<div class="modal-imm" id="{{ $id }}">
    <div class="modal-imm-content">
        <div class="modal-imm-header">
            <h3 class="modal-imm-title">{{ $title }}</h3>
            <button class="modal-imm-close" onclick="closeModal('{{ $id }}')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-imm-body">
            {{ $slot }}
        </div>
        @if(isset($footer) || isset($buttons))
        <div class="modal-imm-footer">
            {{ $footer ?? $buttons ?? '' }}
        </div>
        @endif
    </div>
</div>

<script>
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-imm')) {
            e.target.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-imm.active').forEach(modal => {
                modal.classList.remove('active');
            });
            document.body.style.overflow = 'auto';
        }
    });
</script>
