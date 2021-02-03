<?php 

namespace App\Tests\Patterns;

use App\Patterns\PatternA;

class PatternATest extends \Codeception\Test\Unit
{
    // /**
    //  * @var \UnitTester
    //  */
    // protected $pattern;
    
    // /**
    //  * 
    //  */
    // protected function _before()
    // {
        
    // }

    // /**
    //  * 
    //  */
    // protected function _after()
    // {
        
    // }

    // /**
    //  * 
    //  */
    // public function testWithEmptyDocument()
    // {
    //     $responseExpected = false;
    //     $payload = [];
        
    //     $document = [];
    //     $pattern = new PatternA($document, $payload);
    //     $response = $pattern->execute();
    //     $this->assertEquals($responseExpected, $response);
        
    //     $document['metadata'] = [];
    //     $pattern = new PatternA($document, $payload);
    //     $response = $pattern->execute();
    //     $this->assertEquals($responseExpected, $response);
    // }
    
    // /**
    //  * 
    //  */
    // public function testWithPayloadDataDoesNotMatchRegexp()
    // {
    //     $responseExpected = false;
        
    //     $document = [
    //         'metadata' => [
    //             'mapping' => [
    //                 'field1' => 'type_logement',
    //                 'field3' => 'zone_climatique',
    //                 'field2' => 'efficacite_energetique',
    //                 'field4' => 'surface_chauffee',
    //             ],
    //         ],
    //         'maison' => [
    //             'operation_2' => [
    //                 '^(13[1-9]|1[4-9][0-9]|[2-9][0-9]{2}|1000)$' => 1.6,
    //             ],
    //             'operation_1' => [
    //                 '^(11[0-9])$' => [
    //                     'H2' => 54400,
    //                 ]
    //             ],
    //         ],
    //     ];


    //     $payload = [
    //         "type_logement" => "maison",
    //         "efficacite_energetique" => "112",
    //         "zone_climatique" => "H2",
    //         "surface_chauffee" => "80"
    //     ];
    //     $pattern = new PatternA($document, $payload);
        
    //     $response = $pattern->execute();
    //     $this->assertEquals($responseExpected, $response);
    // }
    
    // /**
    //  * 
    //  */
    // public function testWithGoodDocumentData()
    // {
    //     $responseExpected = 38080;
        
    //     $document = [
    //         'metadata' => [
    //             'mapping' => [
    //                 'field1' => 'type_logement',
    //                 'field3' => 'zone_climatique',
    //                 'field2' => 'efficacite_energetique',
    //                 'field4' => 'surface_chauffee',
    //             ],
    //         ],
    //         'maison' => [
    //             'operation_2' => [
    //                 '^(7[0-9]|8[0-9])$' => 0.7,
    //             ],
    //             'operation_1' => [
    //                 '^(11[0-9])$' => [
    //                     'H2' => 54400,
    //                 ]
    //             ],
    //         ],
    //     ];


    //     $payload = [
    //         "type_logement" => "maison",
    //         "efficacite_energetique" => "112",
    //         "zone_climatique" => "H2",
    //         "surface_chauffee" => "80"
    //     ];
    //     $pattern = new PatternA($document, $payload);
        
    //     $response = $pattern->execute();
    //     $this->assertEquals($responseExpected, $response);
    // }
    
    // public function testWithMissingDocumentParameters()
    // {
    //     $responseExpected = 'errors';
        
    //     $document = [
    //         'metadata' => [
    //             'mapping' => [
    //                 'field1' => 'type_logement',
    //                 'field3' => 'zone_climatique',
    //                 'field2' => 'efficacite_energetique',
    //                 'field4' => 'surface_chauffee',
    //             ],
    //         ],
    //         'maison' => [
    //             'operation_2' => [
    //                 '^(7[0-9]|8[0-9])$' => 0.7,
    //             ],
    //             'operation_1' => [
    //                 '^(11[0-9])$' => [
    //                     'H2' => 54400,
    //                 ]
    //             ],
    //         ],
    //     ];


    //     $payload = [
    //         "type_logement" => "maison",
    //         "efficacite_energetique" => "112",
    //         "zone_climatique" => "H2",
    //     ];
    //     $pattern = new PatternA($document, $payload);
        
    //     $response = $pattern->execute();
    //     $this->assertArrayHasKey($responseExpected, $response);
    // }
    
    // public function testThatCatchException()
    // {
    //     $responseExpected = false;
        
    //     $document = [
    //         'metadata' => [
    //             'mapping' => [
    //                 'field1' => 'type_logement',
    //                 'field3' => 'zone_climatique',
    //                 'field2' => 'efficacite_energetique',
    //                 'field4' => 'surface_chauffee',
    //             ],
    //         ],
    //         'maison' => [
    //             'operation_2' => [
    //                 '^(7[0-9]|8[0-9])$' => 0.7,
    //             ],
    //             'operation_1' => [
    //                 '^(11[0-9])$' => [
    //                     'H2' => 54400,
    //                 ]
    //             ],
    //         ],
    //     ];


    //     $payload = [
    //         "type_logement" => "",
    //         "efficacite_energetique" => "112",
    //         "zone_climatique" => "H2",
    //         "surface_chauffee" => "80"
    //     ];
    //     $pattern = new PatternA($document, $payload);
        
    //     $response = $pattern->execute();
    //     $this->assertEquals($responseExpected, $response);
    // }
}