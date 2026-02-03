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

function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const container = document.getElementById('image-preview-container');
    const placeholder = document.getElementById('upload-placeholder');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            container.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function openModal() {
    document.getElementById('goal-form').reset();
    document.getElementById('goal_id').value = '';

    // Reset Preline Selects
    const statusSelect = HSSelect.getInstance('#form-status');
    const categoriesSelect = HSSelect.getInstance('#form-categories');
    if (statusSelect) statusSelect.setValue('todo');
    if (categoriesSelect) categoriesSelect.setValue([]);

    // Reset Image Preview
    document.getElementById('image-preview-container').classList.add('hidden');
    document.getElementById('upload-placeholder').classList.remove('hidden');

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

    // Update Preline Selects
    const statusSelect = HSSelect.getInstance('#form-status');
    const categoriesSelect = HSSelect.getInstance('#form-categories');
    if (statusSelect) statusSelect.setValue(goal.status);
    if (categoriesSelect) {
        const catIds = goal.categories.map(c => String(c.id));
        categoriesSelect.setValue(catIds);
    }

    // Handle Image Preview
    const preview = document.getElementById('image-preview');
    const container = document.getElementById('image-preview-container');
    const placeholder = document.getElementById('upload-placeholder');
    if (goal.image) {
        preview.src = `/storage/${goal.image}`;
        container.classList.remove('hidden');
        placeholder.classList.add('hidden');
    } else {
        container.classList.add('hidden');
        placeholder.classList.remove('hidden');
    }

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
window.previewImage = previewImage;
