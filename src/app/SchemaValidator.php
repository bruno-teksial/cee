<?php

/**
 * @see https://github.com/justinrainbow/json-schema
 * @see https://json-schema.org/understanding-json-schema/
 */
namespace App;

use JsonSchema\SchemaStorage;
use JsonSchema\Validator;
use JsonSchema\Constraints\Factory;


class SchemaValidator
{
    /** Validator jsonValidator */
    private $jsonValidator = null;

    /** Object jsonSchemaObject */
    private $jsonSchemaObject = null;

    /**
     * 
     * @param \App\Object $jsonSchema
     * @return void
     */
    public function __construct(Object $jsonSchema)
    {
        // Schema must be decoded before it can be used for validation
        $this->jsonSchemaObject = $jsonSchema;

        // The SchemaStorage can resolve references, loading additional schemas from file as needed, etc.
        $schemaStorage = new SchemaStorage();

        // This does two things:
        // 1) Mutates $jsonSchemaObject to normalize the references (to file://mySchema#/definitions/integerData, etc)
        // 2) Tells $schemaStorage that references to file://mySchema... should be resolved by looking in $jsonSchemaObject
        $schemaStorage->addSchema('file://mySchema', $this->jsonSchemaObject);

        // Provide $schemaStorage to the Validator so that references can be resolved during validation
        $this->jsonValidator = new Validator( new Factory($schemaStorage));
    }

    /**
     * 
     * @param \App\Object $jsonToValidateObject
     * @return \self
     */
    public function validate(Object $jsonToValidateObject) : SchemaValidator
    {
        // Do validation (use isValid() and getErrors() to check the result)
        $this->jsonValidator->validate($jsonToValidateObject, $this->jsonSchemaObject);

        return $this;
    }

    /**
     * 
     * @param type $errorContext
     * @return array|null
     */
    public function getErrors($errorContext = Validator::ERROR_ALL) : ?array
    {
        // Do validation (use isValid() and getErrors() to check the result)
        return $this->jsonValidator->getErrors($errorContext);
    }
}