<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Less2Css\Parser;

use ILess\Exception\CompilerException;
use ILess\Exception\ParserException;
use RuntimeException;

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
    try {
      $css = $this->parser->getCSS();
    }
    catch(CompilerException $e){
      throw new RuntimeException(
        'Compiler error in '.$e->getCurrentFile()->filename."\n".' on index '.$e->getIndex()."\n".' -- '.$e->getMessage()
      );
    }
    
    return $css;
  }
  
  /** 
   * {@inheritDoc}
   */
  public function parseFile($path)
  {
    try {
      $this->parser->parseFile($path);
    }
    catch(ParserException $e){
      throw new RuntimeException(
        'Parser error in '.$e->getCurrentFile()->filename."\n".' on index '.$e->getIndex()."\n".' -- '.$e->getMessage()
      );
    }
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