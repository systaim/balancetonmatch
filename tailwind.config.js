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
                cyan: colors.cyan,
            },
            inset: {
                "-0.5": "-0.35rem",
                "-1": "-0.25rem",
                "-2": "-0.50rem",
                "-3": "-0.75rem",
                "-4": "-1rem",
                "-5": "-1.25rem",
                "-6": "-1.50rem",
                "-7": "-1.75rem",
                "-8": "-2rem",
                "-9": "-2.25rem",
                "-10": "-2.50rem",
                "-11": "-2.75rem",
                "-12": "-3rem",
                "-13": "-3.25rem",
                "-14": "-3.50rem",
                "-15": "-3.75rem",
                "-16": "-4rem",
                "-18": "-4.5rem",
                "-20": "-5rem",
                "-24": "-6rem",
                "50": "12.5rem",
            },
            fontSize: {
                xxs: "0.50rem",
                xs60: "0.60rem",
            },
            skew: {
                180: "180deg",
            },
            boxShadow: {
                'white-xl': "0 20px 25px -5px rgba(255, 255, 255, 0.1), 0 10px 10px -5px rgba(255, 255, 255, 0.04)"
            },
        }
    }
};