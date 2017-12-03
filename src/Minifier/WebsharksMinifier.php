<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Less2Css\Minifier;

/**
 * Less minifier
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */
class WebsharksMinifier extends Minifier
{
  /** 
   * {@inheritDoc}
   */
  public function compressCss()
  {
    return $this->minifier->min();
  }
  
  /** 
   * {@inheritDoc}
   */
  protected function setMinifier()
  {
    $this->minifier = new \WebSharks\CssMinifier\Core($this->css);
  }
}