import liveReload from 'vite-plugin-live-reload';
import imagemin from 'vite-plugin-imagemin';

export default {
  plugins: [
    // Reload on changes to PHP, SCSS, Twig, etc.
    liveReload(__dirname + '/**/*.(php|inc|theme|twig|scss)'),
    
    // Optimize images during build
    imagemin({
      gifsicle: { optimizationLevel: 7 },
      optipng: { optimizationLevel: 7 },
      mozjpeg: { quality: 75 },
      svgo: { plugins: [{ removeViewBox: false }] },
    }),
  ],

  css: {
    preprocessorOptions: {
      scss: {
        additionalData: `
          @use 'tailwindcss/base';
          @use 'tailwindcss/components';
          @use 'tailwindcss/utilities';
        `,
      },
    },
  },

  build: {
    manifest: true, // Generate a manifest file for integration with Drupal
    rollupOptions: {
      input: ['/src/main.js'], // Entry point for JavaScript
      output: {
        entryFileNames: `[name].js`, // Clean filenames for integration with Drupal
        chunkFileNames: `chunks/[name].[hash].js`,
        assetFileNames: `[name].[ext]`,
      },
    },
  },

  server: {
    cors: true, // Enable CORS
    strictPort: true, // Use a fixed port
    port: 12321, // Match this with your PHP server's expectations
    hmr: {
      host: 'localhost', // Change to your DDEV host if using containers (e.g., `project.ddev.site`)
    },
  },
};
