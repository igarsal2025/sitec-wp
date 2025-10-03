module.exports = {
  content: [
    './*.php',
    './**/*.php',
    '../../plugins/**/*.php'
  ],
  theme: { extend: {} },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms')
  ]
};


