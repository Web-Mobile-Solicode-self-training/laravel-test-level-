/**
 * Admin Goals Management Logic
 */

document.addEventListener('DOMContentLoaded', () => {
    const goalForm = document.getElementById('goal-form');
    const searchInput = document.getElementById('admin-search');
    const tableBody = document.getElementById('admin-table-body');
    const modalElement = document.getElementById('hs-goal-modal');

    // --- 1. AJAX Live Search ---
    if (searchInput) {
        searchInput.addEventListener('input', debounce((e) => {
            const url = searchInput.dataset.url;
            const query = e.target.value;

            fetch(`${url}?search=${query}`, {
                headers: { "X-Requested-With": "XMLHttpRequest" }
            })
            .then(res => res.text())
            .then(html => {
                tableBody.innerHTML = html;
                if (window.lucide) lucide.createIcons(); // Re-render icons
            });
        }, 300));
    }

    // --- 2. AJAX Store/Update ---
    if (goalForm) {
        goalForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const url = goalForm.getAttribute('action');

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.reload(); // Refresh to show changes
                }
            })
            .catch(err => console.error("Error saving goal:", err));
        });
    }

    // --- 3. Helper: Debounce for Search Performance ---
    function debounce(func, timeout = 300) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => { func.apply(this, args); }, timeout);
        };
    }
});

// --- 4. Global Functions for Buttons (Inline onclick) ---

window.openAddModal = function() {
    const form = document.getElementById('goal-form');
    form.reset();
    document.getElementById('form-goal-id').value = '';
    document.getElementById('modal-title').innerText = "Nouvel Objectif";
    HSOverlay.open('#hs-goal-modal');
};

window.editGoal = function(id, editUrl) {
    fetch(editUrl)
    .then(res => res.json())
    .then(data => {
        document.getElementById('modal-title').innerText = "Modifier l'objectif";
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

        HSOverlay.open('#hs-goal-modal');
    });
};

window.deleteGoal = function(id, deleteUrl) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet objectif ?')) {
        fetch(deleteUrl, {
            method: 'DELETE',
            headers: { 
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest' 
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) window.location.reload();
        });
    }
};