import './bootstrap';
import 'preline';
import { createIcons, icons } from 'lucide';
import Alpine from 'alpinejs'

// Import components
import goalTable from './components/goalTable';
import goalModal from './components/goalModal';

window.Alpine = Alpine

// Register components before starting Alpine
document.addEventListener('alpine:init', () => {
    Alpine.data('goalTable', goalTable);
    Alpine.data('goalModal', goalModal);
});

Alpine.start()

createIcons({ icons });

window.lucide = { createIcons, icons };
