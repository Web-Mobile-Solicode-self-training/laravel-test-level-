import { baseComponent, fileActions } from './baseComponent';

export default (config) => ({
    ...baseComponent(),
    ...fileActions(),

    isOpen: false,
    isEditing: false,
    saveRoute: config.saveRoute || '',
    categories: config.categories || [],
    currentGoal: {
        id: '',
        title: '',
        description: '',
        status: 'todo',
        image: '',
        categories: []
    },

    handleOpen(event) {
        const data = event.detail;
        if (data && data.goal) {
            this.isEditing = true;
            this.currentGoal = JSON.parse(JSON.stringify(data.goal));
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

    closeModal() {
        this.isOpen = false;
    },

    previewImage(event) {
        this.handleFilePreview(event);
    },

    async submitForm(event) {
        const formData = new FormData(event.target);
        try {
            const response = await fetch(this.saveRoute, {
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
});
