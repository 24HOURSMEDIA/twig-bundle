<?php
/**
 * Date: 09/12/2016
 */

namespace T4\Bundle\TwigExtensionBundle\Twig\Extension;
use Ouzo\Utilities\Strings;

class TextExtension extends \TwigExtension
{

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('t4t_camelize', [$this, 'camelize'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('t4t_underscore', [$this, 'underscore'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('t4t_abbreviate', [$this, 'abbreviate'], ['is_safe' => ['html']])
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
    public function getName()
    {
        return 't4_text_extension';
    }

}