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
        ), array(

            'utm_source' => $params['utm_source'],
            'utm_campaign' => $params['utm_campaign'],
            'utm_medium' => $params['utm_medium']

        ), $lineno, $tag);
    }

    public function compile(\Twig_Compiler $compiler)
    {
        $parms = [
            'utm_source' => $this->getAttribute('utm_source'),
            'utm_campaign' => $this->getAttribute('utm_campaign'),
            'utm_medium' => $this->getAttribute('utm_medium')
        ];
        $json = json_encode($parms);


        $compiler
            ->addDebugInfo($this)
            ->write("\$d = '" . $json . "';\n")
            ->write("ob_start();\n")
            ->subcompile($this->getNode('body'))
            ->write("echo T4\\Bundle\\TwigExtensionBundle\\Twig\\Node\\GaCampaign::test(ob_get_clean(), \$d);")
        ;
    }

    static function test($body, $json) {
        $parms = json_decode($json, true);
        $doc = new \DOMDocument();
        $doc->loadHTML($body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $m = new \T4\DomManipulations\Manipulator\Ga\GaAddCampaignToLinks();
        $m->modify($doc, $parms['utm_source'], $parms['utm_medium'], $parms['utm_campaign']);
        $newHtml = $doc->saveHTML();
        return $newHtml;
    }

}