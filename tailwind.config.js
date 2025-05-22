/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    // Look inside all .js/.ts/.jsx/.tsx files in `src/`
    "./src/**/*.{js,ts,jsx,tsx}",

    // Look inside any PHP template files in your theme,
    // adjusting the path if needed:
    "./*.php",
    "./includes/*.php",
    "./template-parts/**/*.php",
    // or even "../**/*.php" if you want to scan everything
    "./templates/*.html",
  ],
  theme: {
    extend: {
      // Customize your theme here
    },
  },
  plugins: [],
}

