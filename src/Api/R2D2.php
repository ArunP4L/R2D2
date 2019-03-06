<?php
declare(strict_types=1);

namespace Api;

use Model\ExhaustPort;
use Model\PrisonLocation;
use Service\DeathStarClient;

class R2D2 implements AstromechDroid
{
    /** @var DeathStarClient */
    private $deathStarClient;

    /**
     * @param DeathStarClient $deathStarClient
     */
    public function __construct(DeathStarClient $deathStarClient)
    {
        $this->deathStarClient = $deathStarClient;
    }

    /**
     * @return PrisonLocation
     */
    public function getLeiaLocation(): string
    {
        $location = $this->deathStarClient->getLocationOfPrisoner('leia');
        return json_encode([
            'cell' => $location->getCell(),
            'block' => $location->getBlock(),
        ]);
    }

    /**
     * @param ExhaustPort $exhaustPort
     * @return string
     */
    public function destroyExhaustPortById(ExhaustPort $exhaustPort): string
    {
        $result = $this->deathStarClient->deleteExhaustPortById($exhaustPort);

        if (!$result) {
            return json_encode(['success' => false]);
        }

        return json_encode(['success' => true]);
    }


}
