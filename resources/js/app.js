import './bootstrap';

// vite.config.js
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'public/css/halaman-jadwal.css'],
            refresh: true,
        }),
    ],
});