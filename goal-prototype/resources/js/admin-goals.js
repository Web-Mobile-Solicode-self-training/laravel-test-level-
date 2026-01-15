// --- Modal Controls ---
window.openModal = function () {
    console.log('Opening modal...');
    const modal = document.getElementById('hs-modal-add-goal');
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    } else {
        console.error('Modal not found');
    }
};

window.closeModal = function () {
    const modal = document.getElementById('hs-modal-add-goal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
};

document.addEventListener('DOMContentLoaded', () => {
    console.log('Admin Goals JS Loaded');
    const searchInput = document.getElementById('ajax-search');
    const tableBody = document.getElementById('table-body');
    const addForm = document.getElementById('form-add-goal');

    // --- Search Logic ---
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            fetch(`${searchInput.dataset.url}?search=${e.target.value}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(res => res.text())
                .then(html => tableBody.innerHTML = html);
        });
    }

    // --- Form Submission ---
    if (addForm) {
        addForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const btn = document.getElementById('submit-btn');
            btn.disabled = true;

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    }
                })
                .catch(() => btn.disabled = false);
        });
    }
});

window.deleteGoal = function (url, confirmMessage) {
    if (!confirm(confirmMessage)) return;

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(url, {
        method: 'DELETE',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token
        }
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) window.location.reload();
        });
};