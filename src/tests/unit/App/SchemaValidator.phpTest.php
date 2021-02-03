<?php 

namespace App;

class SchemaValidatorTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $document = <<<'JSON'
    {
        "name": "BAR_TH_XXX",
        "schema": "1.0",
        "version": "2020-10",
        "active": "2020-10-01",
        "metadata": {
            "dfa": {
                "type_logement": {
                    "maison": "\\App\\Patterns\\PatternA",
                    "appartement": "\\App\\Patterns\\PatternD"
                }
            },
            "mapping": {
                "field1": "type_logement",
                "field2": "zone_climatique",
                "field4": "surface_chauffee"
            }
        },
        "taxonomies": "REGULATION,PROGRAM_INTERMITTENCE",
        "attributes": {
            "zone_climatique": {
                "hint": "string",
                "values": ["H1", "H2", "H3"]
            },
            "energie_chauffage": {
                "hint": "string",
                "values": ["electricite", "combustible"]
            }
        },
        "data": {
            "zone_climatique": {
                "H1": {
                    "electricite": 2400,
                    "combustible": 3800
                },
                "H2": {
                    "electricite": 2000,
                    "combustible": 3100
                }
            }
        }
    }
    JSON;

    public function testSampleValidation()
    {
        // DTD
        $jsonSchemaObject = json_decode(file_get_contents(dirname(__DIR__) . '../../../dtd/cee.dtd'));
        // Payload
        $payload = json_decode($this->document);

        // Validator
        $errors = (new SchemaValidator($jsonSchemaObject))
                    ->validate($payload)
                    ->getErrors();

        $this->assertCount(0, $errors);
    }

    public function testWrongVersion()
    {
        // DTD
        $jsonSchemaObject = json_decode(file_get_contents(dirname(__DIR__) . '../../../dtd/cee.dtd'));
        // Payload
        $payload = json_decode($this->document);
        $payload->version = '2020-104';

        // Validator
        $errors = (new SchemaValidator($jsonSchemaObject))
                    ->validate($payload)
                    ->getErrors();

        $this->assertCount(1, $errors);
    }

    public function testMissingRequiredFields()
    {
        // DTD
        $jsonSchemaObject = json_decode(file_get_contents(dirname(__DIR__) . '../../../dtd/cee.dtd'));
        // Payload
        $payload = json_decode($this->document);
        unset($payload->taxonomies);

        // Validator
        $errors = (new SchemaValidator($jsonSchemaObject))
                    ->validate($payload)
                    ->getErrors();

        $this->assertCount(1, $errors);
    }

    public function testPropertyPatternNotRespected()
    {
        // DTD
        $jsonSchemaObject = json_decode(file_get_contents(dirname(__DIR__) . '../../../dtd/cee.dtd'));
        // Payload
        $payload = json_decode($this->document);
        unset($payload->metadata->dfa->type_logement);
        $payload->metadata->dfa = ['typeLogement' => 'fake value'];

        // Validator
        $errors = (new SchemaValidator($jsonSchemaObject))
                    ->validate($payload)
                    ->getErrors();

        $this->assertCount(3, $errors);
    }

    public function testAddedGreatherThanOnePropertyInDfaAttribute()
    {
        // DTD
        $jsonSchemaObject = json_decode(file_get_contents(dirname(__DIR__) . '../../../dtd/cee.dtd'));
        // Payload
        $payload = json_decode($this->document);
        $payload->metadata->dfa = ['type_logement' => 'fake value', 'surface_habitable' => 'fake value'];

        // Validator
        $errors = (new SchemaValidator($jsonSchemaObject))
                    ->validate($payload)
                    ->getErrors();

        $this->assertCount(3, $errors);
    }

    public function testDfaAttributeExistsButIsEmpty()
    {
        // DTD
        $jsonSchemaObject = json_decode(file_get_contents(dirname(__DIR__) . '../../../dtd/cee.dtd'));
        // Payload
        $payload = json_decode($this->document);
        unset($payload->metadata->dfa->type_logement);

        // Validator
        $errors = (new SchemaValidator($jsonSchemaObject))
                    ->validate($payload)
                    ->getErrors();

        $this->assertCount(2, $errors);
    }
}