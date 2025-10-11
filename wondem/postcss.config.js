// BEFORE (broken)
const autoprefixer = require('autoprefixer');
const tailwindcss = require('tailwindcss');

// AFTER (working with Vite ESM)
import autoprefixer from 'autoprefixer';
import tailwindcss from 'tailwindcss';

export default {
  plugins: [tailwindcss, autoprefixer],
};
