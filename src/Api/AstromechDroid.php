<?php
declare(strict_types=1);

namespace Api;

use Model\ExhaustPort;

interface AstromechDroid
{
    /**
     * @return string
     */
    public function getLeiaLocation(): string;

    /**
     * @param ExhaustPort $exhaustPort
     * @return string
     */
    public function destroyExhaustPortById(ExhaustPort $exhaustPort): string;
}
