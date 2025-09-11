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

/* @webprofiler/Collector/database.html.twig */
class __TwigTemplate_0efd40c84dcadc519143b2a39e757803 extends Template
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
        $macros["_self"] = $this->macros["_self"] = $this;
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_ad96c2d8979d8d23860453e7c5eb1520 = $this->extensions["Drupal\\tracer\\Twig\\Extension\\TraceableProfilerExtension"];
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@webprofiler/Collector/database.html.twig"));

        // line 1
        yield from $this->unwrap()->yieldBlock('toolbar', $context, $blocks);
        // line 32
        yield "
";
        // line 33
        yield from $this->unwrap()->yieldBlock('panel', $context, $blocks);
        // line 53
        yield "
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["collector", "profiler_url", "token", "_self", "loop", "qid"]);        
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
        $context["icon"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 4
            yield "    ";
            $context["status"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "querycount", [], "any", false, false, true, 4) > 50)) ? ("yellow") : (""));
            // line 5
            yield "
    ";
            // line 6
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::include($this->env, $context, "@webprofiler/Icon/002--database.svg"));
            yield "
    <span class=\"sf-toolbar-value\">";
            // line 7
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "querycount", [], "any", false, false, true, 7), "html", null, true);
            yield "</span>
    <span class=\"sf-toolbar-info-piece-additional-detail\">
      <span class=\"sf-toolbar-label\">in</span>
      <span class=\"sf-toolbar-value\">";
            // line 10
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::sprintf("%0.2f", CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "time", [], "any", false, false, true, 10)), "html", null, true);
            yield "</span>
      <span class=\"sf-toolbar-label\">ms</span>
    </span>
  ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 14
        yield "
  ";
        // line 15
        $context["text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 16
            yield "    <div class=\"sf-toolbar-info-piece\">
      <b>";
            // line 17
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Db queries"));
            yield "</b>
      <span class=\"sf-toolbar-status\">";
            // line 18
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "querycount", [], "any", false, false, true, 18), "html", null, true);
            yield "</span>
    </div>
    <div class=\"sf-toolbar-info-piece\">
      <b>";
            // line 21
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Query time"));
            yield "</b>
      <span>";
            // line 22
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::sprintf("%0.2f", CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "time", [], "any", false, false, true, 22)), "html", null, true);
            yield " ms</span>
    </div>
    <div class=\"sf-toolbar-info-piece\">
      <b>";
            // line 25
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Default database"));
            yield "</b>
      <span>";
            // line 26
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "database", [], "any", false, false, true, 26), "driver", [], "any", false, false, true, 26), "html", null, true);
            yield "://";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "database", [], "any", false, false, true, 26), "host", [], "any", false, false, true, 26), "html", null, true);
            yield ":";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "database", [], "any", false, false, true, 26), "port", [], "any", false, false, true, 26), "html", null, true);
            yield "/";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "database", [], "any", false, false, true, 26), "database", [], "any", false, false, true, 26), "html", null, true);
            yield "</span>
    </div>
  ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 29
        yield "
  ";
        // line 30
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::include($this->env, $context, "@webprofiler/Profiler/toolbar_item.html.twig", ["link" => ($context["profiler_url"] ?? null), "status" => ((array_key_exists("status", $context)) ? (Twig\Extension\CoreExtension::default(($context["status"] ?? null), "")) : (""))]));
        yield "
