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

class ApiDeathStarClientTest extends TestCase
{
    /** @var Credentials */
    private $credentials;

    protected function setUp(): void
    {
        $this->credentials = new Credentials('', '');
    }

    public function testDeletesExhaustPort()
    {
        $mock = new MockHandler([
            new Response(200, [],
                '{"access_token": "e31a726c4b90462ccb7619e1b51f3d0068bf8006","expires_in": 99999999999,"token_type": "Bearer","scope": "TheForce"}'),
            new Response(200),
        ]);

        $client = new Client(['handler' => HandlerStack::create($mock)]);

        $deathStarClient = new ApiDeathStarClient($client, $this->credentials);
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

        $deathStarClient = new ApiDeathStarClient($client, $this->credentials);
        $this->assertFalse($deathStarClient->deleteExhaustPortById(new ExhaustPort(1)));
    }

    public function testSuccessfullyGetsPrisonerLocation()
    {
        $mock = new MockHandler([
            new Response(200, [],
                '{"access_token": "e31a726c4b90462ccb7619e1b51f3d0068bf8006","expires_in": 99999999999,"token_type": "Bearer","scope": "TheForce"}'
            ),
            new Response(200, [],
            '{"cell":"cell 123", "block": "block 123"}'
                ),
        ]);

        $client = new Client(['handler' => HandlerStack::create($mock)]);
        $deathStarClient = new ApiDeathStarClient($client, $this->credentials);

        $prisonerLocation = $deathStarClient->getLocationOfPrisoner('test');
        $this->assertInstanceOf(PrisonLocation::class, $prisonerLocation);

        $this->assertEquals('cell 123',$prisonerLocation->getCell());
        $this->assertEquals('block 123',$prisonerLocation->getBlock());
    }
}
