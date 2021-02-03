<?php
/**
 * Pattern A
 * 
 * Context.
 *  operation 1 => key1.key2 : value
 *  operation 2 => key3 : value
 *  
 *  Choice A => (operation 1) x (operation 2)
 *  Choice B => (operation 1) x (operation 2)
 * 
 * Database.
 *  Choice (A|B):
 *      operation_1
 *          key1:
 *              key2: value
 *      operation_2
 *          key3: value
 * 
 *  @see Example - http://calculateur-cee.ademe.fr/pdf/display/56/BAR-TH-104
 * 
 *    +-----+------+------+--------+                +------+------+
 *    |     | key1 | key2 |  val1  |                | key3 | val3 |
 *    | Chc +-------------+--------+       X        +------+------+
 *    |     | key1 | key2 |  val2  |                | key3 | val3 |
 *    +----------------------------+                +------+------+
 *
*/

namespace App\Patterns;

use App\ArrayCollection;

class PatternA extends PatternAbstract
{
    public function __construct(array $document, array $payload)
    {
        $this->document = $document;
        $this->payload = $payload;
    }

    /**
     * 
     * @return boolean|int
     */
    public function execute()
    {
        try {
            $data = $this->document['data'];

            if (!$this->isValid()) {
                return ["errors" => ["Wrong parameters, expected " . implode("|", $this->mapping)]];
            }
            $value1 = (new ArrayCollection($data))
                            ->get($this->payload[$this->mapping['field1']])
                            ->get("operation_1")
                            ->get($this->payload[$this->mapping['field2']])
                            ->get($this->payload[$this->mapping['field3']])
                            ->execute();

            $value2 = (new ArrayCollection($data))
                            ->get($this->payload[$this->mapping['field1']])
                            ->get("operation_2")
                            ->get($this->payload[$this->mapping['field4']])
                            ->execute();
            
            if (is_numeric($value1) && is_numeric($value2)) {
                return ($value1 * $value2);
            }
        } catch (\Exception $ex) {
            //@TODO: mettre des logs
        }
        return false;
    }
}