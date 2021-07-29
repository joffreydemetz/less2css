<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Less2Css\Autoprefixer;

/**
 * CSS Autoprefixer
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */
use JDZ\Less2Css\Autoprefixer\AutoprefixProcessor;
use ILess\Parser;
use ILess\Plugin\Plugin;

/**
 * ILess Autoprefix plugin
 */
class ILessAutoprefixerPlugin extends Plugin
{
  protected $defaultOptions = [
    'browsers' => ['last 2 versions'],
    'remove' => true,
    'add' => true
  ];

  public function install(Parser $parser)
  {
    $parser->getPluginManager()->addPostProcessor(new AutoprefixProcessor($this->getOptions()));
  }
}
