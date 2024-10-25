/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/**/*.{html,js,php}"],
  theme: {
    container: {
      center: true,
    },
    extend: {
      fontFamily: {
        nunito: "Nunito",
      },
      colors: {
        "dark-base": "#020617",
        "light-base": "#f1f5f9",
        "blue-base": "#1d4ed8",
        "green-base": "#22c525",
      },
    },
  },
  plugins: [],
}

