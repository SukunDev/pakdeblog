/** @type {import('tailwindcss').Config} */

const disabledCss = {
  'code::before': false,
  'code::after': false,
  pre: false,
  code: false,
  'pre code': false,
  'code::before': false,
  'code::after': false,
}
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    screens: {
      sm: '576px',
      md: '768px',
      lg: '992px',
    },
    extend: {
      fontFamily: {
        Poppins: ['Poppins', 'sans-serif'],
      },
      typography: {
        DEFAULT: { css: disabledCss },
        sm: { css: disabledCss },
        lg: { css: disabledCss },
        xl: { css: disabledCss },
        '2xl': { css: disabledCss },
      },
    },
  },
  plugins: [
    require('@tailwindcss/line-clamp'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
  ],
}
