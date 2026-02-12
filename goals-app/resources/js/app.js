import './bootstrap';
import 'preline';
import { createIcons, icons } from 'lucide';
import Alpine from 'alpinejs'

// Import components
import goalManager from './components/goalManager';

window.Alpine = Alpine

// Register components before starting Alpine
document.addEventListener('alpine:init', () => {
    Alpine.data('goalManager', goalManager);
});

Alpine.start()

createIcons({ icons });

window.lucide = { createIcons, icons };
