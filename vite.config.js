import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/css/tailwindcss.css",
                "resources/css/filament/admin/theme.css",
                "resources/css/filament/midas/theme.css",
            ],
            refresh: true,
        }),
    ],
});
