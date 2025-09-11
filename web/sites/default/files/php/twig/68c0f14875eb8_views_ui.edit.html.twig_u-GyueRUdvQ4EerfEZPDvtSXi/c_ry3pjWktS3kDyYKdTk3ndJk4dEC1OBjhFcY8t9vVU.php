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

/* @help_topics/views_ui.edit.html.twig */
class __TwigTemplate_9d9fb05b6916a06dabe8c673e8080638 extends Template
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
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@help_topics/views_ui.edit.html.twig"));

        // line 7
        $context["views_link_text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            yield t("Views", array());
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 8
        $context["views_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink(($context["views_link_text"] ?? null), "entity.view.collection"));
        // line 9
        $context["views_overview_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("views.overview"));
        // line 10
        yield "<h2>";
        yield t("Goal", array());
        yield "</h2>
<p>";
        // line 11
        yield t("Edit an existing view display, to modify what data is displayed or how it is displayed.", array());
        yield "</p>
<h2>";
        // line 12
        yield t("Steps", array());
        yield "</h2>
<ol>
  <li>";
        // line 14
        yield t("If you are not already editing your view, in the <em>Manage</em> administrative menu, navigate to <em>Structure</em> &gt; <em>@views_link</em>. Find the view you want to edit, and click its <em>Edit</em> link.", array("@views_link" => ($context["views_link"] ?? null), ));
        yield "</li>
  <li>";
        // line 15
        yield t("Under <em>Displays</em>, click the display you want to edit.", array());
        yield "</li>
  <li>";
        // line 16
        yield t("Find the section whose settings you want to change, such as <em>Format</em> or <em>Filter criteria</em>. (See @views_overview_topic for more information.)", array("@views_overview_topic" => ($context["views_overview_topic"] ?? null), ));
        yield "</li>
  <li>";
        // line 17
        yield t("For sections containing lists (such as <em>Fields</em> and <em>Filter criteria</em>), to modify or delete an existing item, click the name of the item. To add a new item, click <em>Add</em> in the drop-down list. To change the order of items, click <em>Rearrange</em> in the drop-down list.", array());
        yield "</li>
  <li>";
        // line 18
        yield t("For sections containing individual settings (such as <em>Title</em> and <em>Format</em>), there are often two links for each setting. The first link shows the current value; click that link to change the value. If there is a second link called <em>Settings</em>, click that link to change the settings details. For example, if your <em>Format</em> is currently shown as <em>Unformatted list</em>, click <em>Unformatted list</em> to switch to using a <em>Grid</em> or <em>Table</em> format. Click <em>Settings</em> next to your format type to change the settings for your chosen format.", array());
        yield "</li>
  <li>";
        // line 19
        yield t("When you have finished changing all the settings, verify that the display is correct by clicking <em>Update preview</em>. Return to editing settings if necessary.", array());
        yield "</li>
  <li>";
        // line 20
        yield t("When you have verified the display, click <em>Save</em>. Alternatively, if you have made mistakes and want to discard your changes, click <em>Cancel</em>.", array());
        yield "</li>
</ol>
<h2>";
        // line 22
        yield t("Additional resources", array());
        yield "</h2>
<ul>
  <li>";
        // line 24
        yield t("<a href=\"https://www.drupal.org/docs/user_guide/en/views-chapter.html\">Creating Listings with Views (Drupal User Guide)</a>", array());
        yield "</li>
</ul>";
        
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->leave($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@help_topics/views_ui.edit.html.twig";
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
        return array (  104 => 24,  99 => 22,  94 => 20,  90 => 19,  86 => 18,  82 => 17,  78 => 16,  74 => 15,  70 => 14,  65 => 12,  61 => 11,  56 => 10,  54 => 9,  52 => 8,  47 => 7,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "@help_topics/views_ui.edit.html.twig", "/var/www/html/web/core/modules/views_ui/help_topics/views_ui.edit.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 7);
        static $filters = array("escape" => 14);
        static $functions = array("render_var" => 8, "help_route_link" => 8, "help_topic_link" => 9);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_route_link', 'help_topic_link'],
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
