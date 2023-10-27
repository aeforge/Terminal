<?php

namespace Aeforge\Terminal;

use Aeforge\Terminal\Item;

/** class Terminal
 * @author AEForge <https://github.com/aeforge>
 */
class Terminal
{
    /**
     * Check if the Application/Instance is being accessed via a Terminal/Console
     * @access public
     * @return bool True if its a console/terminal
     */
    public static function isConsole()
    {
        return (bool)(php_sapi_name() == 'cli');
    }
    /**
     * Same as isConsole
     * @access public
     * @return bool True if its a console/terminal
     */
    public static function isTerminal()
    {
        return self::isConsole();
    }
    /**
     * Add a new command to the terminal list
     * @access public
     * @param string $command
     * @param callable $func
     * @return void
     */
    public static function Item($command, $func)
    {
        Item::new($command, $func);
    }
    /**
     * Start parsing the Terminal item list
     */
    public static function boot()
    {
        $args = $_SERVER['argv'] ?? [];

        /** Check of its empty */
        if (empty($args)) return;

        // Remove App name from the array
        array_shift($args);
        // Start translating
        
        Item::find(implode(" ", $args), True);
    }
}
