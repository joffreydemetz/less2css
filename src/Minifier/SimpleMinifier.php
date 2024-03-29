<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Less2Css\Minifier;

/**
 * CSS minifier
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */
class SimpleMinifier extends Minifier
{
  protected function removeComments(string $css): string
  {
    // $css = preg_replace("/\\ [^\n]+\n/", " ", $css);
    $css = preg_replace("/\s+/", " ", $css);
    $css = preg_replace("/(\s*\/[*]{1,}\s*.+\s*[*]{1,}\/\s*)/mUs", " ", $css);
    // preg_match_all("/\s*\/[*]{1,}\s*(.+)\s*[*]{1,}\/\s*/mUs", $css, $m);
    // echo "<pre>", print_r($m), "</pre>";
    // exit();
    // $css = preg_replace("/(\/\*[\w\'\s\r\n\*]*\*\/)|(\/\/[\w\s\']*)|(\<![\-\-\s\w\>\/]*\>)/", " ", $css);
    // $css = preg_replace("/(\/\*(?:(?!\*\/).|[\n\r])*\*\/)/", " ", $css);
    // if ( !$css && preg_last_error() !== PREG_NO_ERROR ){
      // die( 'lasterror '.preg_last_error().' - '.preg_last_error_msg());
    // }
    // $css = preg_replace("/(\s*\/[*]{1,}\s*[^*]+\s*[*]{1,}\/\s*)/Us", " ", $css);
    // $css = preg_replace("/(\s*\/[*]{1,}\s*.+\s*[*]{1,}\/\s*)/Us", " ", $css);
    // $css = preg_replace('/\s*\/\*([^\/]*)\*\/\s*/mUs', "", $css);
    $css = trim($css);
    return $css;
  }
  
  protected function cleanSpacesAroundChars(string $css): string
  {
    $css = preg_replace("/\s\s+/", " ", $css);
    
    // Remove ; before }
    $css = preg_replace("/;(?=\s*})/", "$1", $css);
    // Remove space after , : ; { } ( ) > ~ +
    $css = preg_replace("/([,:;\{\}\(\)>]) /", "$1", $css);
    // Remove space before , : ; { } ( ) > ~ +
    $css = preg_replace("/ ([,:;\{\}\(\)>])/", "$1", $css);
    
    $css = trim($css);
    
    return $css;
  }
  
  protected function cleanPropertyValues(string $css): string
  {
    // Strips leading 0 on decimal values (converts 0.5px into .5px)
    $css = preg_replace("/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i", '${1}.${2}${3}', $css);
    
    // Strips leading 0 on decimal values in rgba colors (converts 0.5 into .5)
    $css = preg_replace("/rgba\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*,\s*0\.(\d+)\s*\)/i", 'rgba(${1},${2},${3},.${4})', $css);
    
    // Strips units if value is 0 (converts 0px to 0)
    $css = preg_replace("/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i", '${1}0', $css);
    
    // Converts all zeros value into short-hand
    $css = preg_replace("/0 0 0 0/", "0", $css);
    
    // Shortern 6-character hex color codes to 3-character where possible
    $css = preg_replace_callback("/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i", function($m){
      return '#'.$m[1].$m[2].$m[3];
    }, $css);
    
    // Uppercase hex colors
    $css = preg_replace_callback("/#([a-f0-9]{3,6})([\);])/i", function($m){
      return '#'.strtoupper($m[1]).$m[2];
    }, $css);
    
    return $css;
  }
  
  public function compressCss()
  {
    $css = $this->css;
    
    $css = str_replace('€', '--EURO--', $css);
    // die($css);
    $css = $this->removeComments($css);
    // die($css);
    
    $css = $this->cleanSpacesAroundChars($css);
    $css = $this->cleanPropertyValues($css);
    $css = $this->cleanSpacesAroundChars($css);
    
    $css = preg_replace("/:not\(([^\)]+)\)([^\s:])/", ":not($1) $2", $css);
    $css = preg_replace("/:nth-(child|of-type)\(([^\)]+)\)([^\s:])/", ":nth-$1($2) $3", $css);
    $css = preg_replace("/\)\s*and\s*\(/", ") and (", $css);
    $css = str_replace('--EURO--', '€', $css);
    
    // $css = preg_replace("/\s+/", " ", $css);
    
    return $css;
  }
  
  protected function setMinifier()
  {    
    $this->minifier = null;
  }
  
  /** 
   * Clean the CSS (first pass)
   *
   * @param   string  $css   The raw CSS
   * @return  $css    The cleaned string
   */
  protected function cleanFirstPass($str)
  {
    // Normalize whitespace
    $str = preg_replace("/\s+/", " ", $str);
    
    // remove comments
    $str = preg_replace("/(\s*\/[*]{1,}\s*.+\s*[*]{1,}\/\s*)/mUs", " ", $str);
    
    $str = $this->cleanSecondPass($str);
    
    // Strips leading 0 on decimal values (converts 0.5px into .5px)
    $str = preg_replace("/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i", '${1}.${2}${3}', $str);
    
    // Strips leading 0 on decimal values in rgba colors (converts 0.5 into .5)
    $str = preg_replace("/rgba\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*,\s*0\.(\d+)\s*\)/i", 'rgba(${1},${2},${3},.${4})', $str);
    
    // Strips units if value is 0 (converts 0px to 0)
    $str = preg_replace("/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i", '${1}0', $str);
    
    // Converts all zeros value into short-hand
    $str = preg_replace("/0 0 0 0/", "0", $str);
    
    // Shortern 6-character hex color codes to 3-character where possible
    $str = preg_replace_callback("/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i", function($m){
      return '#'.$m[1].$m[2].$m[3];
    }, $str);
    
    // Uppercase hex colors
    $str = preg_replace_callback("/#([a-f0-9]{3,6})([\);])/i", function($m){
      return '#'.strtoupper($m[1]).$m[2];
    }, $str);
    
    return $str;
  }
  
  /** 
   * Clean the CSS (second pass)
   *
   * @param   string  $str   The raw CSS
   * @return  $str    The cleaned string
   */
  protected function cleanSecondPass($str)
  {
    // Normalize whitespace
    $str = preg_replace("/\s\s+/", " ", $str);
    
    // Remove ; before }
    $str = preg_replace("/;(?=\s*})/", "$1", $str);
    // Remove space after , : ; { } ( ) > ~ +
    $str = preg_replace("/([,:;\{\}\(\)>]) /", "$1", $str);
    // Remove space before , : ; { } ( ) > ~ +
    $str = preg_replace("/ ([,:;\{\}\(\)>])/", "$1", $str);
    
    $str = trim($str);
    
    return $str;
  }
}