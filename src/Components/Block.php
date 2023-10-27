<?php

namespace Aeforge\Terminal\Components;

/** Class block 
 * @author AEForge <https://github.com/aeforge>
 */
class Block
{
   /**
    * Block content
    *
    * @var string
    * @access protected
    */
    protected $text;
    /**
     * Text styles
     *
     * @var array
     * @access protected
     */
    protected $styles = [];
    /**
     * A new instance of Block class
     *
     * @param string $text
     * @param array $styles [Optional]
     * @param bool $print if true Will print directly to the terminal
     * @throws \InvalidArgumentException
     */
    function __construct($text, $styles = [], $print = true)
    {
        if(!is_string($text)) throw new \InvalidArgumentException("Expected \$text to be of type string. Type is : " . gettype($text));

        $this->text = $text;
        $this->styles = $styles;
        if($print) $this->print();
    }
    /**
     * Prints the block to the terminal
     *
     * @return void
     */
    function print()
    {
        $len = strlen($this->text);

        $emptyBlock = "\e[" . implode(';', $this->styles) . "m" . str_repeat(" ", $len + 4) . "\e[0m" . "\r\n" ;

        $textBlock =  "\e[" . implode(';', $this->styles) . "m" . str_repeat(" ", 2) . $this->text . str_repeat(" ", 2) . "\e[0m" . "\r\n" ;
         
        echo $emptyBlock;
        echo $textBlock;
        echo $emptyBlock;
    }
}
