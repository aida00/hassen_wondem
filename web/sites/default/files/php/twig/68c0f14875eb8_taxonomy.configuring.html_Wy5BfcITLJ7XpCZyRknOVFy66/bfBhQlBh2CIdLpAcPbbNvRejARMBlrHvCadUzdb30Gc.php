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

/* @help_topics/taxonomy.configuring.html.twig */
class __TwigTemplate_aeb1893e9e666520945e86941b518501 extends Template
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
        $__internal_ad96c2d8979d8d23860453e7c5eb1520->enter($__internal_ad96c2d8979d8d23860453e7c5eb1520_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@help_topics/taxonomy.configuring.html.twig"));

        // line 9
        $context["taxonomy_permissions_link_text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 10
            yield "  ";
            yield t("Administer vocabularies and terms", array());
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 12
        $context["taxonomy_permissions_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink(($context["taxonomy_permissions_link_text"] ?? null), "user.admin_permissions.module", ["modules" => "taxonomy"]));
        // line 13
        $context["taxonomy_admin_link_text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 14
            yield "  ";
            yield t("Taxonomy", array());
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 16
        $context["taxonomy_admin_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink(($context["taxonomy_admin_link_text"] ?? null), "entity.taxonomy_vocabulary.collection"));
        // line 17
        $context["taxonomy_overview_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("taxonomy.overview"));
        // line 18
        $context["content_structure_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.content_structure"));
        // line 19
        yield "<h2>";
        yield t("Goal", array());
        yield "</h2>
<p>";
        // line 20
        yield t("Create a taxonomy vocabulary and add a reference field for that vocabulary to a content entity. See @taxonomy_overview_topic for information about taxonomy and @content_structure_topic for more on content entities.", array("@taxonomy_overview_topic" => ($context["taxonomy_overview_topic"] ?? null), "@content_structure_topic" => ($context["content_structure_topic"] ?? null), ));
        yield "</p>
<h2>";
        // line 21
        yield t("Who can configure a taxonomy vocabulary?", array());
        yield "</h2>
<p>";
        // line 22
        yield t("Users with the <em>@taxonomy_permissions_link</em> permission can configure a vocabulary. To add a field in the administrative interface, the core Field UI module must be installed, and you will also need the <em>Administer fields</em> permission for the entity you are adding the field to.", array("@taxonomy_permissions_link" => ($context["taxonomy_permissions_link"] ?? null), ));
        yield "</p>
<h2>";
        // line 23
        yield t("Steps", array());
        yield "</h2>
<ol>
  <li>";
        // line 25
        yield t("In the <em>Manage</em> administrative menu, navigate to <em>Structure</em> &gt; <em>@taxonomy_admin_link</em>.", array("@taxonomy_admin_link" => ($context["taxonomy_admin_link"] ?? null), ));
        yield "</li>
  <li>";
        // line 26
        yield t("Click <em>Add vocabulary</em>.", array());
        yield "</li>
  <li>";
        // line 27
        yield t("In the <em>Name</em> field, enter a name for the vocabulary (for example \"Ingredients\"), which is how it will be shown in the administrative interface. Optionally, add a description.", array());
        yield "</li>
  <li>";
        // line 28
        yield t("Click <em>Save</em>. Your vocabulary will be created and you will see the page that lists all the terms in this vocabulary.", array());
        yield "</li>
  <li>";
        // line 29
        yield t("Optionally, click <em>Add term</em> to add a term to the new vocabulary. In the <em>Name</em> field, enter the term name (for example \"Butter\"). Click <em>Save</em>. You will receive a confirmation about the term you created. You may optionally continue to add more terms.", array());
        yield "</li>
  <li>";
        // line 30
        yield t("If you have the Field UI module installed, follow the instructions on the related <em>Adding a reference field to an entity sub-type</em> topic to add a taxonomy reference field to the entity type of your choice. The settings page will allow you to choose the <em>Vocabulary</em> that you created as the vocabulary to reference.", array());
        yield "</li>
  <li>";
        // line 31
        yield t("You may also want to configure the display and form display of the new field (see related topics).", array());
        yield "</li>
</ol>
<h2>";
        // line 33
        yield t("Additional resources", array());
        yield "</h2>
<ul>
  <li><a href=\"https://www.drupal.org/docs/user_guide/en/structure-taxonomy-setup.html\">";
        // line 35
        yield t("Setting Up a Taxonomy (Drupal User Guide)", array());
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
        return "@help_topics/taxonomy.configuring.html.twig";
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
        return array (  125 => 35,  120 => 33,  115 => 31,  111 => 30,  107 => 29,  103 => 28,  99 => 27,  95 => 26,  91 => 25,  86 => 23,  82 => 22,  78 => 21,  74 => 20,  69 => 19,  67 => 18,  65 => 17,  63 => 16,  58 => 14,  56 => 13,  54 => 12,  49 => 10,  47 => 9,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "@help_topics/taxonomy.configuring.html.twig", "/var/www/html/web/core/modules/taxonomy/help_topics/taxonomy.configuring.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 9, "trans" => 10);
        static $filters = array("escape" => 20);
        static $functions = array("render_var" => 12, "help_route_link" => 12, "help_topic_link" => 17);

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
