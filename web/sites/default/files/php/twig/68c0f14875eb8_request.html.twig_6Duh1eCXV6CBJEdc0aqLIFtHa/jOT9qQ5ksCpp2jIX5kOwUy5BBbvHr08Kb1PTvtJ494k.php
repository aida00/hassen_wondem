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

/* @webprofiler/Collector/request.html.twig */
class __TwigTemplate_8f15685f79418a2c74024344eaa66b0c extends Template
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
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@webprofiler/Collector/request.html.twig"));

        // line 20
        yield "
";
        // line 21
        yield from $this->unwrap()->yieldBlock('toolbar', $context, $blocks);
        // line 110
        yield "
";
        // line 111
        yield from $this->unwrap()->yieldBlock('panel', $context, $blocks);
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["_self", "collector", "profile", "profiler_url", "controller", "method", "route"]);        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    // line 21
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_toolbar(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_ad96c2d8979d8d23860453e7c5eb1520 = $this->extensions["Drupal\\tracer\\Twig\\Extension\\TraceableProfilerExtension"];
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "toolbar"));

        // line 22
        yield "
  ";
        // line 23
        $macros["helper"] = $this;
        // line 24
        yield "  ";
        $context["request_handler"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 25
            yield "    ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::callMacro($macros["helper"], "macro_set_handler", [CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "controller", [], "any", false, false, true, 25)], 25, $context, $this->getSourceContext()));
            yield "
  ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 27
        yield "
  ";
        // line 28
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "redirect", [], "any", false, false, true, 28)) {
            // line 29
            yield "    ";
            $context["redirect_handler"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 30
                yield "      ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::callMacro($macros["helper"], "macro_set_handler", [CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "redirect", [], "any", false, false, true, 30), "controller", [], "any", false, false, true, 30), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "redirect", [], "any", false, false, true, 30), "route", [], "any", false, false, true, 30), ((("GET" != CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "redirect", [], "any", false, false, true, 30), "method", [], "any", false, false, true, 30))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "redirect", [], "any", false, false, true, 30), "method", [], "any", false, false, true, 30)) : (""))], 30, $context, $this->getSourceContext()));
                yield "
    ";
                yield from [];
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 32
            yield "  ";
        }
        // line 33
        yield "
  ";
        // line 34
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "forwardtoken", [], "any", false, false, true, 34)) {
            // line 35
            yield "    ";
            $context["forward_profile"] = CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "childByToken", [CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "forwardtoken", [], "any", false, false, true, 35)], "method", false, false, true, 35);
            // line 36
            yield "    ";
            $context["forward_handler"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 37
                yield "      ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::callMacro($macros["helper"], "macro_set_handler", [((($context["forward_profile"] ?? null)) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["forward_profile"] ?? null), "collector", ["request"], "method", false, false, true, 37), "controller", [], "any", false, false, true, 37)) : ("n/a"))], 37, $context, $this->getSourceContext()));
                yield "
    ";
                yield from [];
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 39
            yield "  ";
        }
        // line 40
        yield "
  ";
        // line 41
        $context["request_status_code_color"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "statuscode", [], "any", false, false, true, 41) >= 400)) ? ("red") : ((((CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "statuscode", [], "any", false, false, true, 41) >= 300)) ? ("yellow") : ("green"))));
        // line 42
        yield "
  ";
        // line 43
        $context["icon"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 44
            yield "    <span class=\"sf-toolbar-status sf-toolbar-status-";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["request_status_code_color"] ?? null), "html", null, true);
            yield "\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "statuscode", [], "any", false, false, true, 44), "html", null, true);
            yield "</span>
    ";
            // line 45
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "route", [], "any", false, false, true, 45)) {
                // line 46
                yield "      ";
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "redirect", [], "any", false, false, true, 46)) {
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::include($this->env, $context, "@webprofiler/Icon/redirect.svg"));
                }
                // line 47
                yield "      ";
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "forwardtoken", [], "any", false, false, true, 47)) {
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::include($this->env, $context, "@webprofiler/Icon/forward.svg"));
                }
                // line 48
                yield "      <span class=\"sf-toolbar-label\">";
                ((("GET" != CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "method", [], "any", false, false, true, 48))) ? (yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "method", [], "any", false, false, true, 48), "html", null, true)) : (yield ""));
                yield " @</span>
      <span class=\"sf-toolbar-value sf-toolbar-info-piece-additional\">";
                // line 49
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "route", [], "any", false, false, true, 49), "html", null, true);
                yield "</span>
    ";
            }
            // line 51
            yield "  ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 52
        yield "
  ";
        // line 53
        $context["text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 54
            yield "    <div class=\"sf-toolbar-info-group\">
      <div class=\"sf-toolbar-info-piece\">
        <b>HTTP status</b>
        <span>";
            // line 57
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "statuscode", [], "any", false, false, true, 57), "html", null, true);
            yield " ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "statustext", [], "any", false, false, true, 57), "html", null, true);
            yield "</span>
      </div>

      ";
            // line 60
            if (("GET" != CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "method", [], "any", false, false, true, 60))) {
                // line 61
                yield "<div class=\"sf-toolbar-info-piece\">
          <b>Method</b>
          <span>";
                // line 63
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "method", [], "any", false, false, true, 63), "html", null, true);
                yield "</span>
        </div>";
            }
            // line 66
            yield "
      <div class=\"sf-toolbar-info-piece\">
        <b>Controller</b>
        <span>";
            // line 69
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["request_handler"] ?? null), "html", null, true);
            yield "</span>
      </div>

      <div class=\"sf-toolbar-info-piece\">
        <b>Route name</b>
        <span>";
            // line 74
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ((CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "route", [], "any", true, true, true, 74)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "route", [], "any", false, false, true, 74), "n/a")) : ("n/a")), "html", null, true);
            yield "</span>
      </div>

      <div class=\"sf-toolbar-info-piece\">
        <b>Has session</b>
        <span>";
            // line 79
            if (Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "sessionmetadata", [], "any", false, false, true, 79))) {
                yield "yes";
            } else {
                yield "no";
            }
            yield "</span>
      </div>
    </div>

    ";
            // line 83
            if (array_key_exists("redirect_handler", $context)) {
                // line 84
                yield "<div class=\"sf-toolbar-info-group\">
        <div class=\"sf-toolbar-info-piece\">
          <b>
            <span
              class=\"sf-toolbar-redirection-status sf-toolbar-status-yellow\">";
                // line 88
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "redirect", [], "any", false, false, true, 88), "status_code", [], "any", false, false, true, 88), "html", null, true);
                yield "</span>
            Redirect from
          </b>
          <span>";
                // line 91
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["redirect_handler"] ?? null), "html", null, true);
                yield "(<a
              href=\"";
                // line 92
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("webprofiler.dashboard", ["token" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "redirect", [], "any", false, false, true, 92), "token", [], "any", false, false, true, 92)]), "html", null, true);
                yield "\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "redirect", [], "any", false, false, true, 92), "token", [], "any", false, false, true, 92), "html", null, true);
                yield "</a>)</span>
        </div>
      </div>
    ";
            }
            // line 96
            yield "
    ";
            // line 97
            if (array_key_exists("forward_handler", $context)) {
                // line 98
                yield "      <div class=\"sf-toolbar-info-group\">
        <div class=\"sf-toolbar-info-piece\">
          <b>Forwarded to</b>
          <span>";
                // line 101
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["forward_handler"] ?? null), "html", null, true);
                yield "(<a
              href=\"";
                // line 102
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("webprofiler.dashboard", ["token" => CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "forwardtoken", [], "any", false, false, true, 102)]), "html", null, true);
                yield "\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "forwardtoken", [], "any", false, false, true, 102), "html", null, true);
                yield "</a>)</span>
        </div>
      </div>
    ";
            }
            // line 106
            yield "  ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 107
        yield "
  ";
        // line 108
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::include($this->env, $context, "@webprofiler/Profiler/toolbar_item.html.twig", ["link" => ($context["profiler_url"] ?? null)]));
        yield "
