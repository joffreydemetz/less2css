<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Less2Css\Parser;

/**
 * ILess parser
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */
class ILessParser extends Parser 
{
  /** 
   * {@inheritDoc}
   */
  public function getCss($str='')
  {
    return $this->parser->getCSS();
  }
  
  /** 
   * {@inheritDoc}
   */
  public function parseFile($path)
  {
    $this->parser->parseFile($path);
  }
  
  /** 
   * {@inheritDoc}
   */
  public function parseString($str)
  {
    $this->parser->parseString($str);
  }
  
  /** 
   * {@inheritDoc}
   */
  public function addVariables(array $variables)
  {
    $this->parser->addVariables($variables);
  }
  
  /** 
   * {@inheritDoc}
   */
  protected function setParser()
  {
    $this->parser = new \ILess\Parser();  
  }
}