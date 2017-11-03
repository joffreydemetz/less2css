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
abstract class Minifier implements MinifierInterface
{
  /**
   * External css minifier
   *
   * @var  mixed
   */
  protected $minifier;
  
  /**
   * The raw CSS content
   *
   * @var  string
   */
  protected $css;
  
  /**
   * Css Minifier instance
   *
   * @var  Minifier
   */
  protected static $instance; 
  
  /** 
   * Get a seeker instance
   * 
   * @param   string  $name   The minifier implementation name
   * @param   string  $css    The raw CSS content
   * @param   bool    $reset  Force a new instance
   * @return 	MinifierInterface  The minifier instance
   */
  public static function getInstance($name, $css, $reset=true)
  {
    if ( !isset(self::$instance) || $reset === true ){
      $Class = __NAMESPACE__ . '\\'.ucfirst($name).'Minifier';
      self::$instance = new $Class($css);
    }
    
    return self::$instance;
  }
  
  /** 
   * Constructor
   * @param   string  $css    The raw CSS content
   */
  public function __construct($css)
  {
    $this->css = $css;
    $this->setMinifier();
  }
  
  /** 
   * {@inheritDoc}
   */
  // abstract public function compressCss();
  
  /** 
   * Set the parser
   */
  abstract protected function setMinifier();
}