import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5216,
        hmr: {
            host: 'localhost',
            clientPort: 5216
        }
    },
    build: {
        manifest: 'manifest.json',
    },
});
