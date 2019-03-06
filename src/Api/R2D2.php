<?php
declare(strict_types=1);

namespace Api;

use Model\Credentials;
use Model\ExhaustPort;
use Model\PrisonLocation;

class R2D2 implements AstromechDroid
{
    /**
     * @var Credentials
     */
    private $credentials;

    /**
     * R2D2 constructor.
     * @param Credentials $credentials
     */
    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @return PrisonLocation
     */
    public function getLeiaLocation(): PrisonLocation
    {

    }

    /**
     * @param ExhaustPort $exhaustPort
     */
    public function destroyExhaustPortById(ExhaustPort $exhaustPort): void
    {

    }


}
