<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Less2Css\Parser;

use JDZ\Filesystem\File;
use JDZ\Filesystem\Path;

/**
 * Less parser
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 * @todo add some other proxy methods (eg. add function,..)
 */
abstract class Parser implements ParserInterface
{
  /**
   * Parser compression
   *
   * Set to true if the parser compresses the CSS itself.
   * 
   * @var  bool
   */
  protected $compress = false;
  
  /**
   * External Less Parser
   *
   * @var  mixed
   */
  protected $parser;
  
  /**
   * Less Parser instance
   *
   * @var  Parser
   */
  protected static $instance; 
  
  /** 
   * Get a seeker instance
   * 
   * @param   string  $name     The parser implementation name
   * @param   bool    $reset    Build a new instance
   * @return   ParserInterface   The parser instance
   */
  public static function getInstance($name, $reset=false)
  {
    if ( !isset(self::$instance) || $reset === true ){
      $Class = __NAMESPACE__ . '\\'.ucfirst($name).'Parser';
      self::$instance = new $Class();
    }
    
    return self::$instance;
  }
  
  /** 
   * Constructor
   */
  public function __construct()
  {
    $this->setParser();
  }
  
  /** 
   * {@inheritDoc}
   */
  public function isCssCompressed()
  {
    return $this->compress === true;
  }
  
  /** 
   * Set the parser
   * 
   * @return  void
   */
  abstract protected function setParser();
}