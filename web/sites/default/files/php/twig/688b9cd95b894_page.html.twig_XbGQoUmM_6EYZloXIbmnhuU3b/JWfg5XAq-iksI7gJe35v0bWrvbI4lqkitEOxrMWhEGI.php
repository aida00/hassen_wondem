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

/* themes/custom/hhass/templates/page.html.twig */
class __TwigTemplate_77975be93a059700c7f4736bb00b780b extends Template
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

        $this->blocks = [
            'page' => [$this, 'block_page'],
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "html.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_ad96c2d8979d8d23860453e7c5eb1520 = $this->extensions["Drupal\\tracer\\Twig\\Extension\\TraceableProfilerExtension"];
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "themes/custom/hhass/templates/page.html.twig"));

        $this->parent = $this->loadTemplate("html.html.twig", "themes/custom/hhass/templates/page.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["site_name", "page"]);        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_ad96c2d8979d8d23860453e7c5eb1520 = $this->extensions["Drupal\\tracer\\Twig\\Extension\\TraceableProfilerExtension"];
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page"));

        // line 4
        yield "\t<div
\t\tclass=\"min-h-screen flex flex-col bg-gray-50\">

\t\t";
        // line 8
        yield "\t\t<header class=\"bg-blue-600 text-white shadow-md\">
\t\t\t<div class=\"container mx-auto px-4 py-6 flex justify-between items-center\">
\t\t\t\t<div class=\"text-xl font-bold\">
\t\t\t\t\t";
        // line 11
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["site_name"] ?? null), "html", null, true);
        yield "
\t\t\t\t</div>
\t\t\t\t<nav class=\"space-x-4\">
\t\t\t\t\t";
        // line 14
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 14), "html", null, true);
        yield "
\t\t\t\t</nav>
\t\t\t</div>
\t\t</header>

\t\t";
        // line 20
        yield "\t\t<main class=\"flex-grow container mx-auto px-4 py-10 space-y-12\">
\t\t\t";
        // line 21
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 24
        yield "\t\t</main>

\t\t";
        // line 27
        yield "\t\t<footer class=\"bg-gray-900 text-white py-10 mt-16\">
\t\t\t<div class=\"container mx-auto px-4\">
\t\t\t\t<div class=\"grid grid-cols-2 md:grid-cols-4 gap-6 text-sm\">
\t\t\t\t\t";
        // line 30
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 30), "html", null, true);
        yield "
\t\t\t\t</div>
\t\t\t\t<div class=\"text-center text-xs mt-6 text-gray-400\">
\t\t\t\t\t&copy;
\t\t\t\t\t";
        // line 34
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield "
\t\t\t\t\tHHass. All rights reserved.
\t\t\t\t</div>
\t\t\t</div>
\t\t</footer>

\t</div>
";
        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    // line 21
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_ad96c2d8979d8d23860453e7c5eb1520 = $this->extensions["Drupal\\tracer\\Twig\\Extension\\TraceableProfilerExtension"];
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 22
        yield "\t\t\t\t";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 22), "html", null, true);
        yield "
\t\t\t";
        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/custom/hhass/templates/page.html.twig";
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
        return array (  142 => 22,  132 => 21,  116 => 34,  109 => 30,  104 => 27,  100 => 24,  98 => 21,  95 => 20,  87 => 14,  81 => 11,  76 => 8,  71 => 4,  61 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/custom/hhass/templates/page.html.twig", "/home/hhassen/public_html/web/themes/custom/hhass/templates/page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("extends" => 1, "block" => 21);
        static $filters = array("escape" => 11, "date" => 34);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['extends', 'block'],
                ['escape', 'date'],
                [],
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
