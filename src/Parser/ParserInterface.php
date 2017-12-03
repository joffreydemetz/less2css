<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Less2Css\Parser;

/**
 * Less parser interface
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */
interface ParserInterface
{
  /**
   * Does the parser compress the CSS itself
   * 
   * @return  bool  True if the CSS is returned already compressed
   */
  public function isCssCompressed();
  
  /**
   * Return the CSS content 
   * 
   * @return  string  The parsed CSS
   */
  public function getCss();
  
  /**
   * Parse a less file to css
   * 
   * @param   string  $path    The absolute file path
   * @return  void
   */
  public function parseFile($path);
  
  /**
   * Parse a less string to css
   * 
   * @param   string  The less string
   * @return  void
   */
  public function parseString($str);
  
  /**
   * Add less variables to parser
   * 
   * @param   array  Key/Value pairs
   * @return  void
   */
  public function addVariables(array $variables);
}