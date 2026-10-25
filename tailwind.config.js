/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        earth: {
          bg: '#F5F0EB',
          sidebar: '#5C4A32',
          card: '#FFFFFF',
        }
      }
    },
  },
  plugins: [],
}