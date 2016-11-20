<?php
namespace T4\Bundle\TwigExtensionBundle\Twig\TokenParser;

use T4\Bundle\TwigExtensionBundle\Twig\Node\GaCampaign;

/**
 * Date: 20/11/2016
 */
class GaCampaignTokenParser extends \Twig_TokenParser
{
    public function parse(\Twig_Token $token)
    {

        $lineno = $token->getLine();

        $parms = [
            'utm_source' => '',
            'utm_campaign' => '',
            'utm_medium' => ''
        ];


        $expr = $this->parser->getExpressionParser()->parseExpression();
        $data = [];
        foreach ($expr as $e) {
            /* @var $e \Twig_Node_Expression_Constant */
            $data[] = $e->getAttribute('value');
        }

        for ($i = 0; $i < count($data); $i+=2) {
            switch ($data[$i]) {
                case 'utm_source':
                case 'utm_campaign':
                case 'utm_medium':
                    $parms[$data[$i]] =  $data[$i+1];
                    break;
                default:
                    throw new \Exception('Unsupported ' . $data[$i]);
            }
        }


        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        $body = $this->parser->subparse(array($this, 'decideEnd'), true);

        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        return new GaCampaign($body, $parms, $lineno, $this->getTag());
    }

    public function decideEnd(\Twig_Token $token)
    {
        return $token->test('endgacampaign');
    }

    public function getTag()
    {
        return 'gacampaign';
    }
}