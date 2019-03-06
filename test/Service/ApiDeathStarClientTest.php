<?php
declare(strict_types=1);

namespace test\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Model\Credentials;
use Model\ExhaustPort;
use Model\PrisonLocation;
use PHPUnit\Framework\TestCase;
use Service\ApiDeathStarClient;
use Translator\DroidSpeakTranslator;
use Translator\Translator;

class ApiDeathStarClientTest extends TestCase
{
    /** @var Credentials */
    private $credentials;
    /** @var Translator */
    private $translator;

    protected function setUp(): void
    {
        $this->credentials = new Credentials('', '');
        $this->translator = new DroidSpeakTranslator();
    }

    public function testDeletesExhaustPort()
    {
        $mock = new MockHandler([
            new Response(200, [],
                '{"access_token": "e31a726c4b90462ccb7619e1b51f3d0068bf8006","expires_in": 99999999999,"token_type": "Bearer","scope": "TheForce"}'),
            new Response(200),
        ]);

        $client = new Client(['handler' => HandlerStack::create($mock)]);

        $deathStarClient = new ApiDeathStarClient($this->translator, $client, $this->credentials);
        $this->assertTrue($deathStarClient->deleteExhaustPortById(new ExhaustPort(1)));
    }

    public function testFailsToDeleteExhaustPort()
    {
        $mock = new MockHandler([
            new Response(200, [],
                '{"access_token": "e31a726c4b90462ccb7619e1b51f3d0068bf8006","expires_in": 99999999999,"token_type": "Bearer","scope": "TheForce"}'),
            new Response(400),
        ]);

        $client = new Client(['handler' => HandlerStack::create($mock)]);

        $deathStarClient = new ApiDeathStarClient($this->translator, $client, $this->credentials);
        $this->assertFalse($deathStarClient->deleteExhaustPortById(new ExhaustPort(1)));
    }

    public function testSuccessfullyGetsPrisonerLocation()
    {
        $mock = new MockHandler([
            new Response(200, [],
                '{"access_token": "e31a726c4b90462ccb7619e1b51f3d0068bf8006","expires_in": 99999999999,"token_type": "Bearer","scope": "TheForce"}'
            ),
            new Response(200, [],
            '{"cell":"01100011 01100101 01101100 01101100 00100000 00110001 00110010 00110011", "block": "01100010 01101100 01101111 01100011 01101011 00100000 00110001 00110010 00110011"}'
                ),
        ]);

        $client = new Client(['handler' => HandlerStack::create($mock)]);
        $deathStarClient = new ApiDeathStarClient($this->translator, $client, $this->credentials);

        $prisonerLocation = $deathStarClient->getLocationOfPrisoner('test');
        $this->assertInstanceOf(PrisonLocation::class, $prisonerLocation);

        $this->assertEquals('cell 123',$prisonerLocation->getCell());
        $this->assertEquals('block 123',$prisonerLocation->getBlock());
    }
}
