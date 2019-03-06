<?php
declare(strict_types=1);

namespace Api;

use Model\ExhaustPort;
use Model\PrisonLocation;

interface AstromechDroid
{
    /**
     * @return PrisonLocation
     */
    public function getLeiaLocation(): PrisonLocation;

    /**
     * @param ExhaustPort $exhaustPort
     */
    public function destroyExhaustPortById(ExhaustPort $exhaustPort): void;
}
