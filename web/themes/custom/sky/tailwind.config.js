const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
const plugin = require('tailwindcss/plugin');

module.exports = {
  content: ['./components/**/*.twig', './templates/**/*.html.twig'],
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.slate,
      amber: colors.amber,
      yellow: colors.yellow,
      orange: colors.orange,
      lime: colors.lime,
      red: colors.red,
      pink: colors.pink,
      green: colors.green,
    },
    extend: {
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      },
      spacing: {
        200: '200px',
        300: '300px',
        350: '350px',
        400: '400px',
        600: '600px',
        700: '700px',
      },
      colors: {
        primary: {
          50: '#f3f7fa',
          100: '#e7eff6',
          200: '#c4d8e7',
          300: '#a0c0d9',
          400: '#5990bd',
          500: '#1261a0',
          600: '#105790',
          700: '#0e4978',
          800: '#0b3a60',
          900: '#09304e',
        },
        secondary: {
          50: '#f3f5f7',
          100: '#e6eaef',
          200: '#c1cbd7',
          300: '#9cacbf',
          400: '#516d8f',
          500: '#072f5f',
          600: '#062a56',
          700: '#052347',
          800: '#041c39',
          900: '#03172f',
        },
        tertiary: {
          50: '#f5fafd',
          100: '#ebf4fb',
          200: '#cde5f4',
          300: '#afd5ed',
          400: '#74b5e0',
          500: '#3895d3',
          600: '#3286be',
          700: '#2a709e',
          800: '#22597f',
          900: '#1b4967',
        },
        quaternary: {
          50: '#f7fcfe',
          100: '#eefafd',
          200: '#d5f2fb',
          300: '#bcebf8',
          400: '#8adbf2',
          500: '#58cced',
          600: '#4fb8d5',
          700: '#4299b2',
          800: '#357a8e',
          900: '#2b6474',
        },
        'custom-yellow-1': '#ffbc00',
        'custom-yellow-2': '#f1ec7f',
        'custom-blue-1': '#105790',
        'custom-grey-1': '#cfcfcf',
        'custom-white-1': '#fafafa',
        'custom-green-1': '#27C484',
      },
      boxShadow: {
        'custom-1': '0 3px 6px rgb(0 0 0 / 0.29)',
      },
      fontSize: {
        'custom-1': '44px',
      },
      lineHeight: {
        'custom-1': '50px',
      },
    },
  },
  corePlugins: {
    aspectRatio: false,
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
  ],
};
