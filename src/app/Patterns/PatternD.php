<?php
/**
 * Pattern C
 * 
 * Context.
 *  operation 1 => key1.key2 : value
 *  operation 2 => number
 *  
 *  (operation 1) x (operation 2)
 *  Choice B => (operation 1) x (operation 2)
 * 
 * Database.
 *      operation_1
 *          key1:
 *              key2: value
 * 
 *  @see Example - http://calculateur-cee.ademe.fr/pdf/display/246/BAR-EN-101
 * 
 *    +------+------+------+                +--------+
 *    | key1 | key2 | val1 |       X        | number |
 *    +------+------+------+                +--------+
 *
*/


namespace App\Patterns;

use App\ArrayCollection;

class PatternD
{
    private $document;
    private $payload;
    
    public function __construct(array $document, array $payload)
    {
        $this->document = $document;
        $this->payload = $payload;
    }

    public function execute()
    {
        $data = $this->document['data'];

        if (! $this->isValid())
        {
            return ["errors" => ["Wrong parameters, expected " . implode("|", $this->mapping)]];
        }

        // mapping
        $mapping = $this->document['metadata']['mapping'];

        $value1 = (new ArrayCollection($data))
                        ->get($mapping['field1'])
                        ->get($this->payload[$mapping['field1']])
                        ->get($this->payload[$mapping['field2']])
                        ->execute()
                    ;

        return $value1 * (int) $this->payload[$mapping['field3']];
    }
}