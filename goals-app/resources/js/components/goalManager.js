import { baseComponent, fileActions } from './baseComponent';

export default (config) => ({
    ...baseComponent(),
    ...fileActions(),

    // State
    isOpen: false,
    isEditing: false,
    saveRoute: config.saveRoute || '',
    categories: config.categories || [],
    goals: config.goals || [],
    search: '',
    selectedCategory: '',
    currentGoal: {
        id: '',
        title: '',
        description: '',
        status: 'todo',
        image: '',
        categories: []
    },

    init() {
        this.$watch('filteredGoals', () => {
            this.refreshIcons();
        });
    },

    // Getters
    get filteredGoals() {
        return this.goals.filter(goal => {
            const matchesSearch = goal.title.toLowerCase().includes(this.search.toLowerCase());
            const matchesCategory = this.selectedCategory === '' ||
                goal.categories.some(cat => cat.name === this.selectedCategory);
            return matchesSearch && matchesCategory;
        });
    },

    // Actions
    handleOpen(event) {
        const data = event.detail;
        this.setGoal(data ? data.goal : null);
    },

    setGoal(goal) {
        if (goal) {
            this.isEditing = true;
            this.currentGoal = JSON.parse(JSON.stringify(goal));
        } else {
            this.isEditing = false;
            this.currentGoal = {
                id: '',
                title: '',
                description: '',
                status: 'todo',
                image: '',
                categories: []
            };
        }
        this.clearPreview();
        this.isOpen = true;
        this.refreshIcons();
    },

    editGoal(goal) {
        this.setGoal(goal);
    },

    closeModal() {
        this.isOpen = false;
    },

    previewImage(event) {
        this.handleFilePreview(event);
    },

    async handleSubmit(event) {
        try {
            await this.submitForm(event, this.saveRoute);
            window.location.reload();
        } catch (error) {
            alert('Erreur: ' + error.message);
        }
    },

    async deleteGoal(id) {
        if (!confirm('Êtes-vous sûr de vouloir supprimer cet objectif ? Cette action est irréversible.')) return;

        try {
            const result = await this.fetchApi(`/admin/delete/${id}`, { method: 'DELETE' });

            if (result.success) {
                this.goals = this.goals.filter(g => g.id !== id);
            } else {
                alert('Erreur lors de la suppression.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert(error.message || 'Une erreur réseau est survenue.');
        }
    }
});
