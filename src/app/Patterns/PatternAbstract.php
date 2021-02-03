<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Patterns;

abstract class PatternAbstract
{
    /**
     * @var array 
     */
    protected $document;
    
    /**
     * @var array 
     */
    protected $payload;
    
    /**
     * @var array 
     */
    protected $mapping;
    
    
    /**
     * execute pattern
     */
    abstract public function execute();
    
    /**
     * - Count total fields mapping equals total fields payload
     * - Test if naming is exactly the same in payload, mapping
     */    
    protected function isValid(): bool
    {
        if (!isset($this->document['metadata'])) {
            throw new \Exception('Metdata missing');
        }
        
        if (!isset($this->document['metadata']['mapping'])) {
            throw new \Exception('Mapping metadata missing');
        }
        
        $this->mapping = $this->document['metadata']['mapping'];

        if (count($this->payload) !== count($this->mapping)) {
            return false;
        }
        
        return count($this->mapping) === count($this->payload + (array_flip($this->mapping)));
    }
}