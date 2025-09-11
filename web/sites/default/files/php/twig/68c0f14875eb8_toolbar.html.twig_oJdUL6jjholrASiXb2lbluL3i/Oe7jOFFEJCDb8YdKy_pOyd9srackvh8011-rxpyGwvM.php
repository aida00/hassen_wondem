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

/* @webprofiler/Profiler/toolbar.html.twig */
class __TwigTemplate_689ca8f7af217ccd2f92095fc4e2bb49 extends Template
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
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@webprofiler/Profiler/toolbar.html.twig"));

        // line 1
        yield "<!-- START of Drupal WebProfiler Toolbar -->
<div id=\"sfMiniToolbar-";
        // line 2
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["token"] ?? null), "html", null, true);
        yield "\" class=\"sf-minitoolbar\" data-no-turbolink>
  <button type=\"button\" title=\"Show Drupal WebProfiler toolbar\" id=\"sfToolbarMiniToggler-";
        // line 3
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["token"] ?? null), "html", null, true);
        yield "\" accesskey=\"D\" aria-expanded=\"false\" aria-controls=\"sfToolbarMainContent-";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["token"] ?? null), "html", null, true);
        yield "\">
    ";
        // line 4
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::include($this->env, $context, "@webprofiler/Icon/drupal-10.svg"));
        yield "
  </button>
</div>
<div id=\"sfToolbarClearer-";
        // line 7
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["token"] ?? null), "html", null, true);
        yield "\" class=\"sf-toolbar-clearer\"></div>

<div id=\"sfToolbarMainContent-";
        // line 9
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["token"] ?? null), "html", null, true);
        yield "\" class=\"sf-toolbarreset clear-fix\" data-no-turbolink>
  ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["templates"] ?? null));
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
        foreach ($context['_seq'] as $context["name"] => $context["template"]) {
            // line 11
            yield "    ";
            if (            $this->loadTemplate($context["template"], "@webprofiler/Profiler/toolbar.html.twig", 11)->unwrap()->hasBlock("toolbar", $context)) {
                // line 12
                yield "      ";
                $__internal_compile_0 = $context;
                $__internal_compile_1 = ["collector" => ((                // line 13
($context["profile"] ?? null)) ? (CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "getcollector", [$context["name"]], "method", false, false, true, 13)) : (null)), "profiler_url" =>                 // line 14
($context["profiler_url"] ?? null), "token" => ((                // line 15
$context["token"]) ?? (((($context["profile"] ?? null)) ? (CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "token", [], "any", false, false, true, 15)) : (null)))), "name" =>                 // line 16
$context["name"], "csp_script_nonce" =>                 // line 17
($context["csp_script_nonce"] ?? null), "csp_style_nonce" =>                 // line 18
($context["csp_style_nonce"] ?? null)];
                if (!is_iterable($__internal_compile_1)) {
                    throw new RuntimeError('Variables passed to the "with" tag must be a mapping.', 13, $this->getSourceContext());
                }
                $__internal_compile_1 = CoreExtension::toArray($__internal_compile_1);
                $context = $__internal_compile_1 + $context + $this->env->getGlobals();
                // line 20
                yield "        ";
                yield from                 $this->loadTemplate($context["template"], "@webprofiler/Profiler/toolbar.html.twig", 20)->unwrap()->yieldBlock("toolbar", $context);
                yield "
      ";
                $context = $__internal_compile_0;
                // line 22
                yield "    ";
            }
            // line 23
            yield "  ";
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
        unset($context['_seq'], $context['name'], $context['template'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        yield "
  <button class=\"hide-button\" type=\"button\" id=\"sfToolbarHideButton-";
        // line 25
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["token"] ?? null), "html", null, true);
        yield "\" title=\"Close Toolbar\" accesskey=\"D\" aria-expanded=\"true\" aria-controls=\"sfToolbarMainContent-";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["token"] ?? null), "html", null, true);
        yield "\">
    ";
        // line 26
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::include($this->env, $context, "@webprofiler/Icon/close.svg"));
        yield "
  </button>
</div>
<!-- END of Drupal WebProfiler Toolbar -->
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["token", "templates", "profile", "profiler_url", "csp_script_nonce", "csp_style_nonce"]);        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@webprofiler/Profiler/toolbar.html.twig";
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
        return array (  142 => 26,  136 => 25,  133 => 24,  119 => 23,  116 => 22,  110 => 20,  103 => 18,  102 => 17,  101 => 16,  100 => 15,  99 => 14,  98 => 13,  95 => 12,  92 => 11,  75 => 10,  71 => 9,  66 => 7,  60 => 4,  54 => 3,  50 => 2,  47 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "@webprofiler/Profiler/toolbar.html.twig", "/var/www/html/web/modules/contrib/webprofiler/templates/Profiler/toolbar.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 10, "if" => 11, "with" => 12);
        static $filters = array("escape" => 2);
        static $functions = array("include" => 4);

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if', 'with'],
                ['escape'],
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
