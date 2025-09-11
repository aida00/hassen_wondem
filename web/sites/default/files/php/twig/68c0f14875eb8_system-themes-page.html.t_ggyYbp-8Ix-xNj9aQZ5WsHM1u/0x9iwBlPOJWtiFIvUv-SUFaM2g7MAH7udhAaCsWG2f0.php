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

/* core/themes/claro/templates/system-themes-page.html.twig */
class __TwigTemplate_ee3ed442407b71913a6115896f905aa5 extends Template
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
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "core/themes/claro/templates/system-themes-page.html.twig"));

        // line 36
        yield "<div";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["attributes"] ?? null), "html", null, true);
        yield ">
  ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["theme_groups"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["theme_group"]) {
            // line 38
            yield "    ";
            // line 39
            $context["theme_group_classes"] = ["system-themes-list", ("system-themes-list--" . CoreExtension::getAttribute($this->env, $this->source,             // line 41
$context["theme_group"], "state", [], "any", false, false, true, 41)), "clearfix"];
            // line 45
            yield "
    ";
            // line 47
            $context["card_alignment"] = (((CoreExtension::getAttribute($this->env, $this->source, $context["theme_group"], "state", [], "any", false, false, true, 47) == "installed")) ? ("horizontal") : ("vertical"));
            // line 49
            yield "
    ";
            // line 50
            if ( !CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, true, 50)) {
                // line 51
                yield "      <hr>
    ";
            }
            // line 53
            yield "
    <div";
            // line 54
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme_group"], "attributes", [], "any", false, false, true, 54), "addClass", [($context["theme_group_classes"] ?? null)], "method", false, false, true, 54), "html", null, true);
            yield ">
      <h2 class=\"system-themes-list__header\">";
            // line 55
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["theme_group"], "title", [], "any", false, false, true, 55), "html", null, true);
            yield "</h2>
      <div class=\"card-list ";
            // line 56
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((($context["card_alignment"] ?? null) == "horizontal")) ? ("card-list--two-cols") : ("card-list--four-cols")));
            yield "\">
        ";
            // line 57
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["theme_group"], "themes", [], "any", false, false, true, 57));
            foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
                // line 58
                yield "          ";
                // line 59
                $context["theme_classes"] = [((CoreExtension::getAttribute($this->env, $this->source,                 // line 60
$context["theme"], "is_default", [], "any", false, false, true, 60)) ? ("theme-default") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,                 // line 61
$context["theme"], "is_admin", [], "any", false, false, true, 61)) ? ("theme-admin") : ("")), "card", ("card--" .                 // line 63
($context["card_alignment"] ?? null)), "card-list__item"];
                // line 67
                yield "          ";
                // line 68
                $context["theme_title_classes"] = ["card__content-item", "heading-f"];
                // line 73
                yield "          ";
                // line 74
                $context["theme_description_classes"] = ["card__content-item"];
                // line 78
                yield "          <div";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "attributes", [], "any", false, false, true, 78), "addClass", [($context["theme_classes"] ?? null)], "method", false, false, true, 78), "setAttribute", ["aria-labelledby", CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "title_id", [], "any", false, false, true, 78)], "method", false, false, true, 78), "setAttribute", ["aria-describedby", ((CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "description_id", [], "any", false, false, true, 78)) ?: (null))], "method", false, false, true, 78), "html", null, true);
                yield ">
            ";
                // line 79
                if (CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "screenshot", [], "any", false, false, true, 79)) {
                    // line 80
                    yield "              <div class=\"card__image\">
                ";
                    // line 81
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "screenshot", [], "any", false, false, true, 81), "html", null, true);
                    yield "
              </div>
            ";
                }
                // line 84
                yield "            <div class=\"card__content-wrapper\">
              <div class=\"card__content\">
                <h3";
                // line 86
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $this->extensions['Drupal\Core\Template\TwigExtension']->createAttribute(["id" => CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "title_id", [], "any", false, false, true, 86)]), "addClass", [($context["theme_title_classes"] ?? null)], "method", false, false, true, 86), "html", null, true);
                yield " id=";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "title_id", [], "any", false, false, true, 86), "html", null, true);
                yield ">";
                // line 87
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "name", [], "any", false, false, true, 87), "html", null, true);
                yield " ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "version", [], "any", false, false, true, 87), "html", null, true);
                // line 88
                if (CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "notes", [], "any", false, false, true, 88)) {
                    // line 89
                    yield "                    (";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->safeJoin($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "notes", [], "any", false, false, true, 89), ", "));
                    yield ")";
                }
                // line 91
                yield "</h3>

                ";
                // line 93
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "description", [], "any", false, false, true, 93) && CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "description_id", [], "any", false, false, true, 93))) {
                    // line 94
                    yield "                  <div";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $this->extensions['Drupal\Core\Template\TwigExtension']->createAttribute(["id" => ((CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "description_id", [], "any", false, false, true, 94)) ?: (null))]), "addClass", [($context["theme_description_classes"] ?? null)], "method", false, false, true, 94), "html", null, true);
                    yield ">
                    ";
                    // line 95
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "description", [], "any", false, false, true, 95), "html", null, true);
                    yield "
                  </div>";
                }
                // line 98
                yield "</div>

              <div class=\"card__footer\">
                ";
                // line 101
                if (CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "module_dependencies", [], "any", false, false, true, 101)) {
                    // line 102
                    yield "                  <div class=\"theme-info__requires\">
                    ";
                    // line 103
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Requires: @module_dependencies", ["@module_dependencies" => $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "module_dependencies", [], "any", false, false, true, 103))]));
                    yield "
                  </div>
                ";
                }
                // line 106
                yield "                ";
                // line 107
                yield "                ";
                if (CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "incompatible", [], "any", false, false, true, 107)) {
                    // line 108
                    yield "                  <small class=\"incompatible\">";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "incompatible", [], "any", false, false, true, 108), "html", null, true);
                    yield "</small>
                ";
                } else {
                    // line 110
                    yield "                    ";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "operations", [], "any", false, false, true, 110), "html", null, true);
                    yield "
                ";
                }
                // line 112
                yield "              </div>
            </div>
          </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['theme'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 116
            yield "      </div>
    </div>
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
        unset($context['_seq'], $context['_key'], $context['theme_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 119
        yield "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["attributes", "theme_groups", "loop"]);        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "core/themes/claro/templates/system-themes-page.html.twig";
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
        return array (  232 => 119,  216 => 116,  207 => 112,  201 => 110,  195 => 108,  192 => 107,  190 => 106,  184 => 103,  181 => 102,  179 => 101,  174 => 98,  169 => 95,  164 => 94,  162 => 93,  158 => 91,  153 => 89,  151 => 88,  147 => 87,  142 => 86,  138 => 84,  132 => 81,  129 => 80,  127 => 79,  122 => 78,  120 => 74,  118 => 73,  116 => 68,  114 => 67,  112 => 63,  111 => 61,  110 => 60,  109 => 59,  107 => 58,  103 => 57,  99 => 56,  95 => 55,  91 => 54,  88 => 53,  84 => 51,  82 => 50,  79 => 49,  77 => 47,  74 => 45,  72 => 41,  71 => 39,  69 => 38,  52 => 37,  47 => 36,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "core/themes/claro/templates/system-themes-page.html.twig", "/var/www/html/web/core/themes/claro/templates/system-themes-page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 37, "set" => 39, "if" => 50);
        static $filters = array("escape" => 36, "safe_join" => 89, "t" => 103, "render" => 103);
        static $functions = array("create_attribute" => 86);

        try {
            $this->sandbox->checkSecurity(
                ['for', 'set', 'if'],
                ['escape', 'safe_join', 't', 'render'],
                ['create_attribute'],
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
