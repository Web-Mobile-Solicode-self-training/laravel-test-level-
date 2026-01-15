/**
 * Admin Goals Management - Clean & Global Version
 */

document.addEventListener('DOMContentLoaded', () => {
    const goalForm = document.getElementById('goal-form');
    const searchInput = document.getElementById('admin-search');
    const tableBody = document.getElementById('admin-table-body');

    // --- 1. AJAX Live Search ---
    if (searchInput) {
        searchInput.addEventListener('input', debounce((e) => {
            const url = searchInput.dataset.url;
            if (!url) return;

            fetch(`${url}?search=${e.target.value}`, {
                headers: { "X-Requested-With": "XMLHttpRequest" }
            })
                .then(res => res.text())
                .then(html => {
                    tableBody.innerHTML = html;
                    if (window.lucide) lucide.createIcons();
                });
        }, 300));
    }

    // --- 2. AJAX Store/Update ---
    if (goalForm) {
        goalForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const url = this.getAttribute('action');

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert('Erreur: ' + (data.message || 'Problème technique'));
                    }
                })
                .catch(err => console.error("Submit Error:", err));
        });
    }
});

// --- 3. Global Functions (Attached to Window) ---

window.prepareAddModal = function () {
    const form = document.getElementById('goal-form');
    if (!form) {
        console.error("Goal form not found");
        return;
    }

    form.reset();
    document.getElementById('form-goal-id').value = '';
    const modalTitle = document.getElementById('modal-title');
    if (modalTitle) modalTitle.innerText = "Nouvel Objectif";

    // Uncheck categories
    document.querySelectorAll('.category-checkbox').forEach(cb => cb.checked = false);

    // Open Modal
    openHSModal('#hs-goal-modal');
};

window.editGoal = function (url) {
    fetch(url, {
        headers: { "X-Requested-With": "XMLHttpRequest" }
    })
        .then(res => res.json())
        .then(data => {
            const modalTitle = document.getElementById('modal-title');
            if (modalTitle) modalTitle.innerText = "Modifier l'objectif";

            document.getElementById('form-goal-id').value = data.goal.id;
            document.getElementById('form-title').value = data.goal.title;
            document.getElementById('form-description').value = data.goal.description;
            document.getElementById('form-status').value = data.goal.status;
            document.getElementById('form-progress').value = data.goal.progress;

            // Sync Categories
            const checkBoxes = document.querySelectorAll('.category-checkbox');
            checkBoxes.forEach(cb => {
                cb.checked = data.category_ids.includes(parseInt(cb.value));
            });

            // Open Modal
            openHSModal('#hs-goal-modal');
        })
        .catch(err => console.error("Edit Error:", err));
};

window.deleteGoal = function (url) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet objectif ?')) {
        const tokenInput = document.querySelector('input[name="_token"]');
        const token = tokenInput ? tokenInput.value : '';

        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) window.location.reload();
            });
    }
};

// Helper to open modal with fallback
function openHSModal(selector) {
    try {
        if (window.HSOverlay) {
            HSOverlay.open(selector);
        } else {
            console.warn("HSOverlay not defined, falling back to class toggle");
            const modal = document.querySelector(selector);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('open');
            }
        }
    } catch (e) {
        console.error("Error opening modal:", e);
    }
}

// --- 4. Performance Helper ---
function debounce(func, timeout = 300) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}