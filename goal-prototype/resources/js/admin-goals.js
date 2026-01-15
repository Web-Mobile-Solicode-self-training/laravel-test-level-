// --- 1. Modal Logic ---
window.openModal = () => {
    document.getElementById('hs-modal-add-goal')?.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
};

window.closeModal = () => {
    document.getElementById('hs-modal-add-goal')?.classList.add('hidden');
    document.body.style.overflow = 'auto';
};

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('ajax-search');
    const tableBody = document.getElementById('table-body');
    const addForm = document.getElementById('form-add-goal');

    // --- 2. Live Search ---
    searchInput?.addEventListener('input', (e) => {
        fetch(`${searchInput.dataset.url}?search=${e.target.value}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => tableBody.innerHTML = html);
    });

    addForm?.addEventListener('submit', function (e) {
        e.preventDefault();
        
        const btn = document.getElementById('submit-btn');
        btn.disabled = true;

        fetch(this.action, {
            method: 'POST',
            body: new FormData(this), 
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) window.location.reload();
        })
        .catch(() => btn.disabled = false);
    });
});