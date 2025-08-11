/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        'night-pitch': '#0d1017',
        'grass-accent': '#2a5c3d',
        'warm-highlight': '#ffc700',
        'ui-chrome': '#a0a0a0',
      },
      fontFamily: {
        display: ['"Bebas Neue"', 'sans-serif'], // Example, needs to be imported
        sans: ['"Inter"', 'sans-serif'], // Example, needs to be imported
      },
    },
  },
  plugins: [],
}
