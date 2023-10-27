<?php

namespace Aeforge\Terminal\Components;

/** Class text 
 * @author AEForge <https://github.com/aeforge>
 */
class Text
{
    /** Text styles in the terminal
     * @var array
     * @access protected
     */
    protected $styles;
    /** Text content
     * @var string
     * @access protected
     */
    protected $text;
    /**
     * Adds a new line at the end of the text
     *
     * @var boolean
     * @access protected
     */
    protected $newLine = true;
    /**
     * A new instance of Text class
     *
     * @param string|null [Optional] $text
     * @param array [Optional] $styles
     * @param bool [Default : true] Adds a new line at the of the text
     * @throws \InvalidArgumentException
     */
    public function __construct($text, $styles = [], $appendNewLine = true)
    {

        if (!is_null($text)) {
            if (!empty($text) && !is_string($text)) {
                throw new \InvalidArgumentException("Expected \$text to be of type string. Type is: " . gettype($text));
            } else {
                $this->text = $text;
            }
        }

        if (!empty($styles) && !is_array($styles)) {
            throw new \InvalidArgumentException("Expected \$styles to be of type array. Type is: " . gettype($styles));
        } else {
            $this->styles = $styles;
        }


        if (!is_bool($appendNewLine)) {
            throw new \InvalidArgumentException("Expected \$appendNewLine to be of type bool. Type is: " . gettype($appendNewLine));
        } else {
            $this->newLine = $appendNewLine;
        }

    }
    /** Converts the text to a valid Terminal line */
    public function __toString()
    {
        return "\e[" . implode(';', $this->styles) . "m" . $this->text . "\e[0m" . ( $this->newLine ? "\r\n" : "");
    }
    /**
     * Prints the text to the terminal
     * @access public
     * @return void
     */
    public function print()
    {
        echo $this->__toString();
    }
}
