/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                grayText: "#707070",
            },
            fontFamily: {
                poppins: "Poppins",
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