";
        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    // line 33
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_panel(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_ad96c2d8979d8d23860453e7c5eb1520 = $this->extensions["Drupal\\tracer\\Twig\\Extension\\TraceableProfilerExtension"];
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "panel"));

        // line 34
        yield "  <p style=\"margin-bottom: 50px\"><b>";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("You can export all data in CSV format using Drush: %command", ["%command" => (("drush webprofiler:export-database-data " . ($context["token"] ?? null)) . " <output_folder>")]));
        yield "</b></p>

  ";
        // line 36
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "queries", [], "any", false, false, true, 36)) > CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "getQueryDetailedOutputThreshold", [], "any", false, false, true, 36))) {
            // line 37
            yield "    <p>";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("More than %query queries detected, disable the detailed output.", ["%query" => CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "getQueryDetailedOutputThreshold", [], "any", false, false, true, 37)]));
            yield "</p>
    <ul>
      ";
            // line 39
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "queries", [], "any", false, false, true, 39));
            foreach ($context['_seq'] as $context["_key"] => $context["query"]) {
                // line 40
                yield "        <li>";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\webprofiler\Twig\Extension\DatabaseExtension']->queryExecutable($context["query"]));
                yield "</li>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['query'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 42
            yield "    </ul>
  ";
        } else {
            // line 44
            yield "    ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("webprofiler/database"), "html", null, true);
            yield "

    ";
            // line 46
            $context["queryHighlightThreshold"] = CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "queryHighlightThreshold", [], "any", false, false, true, 46);
            // line 47
            yield "
    ";
            // line 48
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "queries", [], "any", false, false, true, 48));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["query"]) {
                // line 49
                yield "      ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::callMacro($macros["_self"], "macro_query", [$context["query"], ($context["token"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, true, 49), ($context["queryHighlightThreshold"] ?? null)], 49, $context, $this->getSourceContext()));
                yield "
    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['query'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 51
            yield "  ";
        }
        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    // line 54
    public function macro_query($__query__ = null, $__token__ = null, $__qid__ = null, $__queryHighlightThreshold__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = [
            "query" => $__query__,
            "token" => $__token__,
            "qid" => $__qid__,
            "queryHighlightThreshold" => $__queryHighlightThreshold__,
            "varargs" => $__varargs__,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            $__internal_ad96c2d8979d8d23860453e7c5eb1520 = $this->extensions["Drupal\\tracer\\Twig\\Extension\\TraceableProfilerExtension"];
            $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "macro", "query"));

            // line 55
            yield "  ";
            $context["slow_query"] = (CoreExtension::getAttribute($this->env, $this->source, ($context["query"] ?? null), "time", [], "any", false, false, true, 55) > (($context["queryHighlightThreshold"] ?? null) / 10));
            // line 56
            yield "  <div class=\"wp-db-query\">
    <pre style=\"white-space: unset; border-left: 8px solid ";
            // line 57
            if (($context["slow_query"] ?? null)) {
                yield "darkgoldenrod";
            } else {
                yield "green";
            }
            yield "; padding-left: 10px\">
      <code class=\"wp-query-placeholder\">";
            // line 58
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\webprofiler\Twig\Extension\DatabaseExtension']->query(CoreExtension::getAttribute($this->env, $this->source, ($context["query"] ?? null), "query", [], "any", false, false, true, 58)));
            yield "</code>
      ";
            // line 59
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["query"] ?? null), "args", [], "any", false, false, true, 59)) {
                yield "<code class=\"wp-query-executable is-hidden\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\webprofiler\Twig\Extension\DatabaseExtension']->queryExecutable(($context["query"] ?? null)));
                yield "</code>";
            }
            // line 60
            yield "    </pre>

    <table class=\"webprofiler__table responsive-enabled\" data-striping=\"1\">
      <thead>
      <tr>
        <th>Time</th>
        <th>Caller</th>
        <th>Database</th>
        <th>Target</th>
      </tr>
      </thead>
      <tbody>
      <tr class=\"odd\">
        <td class=\"webprofiler__key\">";
            // line 73
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["query"] ?? null), "time", [], "any", false, false, true, 73), "html", null, true);
            yield " ms</td>
        <td class=\"webprofiler__key\">";
            // line 74
            if ( !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["query"] ?? null), "caller", [], "any", false, false, true, 74), "class", [], "any", false, false, true, 74))) {
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["query"] ?? null), "caller", [], "any", false, false, true, 74), "class", [], "any", false, false, true, 74)), "html", null, true);
            }
            yield "</td>
        <td class=\"webprofiler__key\">";
            // line 75
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["query"] ?? null), "database", [], "any", false, false, true, 75), "html", null, true);
            yield "</td>
        <td class=\"webprofiler__key\">";
            // line 76
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["query"] ?? null), "target", [], "any", false, false, true, 76), "html", null, true);
            yield "</td>
      </tr>
      </tbody>
    </table>

    <div class=\"wp-executable-actions\">
      ";
            // line 82
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["query"] ?? null), "args", [], "any", false, false, true, 82)) {
                yield "<a class=\"wp-executable-toggle\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Swap placeholders"));
                yield "</a>";
            }
            // line 83
            yield "      <a class=\"wp-query-copy\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Copy query"));
            yield "</a>
      ";
            // line 84
            if (($this->extensions['Drupal\webprofiler\Twig\Extension\DatabaseExtension']->queryType(CoreExtension::getAttribute($this->env, $this->source, ($context["query"] ?? null), "query", [], "any", false, false, true, 84)) == "SELECT")) {
                yield "<a href=\"";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("webprofiler.database.explain", ["token" => ($context["token"] ?? null), "qid" => ($context["qid"] ?? null)]), "html", null, true);
                yield "\" class=\"use-ajax wp-query-explain\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Explain"));
                yield "</a>";
            }
            // line 85
            yield "    </div>
    <div class=\"js--explain-target-";
            // line 86
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["qid"] ?? null), "html", null, true);
            yield "\"></div>
  </div>
";
            
            $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@webprofiler/Collector/database.html.twig";
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
        return array (  361 => 86,  358 => 85,  350 => 84,  345 => 83,  339 => 82,  330 => 76,  326 => 75,  320 => 74,  316 => 73,  301 => 60,  295 => 59,  291 => 58,  283 => 57,  280 => 56,  277 => 55,  259 => 54,  250 => 51,  233 => 49,  216 => 48,  213 => 47,  211 => 46,  205 => 44,  201 => 42,  192 => 40,  188 => 39,  182 => 37,  180 => 36,  174 => 34,  164 => 33,  154 => 30,  151 => 29,  138 => 26,  134 => 25,  128 => 22,  124 => 21,  118 => 18,  114 => 17,  111 => 16,  109 => 15,  106 => 14,  98 => 10,  92 => 7,  88 => 6,  85 => 5,  82 => 4,  80 => 3,  77 => 2,  67 => 1,  57 => 53,  55 => 33,  52 => 32,  50 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "@webprofiler/Collector/database.html.twig", "/var/www/html/web/modules/contrib/webprofiler/templates/Collector/database.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("block" => 1, "macro" => 54, "set" => 3, "if" => 36, "for" => 39);
        static $filters = array("escape" => 7, "format" => 10, "t" => 17, "default" => 30, "length" => 36, "raw" => 40, "lower" => 74);
        static $functions = array("include" => 6, "query_executable" => 40, "attach_library" => 44, "query" => 58, "query_type" => 84, "path" => 84);

        try {
            $this->sandbox->checkSecurity(
                ['block', 'macro', 'set', 'if', 'for'],
                ['escape', 'format', 't', 'default', 'length', 'raw', 'lower'],
                ['include', 'query_executable', 'attach_library', 'query', 'query_type', 'path'],
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
