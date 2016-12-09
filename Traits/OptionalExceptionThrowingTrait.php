<?php
/**
 * Date: 21/11/2016
 */

namespace T4\Bundle\TwigExtensionBundle\Traits;


trait OptionalExceptionThrowingTrait
{

    protected $throwExceptions = true;

    function setThrowExceptions($doThrow) {
        $this->throwExceptions = $doThrow;
    }

    function throwExceptions() {
        return $this->throwExceptions;
    }

}