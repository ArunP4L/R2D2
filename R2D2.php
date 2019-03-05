<?php
declare(strict_types=1);


class R2D2 extends AbstractAstromechDroid
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
        $token = $this->getAuthorizationToken($this->credentials);

        // Make request with token/authorization codes?
    }

    /**
     * @param ExhaustPort $exhaustPort
     */
    public function destroyExhaustPortById(ExhaustPort $exhaustPort): void
    {
        $token = $this->getAuthorizationToken($this->credentials);

        // Make request with token/authorization codes?
    }


}