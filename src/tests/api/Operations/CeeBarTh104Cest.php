<?php 

/**
 * Test Bar TH 104
 */
class CeeBarTh104Cest
{
    private $responseExpected;
    private $operation = 'BAR_TH_104';
    
    public function _before(ApiTester $I): void
    {
        $this->responseExpected = '{"name":"BAR_TH_104","metadata":{"dfa":{"type_logement":{"maison":"\\\\App\\\\Patterns\\\\PatternA","appartement":"\\\\App\\\\Patterns\\\\PatternA"}},"mapping":{"field1":"type_logement","field3":"zone_climatique","field2":"efficacite_energetique","field4":"surface_chauffee"}},"attributes":{"surface_chauffee":{"hint":"number"},"surface_habitable":{"hint":"number"},"zone_climatique":{"hint":"string","values":["H1","H2","H3"]},"type_logement":{"hint":"string","values":["appartement","maison"]}},"version":"2020-10","maison":{"operation_2":{"^(13[1-9]|1[4-9][0-9]|[2-9][0-9]{2}|1000)$":1.6,"^(7[0-9]|8[0-9])$":0.7,"^([0-9]|[1-5][0-9]|6[0-9])$":0.5,"^(1[12][0-9]|130)$":1.1,"^(9[0-9]|10[0-9])$":1},"operation_1":{"^(1[2-8][0-9]|19[0-9]|[2-9][0-9]{2}|1000)$":{"H1":79000,"H2":65400,"H3":43600},"^(11[0-9])$":{"H1":66400,"H2":54400,"H3":36200},"^(10[2-9])$":{"H1":52700,"H2":43100,"H3":28700}}},"appartement":{"operation_2":{"^([0-9]|[12][0-9]|3[0-4])$":0.5,"^(3[5-9]|[45][0-9])$":0.7,"^(6[0-9])$":1,"^(9[0-9]|10[0-9])$":1.5,"^(13[1-9]|1[4-9][0-9]|[2-9][0-9]{2}|1000)$":2.5,"^(7[0-9]|8[0-9])$":1.2,"^(1[12][0-9]|130)$":1.9},"operation_1":{"^(1[2-8][0-9]|19[0-9]|[2-9][0-9]{2}|1000)$":{"H1":39700,"H2":32500,"H3":21700},"^(11[0-9])$":{"H1":32200,"H2":26400,"H3":17600},"^(10[2-9])$":{"H1":24500,"H2":20100,"H3":13400}}}}';
    }

    // tests
    public function tryToTestCee(ApiTester $I): void
    {
        $I->sendGet($this->getUrl('2020-10'));
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals($this->responseExpected);
    }
    
    protected function getUrl(string $version): string
    {
        return ('cee/'.$version.'/'.$this->operation);
    }
}