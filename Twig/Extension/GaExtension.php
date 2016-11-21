<?php
/**
 * Date: 20/11/2016
 */

namespace T4\Bundle\TwigExtensionBundle\Twig\Extension;

use T4\Bundle\TwigExtensionBundle\Traits\DomDocumentSupportingExtensionTrait;
use T4\Bundle\TwigExtensionBundle\Traits\OptionalExceptionThrowingTrait;
use T4\Bundle\TwigExtensionBundle\Twig\TokenParser\GaCampaignTokenParser;

/**
 * Class GaExtension
 * Google analytics extension
 */
class GaExtension extends \Twig_Extension
{


    use DomDocumentSupportingExtensionTrait;
    use OptionalExceptionThrowingTrait;

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


    public function campaignFilter($html, $utm_source = '', $utm_medium = '', $utm_campaign = '', $utm_content = '', $utm_term = '')
    {
        $html = trim($html);
        if (!strlen($html)) {
            return $html;
        }

        try {
            $doc = static::getLoadedDomDocument($html);

            $m = new \T4\DomManipulations\Manipulator\Ga\GaAddCampaignToLinks();
            $m->modify($doc, $utm_source, $utm_medium, $utm_campaign, $utm_content, $utm_term);
            $newHtml = $doc->saveHTML();

            return $newHtml;
        } catch (\Exception $e) {
            // return original html if exception throwing is disabled.
            if ($this->throwExceptions()) {
                throw $e;
            } else {
                // TODO: log...
            }
            return $html;
        }
    }

    public function getName()
    {
        return 't4_ga_extension';
    }




}