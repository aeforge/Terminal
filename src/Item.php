<?php

namespace Aeforge\Terminal;
use Aeforge\Terminal\Components\Rule;
/** class Item
 * @author AEForge <https://github.com/aeforge>
 */
class Item {
    protected static  $whiteList = [];
    /**
     * Add a new command to the terminal list
     * @access public
     * @param string $command
     * @param callable $func
     * @return void
     * @throws \InvalidArgumentException
     */
     public static function new($command, $func)
    {
        if(!is_string($command)) throw new \InvalidArgumentException("Expected \$command to be of type string. Type is: " . gettype($command));

        if(!is_callable($func)) throw new \InvalidArgumentException("Expected \$callOnMatch to be of type boolean. Type is: " . gettype($func));
        static::$whiteList [] = new Rule($command, $func);
    }
    /**
     * Search for the command in the TerminalList collection.
     *  will also run the function attached to the command if matches
     * @access public
     * @param string $command
     * @param bool $runIfFound will run the function attached to the rule
     * @return bool True if found, False if not
     */
     public static function find($command, $runIfFound)
    {
        if(!is_string($command)) throw new \InvalidArgumentException("Expected \$command to be of type string. Type is: " . gettype($command));

        if(!is_bool($runIfFound)) throw new \InvalidArgumentException("Expected \$runIfFound to be of type boolean. Type is: " . gettype($runIfFound));
        foreach(static::$whiteList AS $list)
        {
            $match = $list->match($command);
            if(!$match) continue;
            if($runIfFound && $match) $list->call();
            return true;
        }
        return false;
    }
}