<?php 

/**
 * Test Bar TH 104
 */
class CeeBarEn101Cest
{
    private $responseExpected;
    private $url;
    
    public function _before(ApiTester $I)
    {
        $this->responseExpected = '{"name":"BAR_EN_101","metadata":{"dfa":{"zone_climatique":{"H1":"\\\\App\\\\Patterns\\\\PatternC","H2":"\\\\App\\\\Patterns\\\\PatternC","H3":"\\\\App\\\\Patterns\\\\PatternC"}},"mapping":{"field2":"surface_isolant","field1":"zone_climatique"}},"attributes":{"surface_isolant":{"hint":"number"},"zone_climatique":{"hint":"string","values":["H1","H2","H3"]}},"version":"2020-10","zone_climatique":{"H1":1700,"H2":1400,"H3":900}}';
        $this->url = 'cee/2020-10/BAR_EN_101';
    }

    /**
     * Test existing operation
     * @param ApiTester $I
     */
    public function tryToTestExistingOperation(ApiTester $I)
    {
        $I->sendGet($this->url);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals($this->responseExpected);
    }
}
