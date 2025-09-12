// tailwind.config.js
export default {
  content: [
    './templates/**/*.html.twig',
    './src/**/*.js',
    './*.html',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
};
