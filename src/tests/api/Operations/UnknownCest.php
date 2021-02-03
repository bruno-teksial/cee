<?php 

/**
 * Test Bar TH 104
 */
class UnknownCest
{
    private $responseExpected;
    private $url;
    
    public function _before(ApiTester $I)
    {
        $this->responseExpected = 'Not found';
        $this->url = 'cee/2020-10/something';
    }
    
    /**
     * Test unknown operation
     * @param ApiTester $I
     */
    public function tryToTestUnknownOperation(ApiTester $I)
    {
        $I->sendGet($this->url);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::NOT_FOUND); // 404
    }
}
