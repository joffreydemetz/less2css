# LESS2CSS
Use to easily convert your less files to a unique optionally minified css file.

Prepared parser use for :
- ILess by [Michal Moravec](https://github.com/mishal/iless)
- less.php by [Josh Schmidt](https://github.com/oyejorge/less.php)

Prepared minifier for :
- a simple personnal minifier
- css-minifier by [WebSharks, Inc.](https://github.com/websharks/css-minifier)

ILess compresses the CSS by itself so no need for another minifier.

## Some upgrades
It needs some enhancements (eg. access parser built in methods and configuration). I built this proxy for my personnal use and needs in the first place.

## Basic Usage 
```
$parserImplementation = 'iLess'; 
// $parserImplementation = 'lessc'; 

$compressorImplementation = 'simple'; 
// $compressorImplementation = 'websharks'; 

use JDZ\Less2Css\Parser\Parser;
use JDZ\Less2Css\Parser\ParserInterface;
use JDZ\Less2Css\Minifier\Minifier;
$parser = \JDZ\Less2Css\Parser\Parser::getInstance($parserImplementation, true);

// parses the file
$parser->parseFile('file1.less');

// parse string
$parser->parseString('body { color: @text-color; }');

// add some variables
$parser->addVariables([
  'text-color' => '#222'
]);

$css = $parser->getCSS();
if ( !$parser->isCssCompressed() ){
  // compress the css result because the parser did not do it
  $minifier = Minifier::getInstance($compressorImplementation, $css);
  $css = $minifier->compressCss();
}

echo $css;
```
