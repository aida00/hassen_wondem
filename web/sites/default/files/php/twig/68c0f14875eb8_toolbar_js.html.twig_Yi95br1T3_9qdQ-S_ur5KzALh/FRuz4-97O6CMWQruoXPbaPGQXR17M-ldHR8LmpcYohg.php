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

/* modules/contrib/webprofiler/templates/Profiler/toolbar_js.html.twig */
class __TwigTemplate_b68afbcab76772cfb9e13c2dff407a37 extends Template
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
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "modules/contrib/webprofiler/templates/Profiler/toolbar_js.html.twig"));

        // line 1
        yield "<div id=\"sfwdt";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["token"] ?? null), "html", null, true);
        yield "\" class=\"sf-toolbar sf-display-none\" role=\"region\" aria-label=\"Drupal Webprofiler Toolbar\">
  ";
        // line 2
        yield from         $this->loadTemplate("@webprofiler/Profiler/toolbar.html.twig", "modules/contrib/webprofiler/templates/Profiler/toolbar_js.html.twig", 2)->unwrap()->yield(CoreExtension::merge($context, ["templates" => ["request" => "@webprofiler/Profiler/cancel.html.twig"], "profile" => null, "profiler_url" => $this->extensions['Drupal\Core\Template\TwigExtension']->getUrl("webprofiler.toolbar", ["token" =>         // line 7
($context["token"] ?? null)])]));
        // line 9
        yield "</div>

";
        // line 11
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::include($this->env, $context, "@webprofiler/Profiler/base_js.html.twig"));
        yield "

<style";
        // line 13
        if (($context["csp_style_nonce"] ?? null)) {
            yield " nonce=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["csp_style_nonce"] ?? null), "html", null, true);
            yield "\"";
        }
        yield ">
  ";
        // line 14
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::include($this->env, $context, "@webprofiler/Profiler/toolbar.css.twig"));
        yield "
</style>
<script";
        // line 16
        if (($context["csp_script_nonce"] ?? null)) {
            yield " nonce=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["csp_script_nonce"] ?? null), "html", null, true);
            yield "\"";
        }
        yield ">/*<![CDATA[*/
  (function () {
    Sfjs.loadToolbar('";
        // line 18
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["token"] ?? null), "html", null, true);
        yield "');
  })();
/*]]>*/</script>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["token", "csp_style_nonce", "csp_script_nonce"]);        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/webprofiler/templates/Profiler/toolbar_js.html.twig";
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
        return array (  86 => 18,  77 => 16,  72 => 14,  64 => 13,  59 => 11,  55 => 9,  53 => 7,  52 => 2,  47 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/webprofiler/templates/Profiler/toolbar_js.html.twig", "/var/www/html/web/modules/contrib/webprofiler/templates/Profiler/toolbar_js.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("include" => 2, "if" => 13);
        static $filters = array("escape" => 1);
        static $functions = array("url" => 7, "include" => 11);

        try {
            $this->sandbox->checkSecurity(
                ['include', 'if'],
                ['escape'],
                ['url', 'include'],
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
