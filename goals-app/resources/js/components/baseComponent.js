// Shared utilities for Alpine components
export const baseComponent = () => ({
    get token() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    },

    refreshIcons() {
        this.$nextTick(() => {
            if (window.lucide) {
                window.lucide.createIcons({ icons: window.lucide.icons });
            }
        });
    },

    async fetchApi(url, options = {}) {
        const defaultHeaders = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': this.token
        };

        const response = await fetch(url, {
            ...options,
            headers: {
                ...defaultHeaders,
                ...options.headers
            }
        });

        return this.handleResponse(response);
    },

    async handleResponse(response) {
        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Une erreur est survenue.');
        }
        return response.json();
    },

    async submitForm(event, url, method = 'POST') {
        const formData = new FormData(event.target);
        try {
            const response = await fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': this.token
                }
            });

            return await this.handleResponse(response);
        } catch (error) {
            console.error('Form Submit Error:', error);
            throw error;
        }
    }
});

// Utility logic for file handling and previews
export const fileActions = () => ({
    previewImageUrl: null,

    handleFilePreview(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.previewImageUrl = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    },

    clearPreview() {
        this.previewImageUrl = null;
    },

    isImage(file) {
        return file && file['type'].split('/')[0] === 'image';
    }
});
