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

/* @webprofiler/Collector/theme.html.twig */
class __TwigTemplate_a5e2ba4c92b872dc8106c2f31eb124d7 extends Template
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
            'toolbar' => [$this, 'block_toolbar'],
            'panel' => [$this, 'block_panel'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_ad96c2d8979d8d23860453e7c5eb1520 = $this->extensions["Drupal\\tracer\\Twig\\Extension\\TraceableProfilerExtension"];
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@webprofiler/Collector/theme.html.twig"));

        // line 1
        yield from $this->unwrap()->yieldBlock('toolbar', $context, $blocks);
        // line 60
        yield "
";
        // line 61
        yield from $this->unwrap()->yieldBlock('panel', $context, $blocks);
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["collector", "profiler_url"]);        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    // line 1
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_toolbar(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_ad96c2d8979d8d23860453e7c5eb1520 = $this->extensions["Drupal\\tracer\\Twig\\Extension\\TraceableProfilerExtension"];
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "toolbar"));

        // line 2
        yield "
  ";
        // line 3
        $context["negotiator"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 4
            yield "    <a href=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\webprofiler\Twig\Extension\CodeExtension']->getFileLink(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "themeNegotiator", [], "any", false, false, true, 4), "class", [], "any", false, false, true, 4), "file", [], "any", false, false, true, 4), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "themeNegotiator", [], "any", false, false, true, 4), "class", [], "any", false, false, true, 4), "line", [], "any", false, false, true, 4)), "html", null, true);
            yield "\">";
            yield $this->extensions['Drupal\webprofiler\Twig\Extension\CodeExtension']->abbrClass($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "themeNegotiator", [], "any", false, false, true, 4), "class", [], "any", false, false, true, 4), "class", [], "any", false, false, true, 4), "html", null, true));
            yield " :: ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "themeNegotiator", [], "any", false, false, true, 4), "class", [], "any", false, false, true, 4), "method", [], "any", false, false, true, 4), "html", null, true);
            yield "</a>
  ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 6
        yield "  ";
        $context["time"] = ((CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "templatecount", [], "any", false, false, true, 6)) ? (Twig\Extension\CoreExtension::sprintf("%0.0f ms", CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "time", [], "any", false, false, true, 6))) : ("n/a"));
        // line 7
        yield "
  ";
        // line 8
        $context["icon"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 9
            yield "    ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::include($this->env, $context, "@webprofiler/Icon/twig.svg"));
            yield "
    <span class=\"sf-toolbar-value\">";
            // line 10
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "activeTheme", [], "any", false, false, true, 10), "name", [], "any", false, false, true, 10), "html", null, true);
            yield "</span>
  ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 12
        yield "
  ";
        // line 13
        $context["text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 14
            yield "    <div class=\"sf-toolbar-info-piece\">
      <b>";
            // line 15
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Name"));
            yield "</b>
      <span>";
            // line 16
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "activeTheme", [], "any", false, false, true, 16), "name", [], "any", false, false, true, 16), "html", null, true);
            yield "</span>
    </div>
    <div class=\"sf-toolbar-info-piece\">
      <b>";
            // line 19
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Engine"));
            yield "</b>
      <span>";
            // line 20
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "activeTheme", [], "any", false, false, true, 20), "engine", [], "any", false, false, true, 20), "html", null, true);
            yield "</span>
    </div>
    <div class=\"sf-toolbar-info-piece\">
      <b>";
            // line 23
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Negotiator"));
            yield "</b>
      <span>";
            // line 24
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["negotiator"] ?? null), "html", null, true);
            yield "</span>
    </div>
    <div class=\"sf-toolbar-info-piece\">
      <b>";
            // line 27
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Render Time"));
            yield "</b>
      <span>";
            // line 28
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["time"] ?? null), "html", null, true);
            yield "</span>
    </div>
    <div class=\"sf-toolbar-info-piece\">
      <b>";
            // line 31
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Template Calls"));
            yield "</b>
      <span class=\"sf-toolbar-status\">";
            // line 32
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "templatecount", [], "any", false, false, true, 32), "html", null, true);
            yield "</span>
    </div>
    <div class=\"sf-toolbar-info-piece\">
      <b>";
            // line 35
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Block Calls"));
            yield "</b>
      <span class=\"sf-toolbar-status\">";
            // line 36
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "blockcount", [], "any", false, false, true, 36), "html", null, true);
            yield "</span>
    </div>
    <div class=\"sf-toolbar-info-piece\">
      <b>";
            // line 39
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Macro Calls"));
            yield "</b>
      <span class=\"sf-toolbar-status\">";
            // line 40
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "macrocount", [], "any", false, false, true, 40), "html", null, true);
            yield "</span>
    </div>
    <div class=\"sf-toolbar-info-piece\">
      <b>";
            // line 43
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Twig filters"));
            yield "</b>
      <span class=\"sf-toolbar-status\">";
            // line 44
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "twigfilterscount", [], "any", false, false, true, 44), "html", null, true);
            yield "</span>
    </div>
    <div class=\"sf-toolbar-info-piece\">
      <b>";
            // line 47
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Twig functions"));
            yield "</b>
      <span class=\"sf-toolbar-status\">";
            // line 48
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "twigfunctionscount", [], "any", false, false, true, 48), "html", null, true);
            yield "</span>
    </div>
    ";
            // line 50
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "hasComponentsModule", [], "any", false, false, true, 50)) {
                // line 51
                yield "      <div class=\"sf-toolbar-info-piece\">
        <b>";
                // line 52
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Components"));
                yield "</b>
        <span class=\"sf-toolbar-status\">";
                // line 53
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "componentscount", [], "any", false, false, true, 53), "html", null, true);
                yield "</span>
      </div>
    ";
            }
            // line 56
            yield "  ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 57
        yield "
  ";
        // line 58
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::include($this->env, $context, "@webprofiler/Profiler/toolbar_item.html.twig", ["link" => ($context["profiler_url"] ?? null)]));
        yield "
";
        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    // line 61
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_panel(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_ad96c2d8979d8d23860453e7c5eb1520 = $this->extensions["Drupal\\tracer\\Twig\\Extension\\TraceableProfilerExtension"];
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "panel"));

        // line 62
        yield "  ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "panel", [], "method", false, false, true, 62), "html", null, true);
        yield "
";
        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@webprofiler/Collector/theme.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  247 => 62,  237 => 61,  227 => 58,  224 => 57,  220 => 56,  214 => 53,  210 => 52,  207 => 51,  205 => 50,  200 => 48,  196 => 47,  190 => 44,  186 => 43,  180 => 40,  176 => 39,  170 => 36,  166 => 35,  160 => 32,  156 => 31,  150 => 28,  146 => 27,  140 => 24,  136 => 23,  130 => 20,  126 => 19,  120 => 16,  116 => 15,  113 => 14,  111 => 13,  108 => 12,  102 => 10,  97 => 9,  95 => 8,  92 => 7,  89 => 6,  78 => 4,  76 => 3,  73 => 2,  63 => 1,  54 => 61,  51 => 60,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "@webprofiler/Collector/theme.html.twig", "/var/www/html/web/modules/contrib/webprofiler/templates/Collector/theme.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("block" => 1, "set" => 3, "if" => 50);
        static $filters = array("escape" => 4, "file_link" => 4, "abbr_class" => 4, "format" => 6, "t" => 15);
        static $functions = array("include" => 9);

        try {
            $this->sandbox->checkSecurity(
                ['block', 'set', 'if'],
                ['escape', 'file_link', 'abbr_class', 'format', 't'],
                ['include'],
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
