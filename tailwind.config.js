const defaultTheme = require("tailwindcss/defaultTheme");
const { colors, backgroundImage } = require("tailwindcss/defaultTheme");

module.exports = {
    purge: [
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans]
            }
        }
    },

    variants: {
        opacity: ["responsive", "hover", "focus", "disabled"]
    },

    plugins: [require("@tailwindcss/ui")],

    theme: {
        extend: {
            colors: {
                danger: "#ff1500",
                primary: "#091c3e", //#091c3e ou #143556
                secondary: "#cdfb0a", //#cdfb0a ou #00ffae
                darkGray: "#0D0F12",
                success: "#00ff48",
                darkSuccess: "#009628",
            },
            inset: {
                "-0.5": "-0.35rem",
                "-1": "-1rem",
                "-2": "-2rem",
                "50": "12.5rem",
            },
            fontSize: {
                "xxs": "0.50rem",
            },
        }
    }
};