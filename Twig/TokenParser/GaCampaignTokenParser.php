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
        $expr = $this->parser->getExpressionParser()->parseExpression();

        $data = [
            'utm_source' => new \Twig_Node_Expression_Constant(null,$lineno),
            'utm_medium' => new \Twig_Node_Expression_Constant(null,$lineno),
            'utm_campaign' => new \Twig_Node_Expression_Constant(null,$lineno),
            'utm_content' => new \Twig_Node_Expression_Constant(null,$lineno),
            'utm_term' => new \Twig_Node_Expression_Constant(null,$lineno),
        ];
        $i = 0;
        $key = null;
        foreach ($expr as $e) {
            if (!$i) {
                $key = $e->getAttribute('value');
                $data[$key] = null;
            } else {
                $data[$key] = $e;
            }
            $i = ($i + 1) & 1;
        }


        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse(array($this, 'decideEnd'), true);
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);
        return new GaCampaign($body, $data, $lineno, $this->getTag());
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