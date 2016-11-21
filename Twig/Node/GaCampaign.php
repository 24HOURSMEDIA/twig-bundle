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
            ->write('$utm_content=')
            ->subcompile($this->getAttribute('utm_content'))
            ->write(';')
            ->write('$utm_term=')
            ->subcompile($this->getAttribute('utm_term'))
            ->write(';')
            ->write('$ga_active=')
            ->subcompile($this->getAttribute('active'))
            ->write(';')
            ->subcompile($this->getNode('body'))

            ->write('echo T4\Bundle\TwigExtensionBundle\Twig\Node\GaCampaign::render(ob_get_clean(), $ga_active, $utm_source, $utm_campaign, $utm_medium, $utm_content, $utm_term);')
        ;
    }

    static function render($body, $active, $utm_source, $utm_campaign, $utm_medium, $utm_content, $utm_term) {
        if (!$active) {
            return $body;
        }
        if (!strlen($body)) {
            return $body;
        }

        try {
            $doc = new \DOMDocument();
            $doc->strictErrorChecking = false;
            $oldErrors = false;
            if (function_exists('libxml_use_internal_errors')) {
                $oldErrors = libxml_use_internal_errors(true);
            }
            $doc->loadHTML($body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            if (function_exists('libxml_use_internal_errors')) {
                libxml_use_internal_errors($oldErrors);
            }

            $m = new \T4\DomManipulations\Manipulator\Ga\GaAddCampaignToLinks();
            $m->modify($doc, $utm_source, $utm_medium, $utm_campaign, $utm_content, $utm_term);
            $newHtml = $doc->saveHTML();

        } catch (\Exception $e) {
            //throw $e;
            return $body;
        }
        return $newHtml;
    }

}