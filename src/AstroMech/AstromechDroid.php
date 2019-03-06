<?php
declare(strict_types=1);

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