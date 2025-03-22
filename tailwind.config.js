/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/**/*.{html,js,php}"],
  theme: {
    extend: {
      colors: {
        primary: "#0c770c",
        secondary: "#fbbf24",
        back: "#f0fdf4",
      },
      animation: {
        fade: "fade 1.5s ease-in-out",
      },
      keyframes: {
        fade: {
          "0%": { opacity: "0.4" },
          "100%": { opacity: "1" },
        },
      },
    },
  },
  plugins: [],
};

