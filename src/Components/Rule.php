<?php

namespace Aeforge\Terminal\Components;

/** Class rule 
 * @author AEForge <https://github.com/aeforge>
 */
class Rule
{
    /** Console command allowed to be executed */
    protected $command;
    /** The function that runs the logic */
    protected $func = null;
    /** Does this rule match a command */
    protected $matches = false;
    /** Parameters that exists when a rule matches */
    protected $array_matches = [];
    /**
     * Add a new Terminal rule
     *
     * @param string $command Console command allowed to be executed
     * @param callable $func The function that runs the logic
     * @throws \InvalidArgumentException
     */
    function __construct($command, $func)
    {
        if (!is_string($command)) throw new \InvalidArgumentException("Expected \$command to be of type string. Type is: " . gettype($command));

        if (!is_callable($func)) throw new \InvalidArgumentException("Expected \$callOnMatch to be of type boolean. Type is: " . gettype($func));

        $this->command = $command;
        $this->func = $func;
    }
    /** Calls the functions associated to this rule
     * @return void
     * @throws \RuntimeException
     */
    function call()
    {
        // Check if there is a match, if not throw a run time exception
        if (!$this->matches) {
            return;
        }
        //Check if there is a function to be called
        if (is_null($this->func)) {
            throw new \RuntimeException("No function to be called was found.");
        }
        $results = $this->array_matches;
        call_user_func_array($this->func, $results);
    }
    /**
     * Check if a command match this stored command inside this rule.
     *
     * @param string $command
     * @param bool $callOnMatch [Default: False] calls the associated function to this rule on rule match
     * @return bool
     * @throws \InvalidArgumentException
     */
    function match($command, $callOnMatch = false)
    {
        if (!is_string($command)) throw new \InvalidArgumentException("Expected \$command to be of type string. Type is: " . gettype($command));

        if (!is_bool($callOnMatch)) throw new \InvalidArgumentException("Expected \$callOnMatch to be of type boolean. Type is: " . gettype($callOnMatch));

        str_replace("\|", "|", preg_quote($this->command));
        $pattern = str_replace("|", "$|^", preg_replace('/' . preg_quote('{') . '.*?' . preg_quote('}') . '/', '(.*)', $this->command));
        $regexMatched = (bool) preg_match_all("/^" . $pattern . "$/mi", $command, $ruleMatch);

        if ($regexMatched) {
            $valueMatch = [];
            $regex = "/{([a-zA-Z0-9_]*)}/";
            preg_match_all($regex, $this->command, $valueMatch);
            $valueMatch = array_slice($valueMatch, 1);
            $valueMatch = $valueMatch[0];
            $ruleMatch = array_slice($ruleMatch, 1);
            $newMatches = [];
            foreach ($ruleMatch as $val) {
                $newMatches[] = $val[0];
            }
            $ruleMatch = $newMatches;
            $newArr = [];

            foreach ($ruleMatch as $keyIndex => $value) {
                $newArr[strtolower($valueMatch[$keyIndex])] = strtolower($value);
            }

            $this->matches = true;
            $this->array_matches = $newArr;
            if ($callOnMatch) $this->call();
            return true;
        }
        $this->matches = false;
        return false;
    }
}
