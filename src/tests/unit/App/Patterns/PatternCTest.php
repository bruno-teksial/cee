<?php 

namespace App\Tests\Patterns;

use App\Patterns\PatternC;

class PatternCTest extends \Codeception\Test\Unit
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
    //     $responseExpected = 'errors';
        
    //     $document = [
    //         'metadata' => [
    //             'mapping' => [
    //                 'field1' => 'type_logement',
    //                 'field2' => 'type_logement',
    //             ],
    //         ]
    //     ];


    //     $payload = [
    //         "type_logement" => "maison",
    //     ];
                
    //     $pattern = new PatternC($document, $payload);
    //     $response = $pattern->execute();
    //     $this->assertArrayHasKey($responseExpected, $response);
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
    //     $pattern = new PatternC($document, $payload);
        
    //     $response = $pattern->execute();
    //     $this->assertEquals($responseExpected, $response);
    // }
    
    // public function testThatCatchException()
    // {
    //     $responseExpected = false;
        
    //     $document = [
    //         'metadata' => [
    //             'mapping' => [
    //                 'field1' => 'type_logement',
    //             ],
    //         ],
    //     ];


    //     $payload = [
    //         "type_logement" => "",
    //     ];
    //     $pattern = new PatternC($document, $payload);
        
    //     $response = $pattern->execute();
    //     $this->assertEquals($responseExpected, $response);
    // }
}