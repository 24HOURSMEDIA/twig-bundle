<?php
/**
 * Date: 20/11/2016
 */

namespace T4\Bundle\TwigExtensionBundle\Twig\Extension;

use T4\Bundle\TwigExtensionBundle\Twig\TokenParser\GaCampaignTokenParser;

/**
 * Class GaExtension
 * Google analytics extension
 */
class GaExtension extends \Twig_Extension
{



    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('t4_ga_campaign', [$this, 'campaignFilter'], ['is_safe' => ['html']])
        ];
    }

    public function getTokenParsers()
    {
        return [
            new GaCampaignTokenParser()
        ];
    }


    public function campaignFilter($html, $utm_source, $utm_medium, $utm_campaign)
    {
        $doc = new \DOMDocument();
        $doc->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $m = new \T4\DomManipulations\Manipulator\Ga\GaAddCampaignToLinks();
        $m->modify($doc, $utm_source, $utm_medium, $utm_campaign);
        $newHtml = $doc->saveHTML();
        return $newHtml;
    }

    public function getName()
    {
        return 't4_ga_extension';
    }




}