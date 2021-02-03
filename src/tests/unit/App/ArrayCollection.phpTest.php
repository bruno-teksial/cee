<?php 

namespace App;

class ArrayCollectionTest extends \Codeception\Test\Unit
{    
    public function testFindWithNumeric()
    {
        $this->assertEquals(
            (new ArrayCollection([15 => '15']))
                ->get(15)
                ->execute()
            ,
            '15'
        );
    }

    public function testFindWithAlphaNumeric()
    {
        $this->assertEquals(
            (new ArrayCollection(['Test15' => '15']))
                ->get('Test15')
                ->execute()
            ,
            '15'
        );
    }

    public function testFoundWithRegex()
    {
        $this->assertEquals(
            (new ArrayCollection(['^(10[2-9])$' => '15']))
                ->get('102')
                ->execute()
            ,
            '15'
        );
    }

    public function testNotFoundWithRegex()
    {
        $this->assertIsArray(
            (new ArrayCollection(['^(10[2-9])$' => '15']))
                ->get('101')
                ->execute()
        );
    }

}