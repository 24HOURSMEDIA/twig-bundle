<?php
namespace T4\Bundle\TwigExtensionBundle\Twig\Node;

/**
 * Class GaCampaign
 * Node visitor that modifies google analytics links
 */
class GaCampaign extends \Twig_Node
{

    public function __construct(\Twig_NodeInterface $body, $params, $lineno, $tag = 't4_ga_campaign')
    {


        parent::__construct(array(
            'body' => $body
        ), $params, $lineno, $tag);
    }

    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            //->write("\$d = '" . $json . "';\n")
            ->write("ob_start();\n")

            ->write('$utm_medium=')
            ->subcompile($this->getAttribute('utm_medium'))
            ->write(';')
            ->write('$utm_source=')
            ->subcompile($this->getAttribute('utm_source'))
            ->write(';')
            ->write('$utm_campaign=')
            ->subcompile($this->getAttribute('utm_campaign'))
            ->write(';')
            ->subcompile($this->getNode('body'))

            ->write('echo T4\Bundle\TwigExtensionBundle\Twig\Node\GaCampaign::render(ob_get_clean(), $utm_source, $utm_campaign, $utm_medium);')
        ;
    }

    static function render($body, $utm_source, $utm_campaign, $utm_medium) {
        $doc = new \DOMDocument();
        $doc->loadHTML($body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $m = new \T4\DomManipulations\Manipulator\Ga\GaAddCampaignToLinks();
        $m->modify($doc, $utm_source, $utm_medium, $utm_campaign);
        $newHtml = $doc->saveHTML();
        return $newHtml;
    }

}