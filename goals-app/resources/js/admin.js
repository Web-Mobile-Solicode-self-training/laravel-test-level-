// --- LOGIQUE DE FILTRAGE ---
function filterTable() {
    const searchTerm = document.getElementById('filter-search').value.toLowerCase();
    const catTerm = document.getElementById('filter-category').value;
    const rows = document.querySelectorAll('.goal-row');

    rows.forEach(row => {
        const title = row.getAttribute('data-title');
        const categories = row.getAttribute('data-category');
        const matchesSearch = title.includes(searchTerm);
        const matchesCat = catTerm === "" || categories.includes(catTerm);
        row.style.display = (matchesSearch && matchesCat) ? "" : "none";
    });
}

// Attach filter events
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('filter-search');
    const categorySelect = document.getElementById('filter-category');

    if (searchInput) searchInput.addEventListener('keyup', filterTable);
    if (categorySelect) categorySelect.addEventListener('change', filterTable);

    // Form submit
    const goalForm = document.getElementById('goal-form');
    if (goalForm) goalForm.addEventListener('submit', submitForm);
});


// delete
async function deleteGoal(id) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer cet objectif ? Cette action est irréversible.')) return;

    try {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch(`/admin/delete/${id}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': token
            }
        });

        const result = await response.json();

        if (response.ok && result.success) {
            // Animation de sortie avant suppression du DOM
            const row = document.getElementById(`row-${id}`);
            row.style.transition = 'all 0.3s ease';
            row.style.opacity = '0';
            row.style.transform = 'translateX(20px)';
            setTimeout(() => row.remove(), 300);
        } else {
            alert('Erreur lors de la suppression.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Une erreur réseau est survenue.');
    }
}

// --- AUTRES FONCTIONS ---
async function submitForm(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    try {
        const response = await fetch(window.AdminConfig.saveRoute, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (response.ok) {
            window.location.reload();
        } else {
            const result = await response.json();
            alert('Erreur: ' + (result.message || 'Une erreur est survenue lors de l\'enregistrement.'));
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Une erreur réseau est survenue.');
    }
}

function openModal() {
    document.getElementById('goal-form').reset();
    document.getElementById('goal_id').value = '';
    document.querySelectorAll('.cat-checkbox').forEach(cb => cb.checked = false);
    document.getElementById('modal-title').innerText = 'Créer un nouvel objectif';
    document.getElementById('goal-modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('goal-modal').classList.add('hidden');
}

async function editGoal(id) {
    const response = await fetch(`/admin/edit/${id}`);
    const goal = await response.json();
    document.getElementById('goal_id').value = goal.id;
    document.getElementById('form-title').value = goal.title;
    document.getElementById('form-description').value = goal.description;
    document.getElementById('form-status').value = goal.status;
    const catIds = goal.categories.map(c => c.id);
    document.querySelectorAll('.cat-checkbox').forEach(cb => {
        cb.checked = catIds.includes(parseInt(cb.value));
    });
    document.getElementById('modal-title').innerText = 'Modifier l\'objectif';
    document.getElementById('goal-modal').classList.remove('hidden');
}

// Expose functions to global scope as they are called by inline onclick/events in HTML
window.filterTable = filterTable;
window.deleteGoal = deleteGoal;
window.submitForm = submitForm;
window.openModal = openModal;
window.closeModal = closeModal;
window.editGoal = editGoal;
