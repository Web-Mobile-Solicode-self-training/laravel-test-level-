/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './node_modules/preline/dist/*.js', // For Preline
  ],
  theme: {
    extend: {},
  },
  plugins: [forms, preline],
}