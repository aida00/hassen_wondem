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

/* @help_topics/system.maintenance_mode.html.twig */
class __TwigTemplate_73cc85374a3e205634279da919ba7a5a extends Template
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
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@help_topics/system.maintenance_mode.html.twig"));

        // line 7
        $context["cache_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("system.cache"));
        // line 8
        $context["maintenance_link_text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            yield t("Maintenance mode", array());
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 9
        $context["maintenance_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink(($context["maintenance_link_text"] ?? null), "system.site_maintenance_mode"));
        // line 10
        yield "<h2>";
        yield t("Goal", array());
        yield "</h2>
<p>";
        // line 11
        yield t("Put your site in maintenance mode to perform maintenance operations, and then return to normal mode when finished.", array());
        yield "</p>
<h2>";
        // line 12
        yield t("What is maintenance mode?", array());
        yield "</h2>
<p>";
        // line 13
        yield t("When your site is in maintenance mode, most site visitors will see a simple maintenance mode message page, rather than being able to use the full functionality of the site. Users with <em>Use the site in maintenance mode</em> permission who are already logged in will be able to use the full site, and the log in page at <em>/user</em> will also be accessible to anyone.", array());
        yield "</p>
<h2>";
        // line 14
        yield t("Steps", array());
        yield "</h2>
<ol>
  <li>";
        // line 16
        yield t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>Development</em> &gt; <em>@maintenance_link</em>.", array("@maintenance_link" => ($context["maintenance_link"] ?? null), ));
        yield "</li>
  <li>";
        // line 17
        yield t("Check <em>Put site into maintenance mode</em>, optionally change the <em>Message to display when in maintenance mode</em>, and click <em>Save configuration</em>. Your site will be in maintenance mode.", array());
        yield "</li>
  <li>";
        // line 18
        yield t("Perform your maintenance operations.", array());
        yield "</li>
  <li>";
        // line 19
        yield t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>Development</em> &gt; <em>@maintenance_link</em>.", array("@maintenance_link" => ($context["maintenance_link"] ?? null), ));
        yield "</li>
  <li>";
        // line 20
        yield t("Uncheck <em>Put site into maintenance mode</em> and click <em>Save configuration</em>. Your site will be back in normal operation mode.", array());
        yield "</li>
  <li>";
        // line 21
        yield t("Clear the site cache. See @cache_topic for instructions.", array("@cache_topic" => ($context["cache_topic"] ?? null), ));
        yield "</li>
</ol>";
        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@help_topics/system.maintenance_mode.html.twig";
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
        return array (  98 => 21,  94 => 20,  90 => 19,  86 => 18,  82 => 17,  78 => 16,  73 => 14,  69 => 13,  65 => 12,  61 => 11,  56 => 10,  54 => 9,  49 => 8,  47 => 7,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "@help_topics/system.maintenance_mode.html.twig", "/var/www/html/web/core/modules/system/help_topics/system.maintenance_mode.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 8);
        static $filters = array("escape" => 16);
        static $functions = array("render_var" => 7, "help_topic_link" => 7, "help_route_link" => 9);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_topic_link', 'help_route_link'],
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
