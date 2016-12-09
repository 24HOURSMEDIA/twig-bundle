<?php
/**
 * Date: 09/12/2016
 */

namespace T4\Bundle\TwigExtensionBundle\Twig\Extension;
use Coduo\PHPHumanizer\String\Humanize;
use Ouzo\Utilities\Strings;

class TextExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('t4t_camelize', [$this, 'camelize'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('t4t_underscore', [$this, 'underscore'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('t4t_abbreviate', [$this, 'abbreviate'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('t4t_humanize', [$this, 'humanize'], ['is_safe' => ['html']])
        ];
    }

    public function camelize($v) {
        return Strings::underscoreToCamelCase($v);
    }

    public function underscore($v) {
        return Strings::camelCaseToUnderscore($v);
    }
    public function abbreviate($v, $n = 8) {
        return Strings::abbreviate($v, $n);
    }

    public function humanize($t, $capitalize = true) {
        return (string)new Humanize($t, $capitalize);
    }
    public function getName()
    {
        return 't4_text_extension';
    }

}