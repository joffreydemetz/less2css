<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Less2Css\Minifier;

/**
 * CSS minifier interface
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */
interface MinifierInterface
{
  /**
   * Minify css content
   * 
   * @return  string  The minified CSS content
   */
  public function compressCss();
}