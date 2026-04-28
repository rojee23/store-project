<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<!-- Toast Script -->
@if(session('toast'))
<script>
    const toastData = {!! session('toast') !!};
    showToast(toastData.type, toastData.message);
</script>
@endif

<script>
function showToast(type, message) {
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;

    let icon = '';
    if(type === 'success') icon = 'fas fa-check-circle';
    else if(type === 'error') icon = 'fas fa-times-circle';
    else if(type === 'info') icon = 'fas fa-info-circle';
    else if(type === 'warning') icon = 'fas fa-exclamation-triangle';

    toast.innerHTML = `<i class="${icon}"></i><span>${message}</span>`;
    container.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 4000);
}
</script>
