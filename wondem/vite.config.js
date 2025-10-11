import { defineConfig } from "vite";

export default defineConfig({
  build: {
    outDir: "dist",
    rollupOptions: {
      input: {
        frontpage: "./src/frontpage.js",
      },
      output: {
        entryFileNames: `frontpage.js`,
        assetFileNames: `frontpage.css`,
      }
    }
  }
});

