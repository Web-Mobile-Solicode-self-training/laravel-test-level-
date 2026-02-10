import { baseComponent } from './baseComponent';

export default (config) => ({
    ...baseComponent(),

    goals: config.goals || [],
    categories: config.categories || [],
    search: '',
    selectedCategory: '',

    init() {
        this.$watch('filteredGoals', () => {
            this.refreshIcons();
        });
    },

    get filteredGoals() {
        return this.goals.filter(goal => {
            const matchesSearch = goal.title.toLowerCase().includes(this.search.toLowerCase());
            const matchesCategory = this.selectedCategory === '' ||
                goal.categories.some(cat => cat.name === this.selectedCategory);
            return matchesSearch && matchesCategory;
        });
    },

    editGoal(goal) {
        this.$dispatch('open-goal-modal', { goal });
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
