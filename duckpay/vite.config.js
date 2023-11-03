import { defineConfig, splitVendorChunkPlugin  } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js'],
            refresh: true,
        },
            ),
    ],
    resolve: {
        alias: {
            '~bootstrap': 'node_modules/bootstrap',
        },
    },
    server: {
        host: true,
        port: 5173, // This is the port which we will use in docker
        watch: {
            usePolling: true
        },
        hmr: {
            port: 5173,
            clientPort: 5173,
            host: 'localhost'
        },
    },
});
