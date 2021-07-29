<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Less2Css\Parser;

/**
 * LessC parser
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */
class LesscParser extends Parser 
{
  public function getCss()
  {
    return $this->parser->getCSS();
  }
  
  public function parseFile($path)
  {
    $this->parser->parseFile($path);
    return $this;
  }
  
  public function parseString($str)
  {
    $this->parser->parse($str);
    return $this;
  }
  
  public function addVariables(array $variables)
  {
    $this->parser->ModifyVars($variables);
    return $this;
  }
  
  protected function setParser()
  {
    $this->parser = new \Less_Parser([
      'compress' => $this->compress,
    ]);
    
    return $this;
  }
}