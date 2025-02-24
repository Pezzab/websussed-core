module.exports = {
  purge: {
    enabled: true,
    content: ['./**/*.{php,html,css}', './safelist.txt'],
  },
  theme: {
    fontFamily:{
      'heading': ['Bebas Neue'],
      'sans': ['Helvetica'],
      spacing: {
      },
    },
    screens: {
      'mddown': { 'max': '767px' },
      'sm': '640px',
      // => @media (min-width: 640px) { ... }

      'md': '768px',
      // => @media (min-width: 768px) { ... }

      'lg': '1024px',
      // => @media (min-width: 1024px) { ... }

      'xl': '1280px',
      // => @media (min-width: 1280px) { ... }

      '2xl': '1536px',
      // => @media (min-width: 1536px) { ... }
    },
    extend: {
      colors: {
        'link': 'blue',
        'link-hover': 'darkblue',
        'copybg': 'whitesmoke',
        'copy': 'darkslategray',
      },
    },
  },
  variants: {},
}