<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Less2Css\Parser;

// use JDZ\Less2Css\Autoprefixer\ILessAutoprefixerPlugin;
use ILess\Exception\CompilerException;
use ILess\Exception\ParserException;

/**
 * ILess parser
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */
class ILessParser extends Parser 
{
  /* public function setAutoprefixer(string $binPath, array $browserList=[ 'defaults' ])
  {
    $this->parser->getPluginManager()->addPlugin(new ILessAutoprefixerPlugin([
        // see https://github.com/ai/browserslist
        'postcss_bin' => $binPath,
        // 'postcss_bin' => 'postcss',
        'browsers' => $browserList
    ]));
    
    return $this;
  } */
  
  public function getCss($str='')
  {
    try {
      $css = $this->parser->getCSS();
    }
    catch(CompilerException $e){
      throw new \RuntimeException(
        'Compiler error in '.$e->getCurrentFile()->filename."\n".' on index '.$e->getIndex()."\n".' -- '.$e->getMessage(), $e->getCode(), $e
      );
    }
    
    return $css;
  }
  
  public function parseFile($path)
  {
    try {
      $this->parser->parseFile($path);
    }
    catch(ParserException $e){
      throw new \RuntimeException(
        'Parser error in '.$e->getCurrentFile()->filename."\n".' on index '.$e->getIndex()."\n".' -- '.$e->getMessage()
      );
    }
    
    return $this;
  }
  
  public function parseString($str)
  {
    $this->parser->parseString($str);
    
    return $this;
  }
  
  public function addVariables(array $variables)
  {
    $this->parser->addVariables($variables);
  }
  
  protected function setParser()
  {
    $this->parser = new \ILess\Parser();  
  }
}