<?php
declare(strict_types=1);

namespace test\Api;

use Api\R2D2;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Model\Credentials;
use Model\ExhaustPort;
use PHPUnit\Framework\TestCase;
use Service\ApiDeathStarClient;
use Translator\DroidSpeakTranslator;

class R2D2Test extends TestCase
{
    public function testWeCanFindLeia()
    {
        $mock = new MockHandler([
            new Response(200, [],
                '{"access_token": "e31a726c4b90462ccb7619e1b51f3d0068bf8006","expires_in": 99999999999,"token_type": "Bearer","scope": "TheForce"}'),
            new Response(200, [],
                '{
"cell": "01000011 01100101 01101100 01101100 00100000 00110010 00110001 00111000 00110111",
"block": "01000100 01100101 01110100 01100101 01101110 01110100 01101001 01101111 01101110 00100000 01000010 01101100 01101111 01100011 01101011 00100000 01000001 01000001 00101101 00110010 00110011 00101100"
}'
            ),
        ]);

        $deathStarClient = new ApiDeathStarClient(
            new DroidSpeakTranslator(),
            new Client(['handler' => HandlerStack::create($mock)]),
            new Credentials('', '')
        );

        $R2D2 = new R2D2($deathStarClient);
        $location = json_decode($R2D2->getLeiaLocation(), true);

        $this->assertArrayHasKey('cell', $location);
        $this->assertArrayHasKey('block', $location);

        $this->assertEquals('Cell 2187',$location['cell']);
        $this->assertEquals('Detention Block AA-23,',$location['block']);
    }

    public function testWeCanBlowUpAnExhaustPort()
    {
        $mock = new MockHandler([
            new Response(200, [],
                '{"access_token": "e31a726c4b90462ccb7619e1b51f3d0068bf8006","expires_in": 99999999999,"token_type": "Bearer","scope": "TheForce"}'),
            new Response(200),
        ]);

        $deathStarClient = new ApiDeathStarClient(
            new DroidSpeakTranslator(),
            new Client(['handler' => HandlerStack::create($mock)]),
            new Credentials('', '')
        );

        $R2D2 = new R2D2($deathStarClient);
        $success = json_decode($R2D2->destroyExhaustPortById(new ExhaustPort(1)), true);

        $this->assertArrayHasKey('success', $success);

        $this->assertEquals(true,$success['success']);
    }

}
