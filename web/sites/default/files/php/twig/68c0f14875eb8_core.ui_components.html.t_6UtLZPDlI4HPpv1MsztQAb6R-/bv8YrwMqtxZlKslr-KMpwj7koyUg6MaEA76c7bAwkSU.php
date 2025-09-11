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

/* @help_topics/core.ui_components.html.twig */
class __TwigTemplate_b35739d6538efc6ce931036ace15240e extends Template
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
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@help_topics/core.ui_components.html.twig"));

        // line 7
        $context["accessibility_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.ui_accessibility"));
        // line 8
        $context["settings_tray_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.settings_tray"));
        // line 9
        $context["admin_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink("/admin", "system.admin"));
        // line 10
        yield "<h2>";
        yield t("What administrative interface components are available?", array());
        yield "</h2>
<p>";
        // line 11
        yield t("The following administrative interface components are provided by the core software and its modules (some contributed modules offer additional functionality):", array());
        yield "</p>
<ul>
  <li>";
        // line 13
        yield t("Accessibility features, to enable all users to perform administrative tasks. See @accessibility_topic for more information.", array("@accessibility_topic" => ($context["accessibility_topic"] ?? null), ));
        yield "</li>
  <li>";
        // line 14
        yield t("A menu system, which you can navigate to find pages for administrative tasks. The core Toolbar module displays this menu on the top or left side of the page (right side in right-to-left languages). There are also contributed module replacements for the core Toolbar module, with additional features, such as the <a href=\"https://www.drupal.org/project/admin_toolbar\">Admin Toolbar module</a>.", array());
        yield "</li>
  <li>";
        // line 15
        yield t("The core Shortcuts module enhances the toolbar with a configurable list of links to commonly-used tasks.", array());
        yield "</li>
  <li>";
        // line 16
        yield t("If you install the core Contextual Links module, non-administrative pages will contain links leading to related administrative tasks.", array());
        yield "</li>
  <li>";
        // line 17
        yield t("In-place or <em>quick</em> editing. In-place editing of configuration is provided by the core Settings Tray module. See @settings_tray_topic for more information.", array("@settings_tray_topic" => ($context["settings_tray_topic"] ?? null), ));
        yield "</li>
  <li>";
        // line 18
        yield t("The core Help module displays help topics, and provides a Help block that can be placed on administrative pages to provide an overview of their functionality.", array());
        yield "</li>
</ul>
<h2>";
        // line 20
        yield t("What are the sections of the administrative menu?", array());
        yield "</h2>
<p>";
        // line 21
        yield t("The administrative menu, which you can navigate by visiting <em>@admin_link</em> on your site or by using an administrative toolbar, has the following sections (some may not be available, depending on which modules are currently installed on your site, and your permissions):", array("@admin_link" => ($context["admin_link"] ?? null), ));
        yield "</p>
<ul>
  <li>";
        // line 23
        yield t("<strong>Content:</strong> Find, manage, and create new pages; manage comments and files.", array());
        yield "</li>
  <li>";
        // line 24
        yield t("<strong>Structure:</strong> Place and edit blocks, set up content types and fields, configure menus, administer taxonomy, and configure some contributed modules.", array());
        yield "</li>
  <li>";
        // line 25
        yield t("<strong>Appearance:</strong> Switch between themes, install themes, and update existing themes.", array());
        yield "</li>
  <li>";
        // line 26
        yield t("<strong>Extend:</strong> Update, install, and uninstall modules.", array());
        yield "</li>
  <li>";
        // line 27
        yield t("<strong>Configuration:</strong> Configure the settings for various site functionality, including some contributed modules.", array());
        yield "</li>
  <li>";
        // line 28
        yield t("<strong>People:</strong> Manage user accounts and permissions.", array());
        yield "</li>
  <li>";
        // line 29
        yield t("<strong>Reports:</strong> Display information about site security, necessary updates, and site activity.", array());
        yield "</li>
  <li>";
        // line 30
        yield t("<strong>Help:</strong> Get help on using the administrative interface.", array());
        yield "</li>
</ul>
<h2>";
        // line 32
        yield t("Administrative interface overview", array());
        yield "</h2>
<p>";
        // line 33
        yield t("Install the core modules mentioned above to use the corresponding aspect of the administrative interface. See the related topics listed below for more details on some aspects of the administrative interface.", array());
        yield "</p>";
        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@help_topics/core.ui_components.html.twig";
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
        return array (  134 => 33,  130 => 32,  125 => 30,  121 => 29,  117 => 28,  113 => 27,  109 => 26,  105 => 25,  101 => 24,  97 => 23,  92 => 21,  88 => 20,  83 => 18,  79 => 17,  75 => 16,  71 => 15,  67 => 14,  63 => 13,  58 => 11,  53 => 10,  51 => 9,  49 => 8,  47 => 7,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "@help_topics/core.ui_components.html.twig", "/var/www/html/web/core/modules/help/help_topics/core.ui_components.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 10);
        static $filters = array("escape" => 13);
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
