<?php

/**
 * Deterministic finite automaton 
 * @see https://fr.wikipedia.org/wiki/Automate_fini_d%C3%A9terministe
 * 
 */

namespace App;

class Resolver
{
    private $document;
    private $payload;
    
    public function __construct(array $document, array $payload)
    {
        $this->document = $document;
        $this->payload = $payload;
    }

    private function isValid(string $dfa)
    {
        // Must include only one field (deterministic automate)
        // The payload must contains the dfa's field
        // return [errors => ...]
        return isset($this->payload[$dfa]);
    }

    public function resolve()
    {
        try 
        {
            $dfa = key($this->document['metadata']['dfa']);

            if (! $this->isValid($dfa))
            {
                return ["errors" => ["The payload must contains the dfa's field => $dfa"]];
            }

            $patterns = array_pop($this->document['metadata']['dfa']);
    
            return (new $patterns[$this->payload[$dfa]]($this->document, $this->payload))->execute();
        } 
        catch (\Exception $ex) 
        {
            return [];
        }
   }
}