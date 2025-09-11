<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* themes/custom/hhass/templates/page--front.html.twig */
class __TwigTemplate_7be5b202258a9b6715c7d2187fb5868a extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_ad96c2d8979d8d23860453e7c5eb1520 = $this->extensions["Drupal\\tracer\\Twig\\Extension\\TraceableProfilerExtension"];
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "themes/custom/hhass/templates/page--front.html.twig"));

        // line 2
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("hhass/global"), "html", null, true);
        yield "

";
        // line 4
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["page_top"] ?? null), "html", null, true);
        yield "

<div class=\"flex flex-col min-h-screen\">

\t<header class=\"bg-blue-700 text-white p-6 text-center text-2xl font-bold\">
\t\tWelcome to Hussien Hassen's Portfolio
\t</header>

\t<main class=\"flex-grow\">
\t\t<section class=\"py-20 text-center bg-blue-50\">
\t\t\t<h1 class=\"text-4xl font-extrabold text-blue-700\">Hi, I'm Hussien Hassen</h1>
\t\t\t<p class=\"text-lg text-gray-700 mt-4\">I design and build modern websites with Drupal, Tailwind & Alpine.</p>
\t\t</section>
<section class=\"bg-gray-50 py-12\">
  <div class=\"max-w-3xl mx-auto text-center\">
    <h2 class=\"text-3xl font-extrabold text-gray-900\">
      Are you ready to join our team?
    </h2>
    <p class=\"mt-4 text-lg text-gray-600\">
      We are a dynamic team set to achieve beautiful things.  
      Committed to helping others reach their goals, we believe in creating impact together.  
      Come join us — your journey starts here.
    </p>
    <div class=\"mt-6\">
      <a href=\"/application-form\"
         class=\"inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500\">
        Apply Today
      </a>
    </div>
  </div>
</section>

\t\t<section class=\"py-16 bg-white\">
\t\t\t<div class=\"max-w-5xl mx-auto grid gap-6 md:grid-cols-2 lg:grid-cols-3 px-4\">
\t\t\t\t<a href=\"https://info.simplyrenting.com/\" target=\"_blank\" class=\"bg-gray-100 rounded-lg shadow hover:shadow-lg transition block overflow-hidden\">
\t\t\t\t\t<img src=\"/themes/custom/hhass/images/project-alpha.jpg\" alt=\"Project Alpha\" class=\"w-full h-40 object-cover\">
\t\t\t\t\t<div class=\"p-4\">
\t\t\t\t\t\t<h3 class=\"text-xl font-bold text-blue-600\">Project Alpha</h3>
\t\t\t\t\t\t<p class=\"text-gray-600 mt-2\">Custom Drupal 10 theme built with Tailwind & Vite.</p>
\t\t\t\t\t</div>
\t\t\t\t</a>
\t\t\t\t<a href=\"https://simplyrenting.com/\" target=\"_blank\" class=\"bg-gray-100 rounded-lg shadow hover:shadow-lg transition block overflow-hidden\">
\t\t\t\t\t<img src=\"/themes/custom/hhass/images/project-beta.jpg\" alt=\"Project Beta\" class=\"w-full h-40 object-cover\">
\t\t\t\t\t<div class=\"p-4\">
\t\t\t\t\t\t<h3 class=\"text-xl font-bold text-blue-600\">Project Beta</h3>
\t\t\t\t\t\t<p class=\"text-gray-600 mt-2\">Accessible design for healthcare rental business.</p>
\t\t\t\t\t</div>
\t\t\t\t</a>
\t\t\t\t<a href=\"https://wywi.com/\" target=\"_blank\" class=\"bg-gray-100 rounded-lg shadow hover:shadow-lg transition block overflow-hidden\">
\t\t\t\t\t<img src=\"/themes/custom/hhass/images/project-gamma.jpg\" alt=\"Project Gamma\" class=\"w-full h-40 object-cover\">
\t\t\t\t\t<div class=\"p-4\">
\t\t\t\t\t\t<h3 class=\"text-xl font-bold text-blue-600\">Project Gamma</h3>
\t\t\t\t\t\t<p class=\"text-gray-600 mt-2\">Drupal Commerce storefront with custom modules.</p>
\t\t\t\t\t</div>
\t\t\t\t</a>
\t\t\t</div>
\t\t</section>
\t</main>

\t<footer class=\"bg-gray-900 text-white py-6 text-center\">
\t\t<p>&copy; 2025 Hussien Hassen. All rights reserved.</p>
\t</footer>
</div>

";
        // line 68
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["page_bottom"] ?? null), "html", null, true);
        yield "
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page_top", "page_bottom"]);        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/custom/hhass/templates/page--front.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  119 => 68,  52 => 4,  47 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/custom/hhass/templates/page--front.html.twig", "/var/www/html/web/themes/custom/hhass/templates/page--front.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 2);
        static $functions = array("attach_library" => 2);

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape'],
                ['attach_library'],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
