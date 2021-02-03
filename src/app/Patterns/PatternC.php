<?php
/**
 * Pattern C
 * 
 * Context.
 *  operation 1 => key1 : value
 *  operation 2 => number
 *  
 *  (operation 1) x (operation 2)
 *  Choice B => (operation 1) x (operation 2)
 * 
 * Database.
 *      operation_1
 *          key1: value
 * 
 *  @see Example - http://calculateur-cee.ademe.fr/pdf/display/246/BAR-EN-101
 * 
 *    +------+------+                +--------+
 *    | key1 |val1  |       X        | number |
 *    +------+------+                +--------+
 *
*/


namespace App\Patterns;

use App\ArrayCollection;

class PatternC extends PatternAbstract
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

            if (! $this->isValid()) {
                return ["errors" => ["Wrong parameters, expected " . implode("|", $this->mapping)]];
            }

            // mapping
            $mapping = $this->document['metadata']['mapping'];

            $value1 = (new ArrayCollection($data))
                            ->get($this->mapping['field1'])
                            ->get($this->payload[$this->mapping['field1']])
                            ->execute();

            return $value1 * (int) $this->payload[$this->mapping['field2']];
        } catch (\Exception $ex) {

        }
        return false;
    }
}