";
        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    // line 111
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_panel(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_ad96c2d8979d8d23860453e7c5eb1520 = $this->extensions["Drupal\\tracer\\Twig\\Extension\\TraceableProfilerExtension"];
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "panel"));

        // line 112
        yield "  ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "panel", [], "method", false, false, true, 112), "html", null, true);
        yield "
";
        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    // line 1
    public function macro_set_handler($__controller__ = null, $__route__ = null, $__method__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = [
            "controller" => $__controller__,
            "route" => $__route__,
            "method" => $__method__,
            "varargs" => $__varargs__,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            $__internal_ad96c2d8979d8d23860453e7c5eb1520 = $this->extensions["Drupal\\tracer\\Twig\\Extension\\TraceableProfilerExtension"];
            $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "macro", "set_handler"));

            // line 2
            yield "  ";
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["controller"] ?? null), "class", [], "any", true, true, true, 2)) {
                // line 3
                if (((array_key_exists("method", $context)) ? (Twig\Extension\CoreExtension::default(($context["method"] ?? null), false)) : (false))) {
                    yield "<span
      class=\"sf-toolbar-status sf-toolbar-redirection-method\">";
                    // line 4
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["method"] ?? null), "html", null, true);
                    yield "</span>";
                }
                // line 5
                $context["link"] = $this->extensions['Drupal\webprofiler\Twig\Extension\CodeExtension']->getFileLink(CoreExtension::getAttribute($this->env, $this->source, ($context["controller"] ?? null), "file", [], "any", false, false, true, 5), CoreExtension::getAttribute($this->env, $this->source, ($context["controller"] ?? null), "line", [], "any", false, false, true, 5));
                // line 6
                if (($context["link"] ?? null)) {
                    yield "<a href=\"";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["link"] ?? null), "html", null, true);
                    yield "\" title=\"";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["controller"] ?? null), "class", [], "any", false, false, true, 6), "html", null, true);
                    yield "\">";
                } else {
                    yield "<span title=\"";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["controller"] ?? null), "class", [], "any", false, false, true, 6), "html", null, true);
                    yield "\">";
                }
                // line 8
                if (((array_key_exists("route", $context)) ? (Twig\Extension\CoreExtension::default(($context["route"] ?? null), false)) : (false))) {
                    // line 9
                    yield "@";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["route"] ?? null), "html", null, true);
                } else {
                    // line 11
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::striptags($this->extensions['Drupal\webprofiler\Twig\Extension\CodeExtension']->abbrClass($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["controller"] ?? null), "class", [], "any", false, false, true, 11), "html", null, true))), "html", null, true);
                    // line 12
                    ((CoreExtension::getAttribute($this->env, $this->source, ($context["controller"] ?? null), "method", [], "any", false, false, true, 12)) ? (yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (" :: " . CoreExtension::getAttribute($this->env, $this->source, ($context["controller"] ?? null), "method", [], "any", false, false, true, 12)), "html", null, true)) : (yield ""));
                }
                // line 15
                if (($context["link"] ?? null)) {
                    yield "</a>";
                } else {
                    yield "</span>";
                }
            } else {
                // line 17
                yield "<span>";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ((array_key_exists("route", $context)) ? (Twig\Extension\CoreExtension::default(($context["route"] ?? null), ($context["controller"] ?? null))) : (($context["controller"] ?? null))), "html", null, true);
                yield "</span>";
            }
            
            $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@webprofiler/Collector/request.html.twig";
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
        return array (  382 => 17,  375 => 15,  372 => 12,  370 => 11,  366 => 9,  364 => 8,  352 => 6,  350 => 5,  346 => 4,  342 => 3,  339 => 2,  322 => 1,  311 => 112,  301 => 111,  291 => 108,  288 => 107,  284 => 106,  275 => 102,  271 => 101,  266 => 98,  264 => 97,  261 => 96,  252 => 92,  248 => 91,  242 => 88,  236 => 84,  234 => 83,  223 => 79,  215 => 74,  207 => 69,  202 => 66,  197 => 63,  193 => 61,  191 => 60,  183 => 57,  178 => 54,  176 => 53,  173 => 52,  169 => 51,  164 => 49,  159 => 48,  154 => 47,  149 => 46,  147 => 45,  140 => 44,  138 => 43,  135 => 42,  133 => 41,  130 => 40,  127 => 39,  120 => 37,  117 => 36,  114 => 35,  112 => 34,  109 => 33,  106 => 32,  99 => 30,  96 => 29,  94 => 28,  91 => 27,  84 => 25,  81 => 24,  79 => 23,  76 => 22,  66 => 21,  57 => 111,  54 => 110,  52 => 21,  49 => 20,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "@webprofiler/Collector/request.html.twig", "/var/www/html/web/modules/contrib/webprofiler/templates/Collector/request.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("macro" => 1, "block" => 21, "import" => 23, "set" => 24, "if" => 28);
        static $filters = array("escape" => 44, "default" => 74, "length" => 79, "file_link" => 5, "striptags" => 11, "abbr_class" => 11);
        static $functions = array("include" => 46, "path" => 92);

        try {
            $this->sandbox->checkSecurity(
                ['macro', 'block', 'import', 'set', 'if'],
                ['escape', 'default', 'length', 'file_link', 'striptags', 'abbr_class'],
                ['include', 'path'],
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
