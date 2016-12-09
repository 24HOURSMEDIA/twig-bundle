<?php
/**
 * Date: 25/10/2016
 */

namespace T4\Bundle\TwigExtensionBundle\Twig\Extension;


use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use T4\Bundle\TwigExtensionBundle\Traits\OptionalExceptionThrowingTrait;

class ValidatorExtension extends \Twig_Extension
{

    use OptionalExceptionThrowingTrait;

    protected $validator;

    function __construct(ValidatorInterface $validator) {
        $this->validator = $validator;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('t4_validate', array($this, 'validateFilter')),
        );
    }


    public function validateFilter($object, $groups = [])
    {
        $errors = $this->validator->validate($object, null, $groups);
        $errs = [];
        foreach ($errors as $err) {

            $errs[] = (string)$err->getMessage();
        }
        return $errs;
    }

    public function getName()
    {
        return 't4_validator_extension';
    }

}