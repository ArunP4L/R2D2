<?php
declare(strict_types=1);

namespace Service;

use Model\ExhaustPort;
use Model\PrisonLocation;

interface DeathStarClient
{
    /**
     * @param ExhaustPort $port
     * @return bool
     */
    public function deleteExhaustPortById(ExhaustPort $port): bool;

    /**
     * @param string $prisoner
     * @return PrisonLocation
     */
    public function getLocationOfPrisoner(string $prisoner): PrisonLocation;
}
