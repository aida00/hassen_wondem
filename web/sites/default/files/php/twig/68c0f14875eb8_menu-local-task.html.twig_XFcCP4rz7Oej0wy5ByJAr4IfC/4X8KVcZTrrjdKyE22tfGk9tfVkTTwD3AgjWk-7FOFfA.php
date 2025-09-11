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

/* core/themes/claro/templates/navigation/menu-local-task.html.twig */
class __TwigTemplate_6d382b72c4522cce981a093fdd938674 extends Template
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
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "core/themes/claro/templates/navigation/menu-local-task.html.twig"));

        // line 19
        $context["classes"] = ["tabs__tab", (((        // line 21
($context["level"] ?? null) == "primary")) ? ("js-tab") : ("")), ((        // line 22
($context["is_active"] ?? null)) ? ("is-active") : ("")), ((        // line 23
($context["is_active"] ?? null)) ? ("js-active-tab") : (""))];
        // line 26
        yield "<li";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 26), "html", null, true);
        yield ">
  ";
        // line 27
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["link"] ?? null), "html", null, true);
        yield "
  ";
        // line 28
        if ((($context["is_active"] ?? null) && (($context["level"] ?? null) == "primary"))) {
            // line 29
            yield "    <button class=\"reset-appearance tabs__trigger\" type=\"button\" aria-label=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Tabs display toggle"));
            yield "\" data-drupal-nav-tabs-trigger>
      ";
            // line 30
            yield from             $this->loadTemplate("@claro/../images/src/hamburger-menu.svg", "core/themes/claro/templates/navigation/menu-local-task.html.twig", 30)->unwrap()->yield($context);
            // line 31
            yield "    </button>
  ";
        }
        // line 33
        yield "</li>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["level", "is_active", "attributes", "link"]);        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "core/themes/claro/templates/navigation/menu-local-task.html.twig";
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
        return array (  74 => 33,  70 => 31,  68 => 30,  63 => 29,  61 => 28,  57 => 27,  52 => 26,  50 => 23,  49 => 22,  48 => 21,  47 => 19,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "core/themes/claro/templates/navigation/menu-local-task.html.twig", "/var/www/html/web/core/themes/claro/templates/navigation/menu-local-task.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 19, "if" => 28, "include" => 30);
        static $filters = array("escape" => 26, "t" => 29);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'include'],
                ['escape', 't'],
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
