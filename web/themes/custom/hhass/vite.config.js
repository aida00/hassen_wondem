import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  root: '.',             // project root is the theme folder
  build: {
    outDir: 'build',      // emit into themes/custom/hhass/build
    emptyOutDir: true,
    rollupOptions: {
      input: path.resolve(__dirname, 'src/js/app.js'),
      output: {
        // Force stable filenames so Drupal can reference them
        entryFileNames: 'app.js',
        assetFileNames: (assetInfo) => {
          // Emit your compiled CSS as style.css
          if (assetInfo.name && assetInfo.name.endsWith('.css')) {
            return 'style.css';
          }
          return assetInfo.name;
        },
      },
    },
  },
  css: {
    // Vite will read your postcss.config.js automatically
  },
});
