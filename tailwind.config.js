/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                pipexblue: '#1D4ED8',
                bluemagenta: '#000084',
                deepblue: '#2E0696',
                deeppurple: '#4B10A7',
                darkviolet: '#641AB8',
                deepviolet: '#7E2fCA',
                darklavender: '#972FDB',
                brightpurple: '#B039EC',
                hotpink: '#FF09A0',
                brightpink: '#FF3F83',
                brightred: '#FF6D6A',
                brightorange: '#FF965B',
                vividorange: '#FFBD5A',
                lemonyellow: '#FFDF6A',
                pastelyellow: '#FFFF8B',
                midnightblue: '#1A2334',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms')
    ],
}

