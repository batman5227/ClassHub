{{-- Beautiful Toast Notification Component --}}
{{-- Usage: showToast('Title', 'Message', 'success|error|warning|info') --}}

<div id="toast-container"></div>

<script>
    function showToast(title, message, type = 'info') {
        const container = document.getElementById('toast-container');

        const toast = document.createElement('div');
        toast.className = `toast-imm toast-imm-${type}`;

        let icon = '';
        switch(type) {
            case 'success':
                icon = '<i class="fas fa-check-circle"></i>';
                break;
            case 'error':
                icon = '<i class="fas fa-times-circle"></i>';
                break;
            case 'warning':
                icon = '<i class="fas fa-exclamation-triangle"></i>';
                break;
            default:
                icon = '<i class="fas fa-info-circle"></i>';
        }

        toast.innerHTML = `
            <div class="toast-imm-icon">${icon}</div>
            <div class="toast-imm-content">
                <div class="toast-imm-title">${title}</div>
                <div class="toast-imm-message">${message}</div>
            </div>
            <button class="toast-imm-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        `;

        container.appendChild(toast);

        // Show toast
        setTimeout(() => {
            toast.classList.add('show');
        }, 10);

        // Auto hide after 5 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 5000);
    }

    // Show toast from session
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            showToast('Succès', '{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            showToast('Erreur', '{{ session('error') }}', 'error');
        @endif

        @if(session('warning'))
            showToast('Attention', '{{ session('warning') }}', 'warning');
        @endif

        @if(session('info'))
            showToast('Info', '{{ session('info') }}', 'info');
        @endif
    });
</script>

<style>
    #toast-container {
        position: fixed;
        top: 25px;
        right: 25px;
        z-index: 10000;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
</style>
