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

/* @help_topics/announcements_feed.overview.html.twig */
class __TwigTemplate_e77c93b8de23d63da0b65109fc177256 extends Template
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
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@help_topics/announcements_feed.overview.html.twig"));

        // line 5
        $context["actions_link_text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 6
            yield t("Announcements", array());
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 8
        $context["actions_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink(($context["actions_link_text"] ?? null), "announcements_feed.announcement"));
        // line 9
        $context["permissions_link_text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 10
            yield t("View official announcements related to Drupal", array());
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 12
        $context["permissions_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink(($context["permissions_link_text"] ?? null), "user.admin_permissions.module", ["modules" => "announcements_feed"]));
        // line 13
        yield "<h2>";
        yield t("What are Drupal announcements?", array());
        yield "</h2>
<p>";
        // line 14
        yield t("A feed of announcements about the Drupal project and Drupal Association programs.", array());
        yield "</p>
<p>";
        // line 15
        yield t("The purpose of this feed is to provide a channel for outreach directly to Drupal site owners. This content must be highly relevant to site owners interests, serve the strategic goals of the project, and/or promote the sustainability of the project and the Drupal Association.", array());
        yield "</p>
<p>";
        // line 16
        yield t("The module sources its content from a JSON feed generated from <a href=\"https://www.drupal.org/about/announcements\">here</a>. The governance policy for the content is documented <a href=\"https://www.drupal.org/node/3274085\">here</a>.", array());
        yield "</p>
<h2>";
        // line 17
        yield t("How can I see the Announcements in my site?", array());
        yield "</h2>
<p>";
        // line 18
        yield t("If you have the toolbar module enabled, you will see a direct link to them in the toolbar. If the toolbar module is not enabled, the content can always be accessed in the <em>@actions_link</em> page.", array("@actions_link" => ($context["actions_link"] ?? null), ));
        yield "</p>
<h2>";
        // line 19
        yield t("Who can see the Announcements?", array());
        yield "</h2>
<p>";
        // line 20
        yield t("Users with the <em>@permissions_link</em> permission can view Drupal announcements.", array("@permissions_link" => ($context["permissions_link"] ?? null), ));
        yield "</p>
<h2>";
        // line 21
        yield t("Additional resources", array());
        yield "</h2>
<ul>
  <li><a href=\"https://www.drupal.org/docs/core-modules-and-themes/core-modules/announcements-feed/announcements-feed-module-overview\">";
        // line 23
        yield t("Announcement module overview", array());
        yield "</a></li>
</ul>";
        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@help_topics/announcements_feed.overview.html.twig";
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
        return array (  101 => 23,  96 => 21,  92 => 20,  88 => 19,  84 => 18,  80 => 17,  76 => 16,  72 => 15,  68 => 14,  63 => 13,  61 => 12,  57 => 10,  55 => 9,  53 => 8,  49 => 6,  47 => 5,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "@help_topics/announcements_feed.overview.html.twig", "/var/www/html/web/core/modules/announcements_feed/help_topics/announcements_feed.overview.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 5, "trans" => 6);
        static $filters = array("escape" => 18);
        static $functions = array("render_var" => 8, "help_route_link" => 8);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_route_link'],
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
