<?php
/**
 * Pattern B
 * 
 * Context.
 *  operation 1 => key1 : value
 *  
 *  Choice A => (operation 1)
 * 
 * Database.
 *  Choice (A):
 *      operation_1
 *          key1: value
 * 
 * 
 *  @see Example - http://calculateur-cee.ademe.fr/pdf/display/57/BAR-TH-106
 * 
 *    +------+------+------+
 *    | ChcA | key1 | val1 |
 *    +------+------+------+
 *
*/

namespace App\Patterns;

use App\ArrayCollection;

class PatternB extends PatternAbstract
{
    
    public function __construct(array $document, array $payload)
    {
        $this->document = $document;
        $this->payload = $payload;
        
    }   

    public function execute()
    {
        try {
            $data = $this->document['data'];

            if (!$this->isValid()) {
                return ["errors" => ["Wrong parameters, expected " . implode("|", $this->mapping)]];
            }

            return (new ArrayCollection($data))
                        ->get($this->mapping['field1'])
                        ->get($this->payload[$this->mapping['field1']])
                        ->execute();
        } catch (\Exception $ex) {
            //@TODO: mettre des logs
        }
        return false;
    }
}