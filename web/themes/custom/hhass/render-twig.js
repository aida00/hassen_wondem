const fs = require('fs');
const path = require('path');
const twig = require('twig');

const inputDir = path.join(__dirname, 'src/twig');
const outputDir = path.join(__dirname, 'src');
const drupalTwigPath = path.join(__dirname, 'templates/page--front.html.twig');

// Ensure output exists
if (!fs.existsSync(outputDir)) fs.mkdirSync(outputDir, { recursive: true });

const data = {
    name: 'Hussien Hassen',
    year: new Date().getFullYear(),
    projects: [
        {
            title: 'Project Alpha',
            summary: 'Custom Drupal 10 theme built with Tailwind & Vite.',
            url: 'https://info.simplyrenting.com/',
            image: '/themes/custom/hhass/images/project-alpha.jpg'
        },
        {
            title: 'Project Beta',
            summary: 'Accessible design for healthcare rental business.',
            url: 'https://simplyrenting.com/',
            image: '/themes/custom/hhass/images/project-beta.jpg'
        },
        {
            title: 'Project Gamma',
            summary: 'Drupal Commerce storefront with custom modules.',
            url: 'https://wywi.com/',
            image: '/themes/custom/hhass/images/project-gamma.jpg'
        }
    ]
};

// Render HTML with Twig
const tpl = twig.twig({ path: path.join(inputDir, 'index.twig'), async: false });
const html = tpl.render(data);

// Write the raw preview (optional)
fs.writeFileSync(path.join(outputDir, 'index.html'), html);
console.log('✔ Rendered index.twig → src/index.html');

// Wrap for Drupal Twig
const wrappedTwig = `{# Auto-generated for Drupal #}
{{ attach_library('hhass/global') }}

<div class="flex flex-col min-h-screen">

  <header class="bg-blue-700 text-white p-6 text-center text-2xl font-bold">
    Welcome to ${data.name}'s Portfolio
  </header>

  <main class="flex-grow">
    ${html}
  </main>

  <footer class="bg-gray-900 text-white py-6 text-center">
    <p>&copy; ${data.year} ${data.name}. All rights reserved.</p>
  </footer>

</div>
`;

fs.writeFileSync(drupalTwigPath, wrappedTwig);
console.log(`✔ page--front.html.twig updated → templates/page--front.html.twig`);
