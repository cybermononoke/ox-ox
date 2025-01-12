import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    safelist: ["!bg-blue-200"],
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/robsontenorio/mary/src/View/Components/**/*.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    daisyui: {
        themes: [
            "sunset",
            "sunrise",
            {
                sunrise: {
                    "color-scheme": "light",
                    primary: "#FFB692",
                    secondary: "#FFA3C4",
                    accent: "#C7A6FF",
                    neutral: "oklch(94% 0.019 237.69)",
                    "neutral-content": "oklch(30% 0.019 237.69)",
                    "base-100": "oklch(100% 0.019 237.69)",
                    "base-200": "oklch(98% 0.019 237.69)",
                    "base-300": "oklch(96% 0.019 237.69)",
                    "base-content": "#314455",
                    info: "#6EDAE4",
                    success: "#7DCE82",
                    warning: "#E6A157",
                    error: "#FF8889",
                    "--rounded-box": "1.2rem",
                    "--rounded-btn": "0.8rem",
                    "--rounded-badge": "0.4rem",
                    "--tab-radius": "0.7rem",
                },
            },
        ],
        darkTheme: "sunset",
        lightTheme: "sunrise",
    },

    plugins: [require("daisyui")],
};
