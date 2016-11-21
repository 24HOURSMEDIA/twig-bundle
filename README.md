# twig-bundle

symfony twig extensions bundle

## installation

Through composer in your symfony project:

    composer require 24hoursmedia/twig-extension-bundle

Then, register the bundle in your AppKernel by adding the following line:

    new T4\Bundle\TwigExtensionBundle\T4TwigExtensionBundle()

    
## twig extensions    

### google analytics filters

* filter to add google campaign information to links


[read ga_extension docs](Resources/doc/ga-extension.md)

### validator filters

* apply symfony validator on data and return errors as an array for use in twig

[read validator_extension docs](Resources/doc/validator-extension.md)

