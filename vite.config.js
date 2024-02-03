import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import { fileURLToPath, URL } from 'node:url'
// import axios from '@/plugins/axios';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/vue/css/app.css', 'resources/vue/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
      alias: {
        '@': fileURLToPath(new URL('./resources/vue', import.meta.url))
      },
      extensions: [
        '.js',
        '.json',
        '.jsx',
        '.mjs',
        '.ts',
        '.tsx',
        '.vue',
      ],
    },
    // envDir: 'resources/vue',
    server: {
        https: false,
        host: '127.0.0.1',
    },
    proxy: {
      '/api': {
        target: "http://ethereum.test/",
        changeOrigin: true,
        secure: false,
        rewrite: path => path.replace('/api', ''),
      }
    }
});
