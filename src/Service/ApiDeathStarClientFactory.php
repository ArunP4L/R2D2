<?php
declare(strict_types=1);

namespace Service;

use GuzzleHttp\Client;

class ApiDeathStarClientFactory
{
    /**
     * @return DeathStarClient
     */
    public function buildDeathStarClient(): DeathStarClient
    {
        $client = new Client(['base_uri' => 'https://death.star.api/​']);

        return new ApiDeathStarClient(

        );
    }
}
