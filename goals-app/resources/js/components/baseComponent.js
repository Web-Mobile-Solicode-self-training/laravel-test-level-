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

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Une erreur est survenue.');
        }

        return response.json();
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
