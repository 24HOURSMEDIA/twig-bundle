<?php
namespace T4\Bundle\TwigExtensionBundle\Traits;

/**
 * Date: 21/11/2016
 */
trait DomDocumentSupportingExtensionTrait
{

    /**
     * @param $html
     * @throws \Exception
     * @return \DOMDocument
     */
    static function getLoadedDomDocument($html) {
        $doc = new \DOMDocument();

        $doc->strictErrorChecking = false;
        $oldErrors = false;
        if (function_exists('libxml_use_internal_errors')) {
            $oldErrors = libxml_use_internal_errors(true);
        }

        $doc->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        if (function_exists('libxml_use_internal_errors')) {
            libxml_use_internal_errors($oldErrors);
        }

        return $doc;
    }



}