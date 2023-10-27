<?php

namespace Aeforge\Terminal;

use Aeforge\Terminal\Config;
use Aeforge\Terminal\Components\Text;
use Aeforge\Terminal\Components\Block;

/** class Message
 * Send an already defined styles messages to the terminal
 * @author AEForge <https://github.com/aeforge>
 */
class Message
{
    /**
     * Send a message of type warning
     *
     * @param string $text
     * @return void
     * @access public
     * @throws \InvalidArgumentException
     */
    public static function warning($text)
    {
        if(!is_string($text)) throw new \InvalidArgumentException("Expected \$text to be of type string. Type is : " . gettype($text));
        $config = new Config;
        $styles = [$config->get("clr_white"), $config->get("txt_bold"), $config->get("bg_yellow")];

        (new Block($text,$styles));
    }
        /**
     * Send a message of type error
     *
     * @param string $text
     * @return void
     * @access public
     * @throws \InvalidArgumentException
     */
    public static function error($text)
    {
        if(!is_string($text)) throw new \InvalidArgumentException("Expected \$text to be of type string. Type is : " . gettype($text));
        $config = new Config;
        $styles = [$config->get("clr_white"), $config->get("txt_bold"), $config->get("bg_red")];
        
        (new Block($text,$styles));
    }
        /**
     * Send a message of type normal
     *
     * @param string $text
     * @return void
     * @access public
     * @throws \InvalidArgumentException
     */
    public static function message($text)
    {
        if(!is_string($text)) throw new \InvalidArgumentException("Expected \$text to be of type string. Type is : " . gettype($text));
        $config = new Config;
        $styles = [$config->get("clr_white")];
        
        (new Text($text,$styles,true))->print();
    }
        /**
     * Send a message of type information
     *
     * @param string $text
     * @return void
     * @access public
     * @throws \InvalidArgumentException
     */
    public static function info($text)
    {
        if(!is_string($text)) throw new \InvalidArgumentException("Expected \$text to be of type string. Type is : " . gettype($text));
        $config = new Config;
        $styles = [$config->get("clr_white"), $config->get("txt_bold"), $config->get("bg_blue")];

        (new Block($text,$styles));
    }
        /**
     * Send a message of type success
     *
     * @param string $text
     * @return void
     * @access public
     * @throws \InvalidArgumentException
     */
    public static function success($text)
    {
        if(!is_string($text)) throw new \InvalidArgumentException("Expected \$text to be of type string. Type is : " . gettype($text));
        $config = new Config;
        $styles = [$config->get("clr_white"), $config->get("txt_bold"), $config->get("bg_green")];
        
        (new Block($text,$styles));
    }
}
