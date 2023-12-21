/** @type {import('tailwindcss').Config} */
export default {
    content: [
        // You will probably also need these lines
        "./resources/**/**/*.blade.php",
        "./resources/**/**/*.js",
        "./app/View/Components/**/*.php",
        "./app/Livewire/**/**/*.php",

        // Add mary
        "./vendor/robsontenorio/mary/src/View/Components/**/*.php",

        // Laravel paginator
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php'
    ],
    safelist: [
        {
            pattern: /badge-*/
        },
        {
            pattern: /bg-yellow-*/
        }
    ],
    theme: {
        extend: {},
    },
    // Add daisyUI
    plugins: [require("daisyui")],

}
