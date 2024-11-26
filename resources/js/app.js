import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.Echo.private(`orders.${userId}`)
.listen('.create', (e) => {
    alert(e.message);
});
Alpine.start();
