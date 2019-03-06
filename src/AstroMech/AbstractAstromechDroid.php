<?php
declare(strict_types=1);

class AbstractAstromechDroid implements AstromechDroid
{

    /**
     * @return PrisonLocation
     */
    public function getLeiaLocation(): PrisonLocation
    {
        throw new BadMethodCallException(sprintf('Droid is missing %s functionality' . __FUNCTION__));
    }

    /**
     * @param ExhaustPort $exhaustPort
     */
    public function destroyExhaustPortById(ExhaustPort $exhaustPort): void
    {
        throw new BadMethodCallException(sprintf('Droid is missing %s functionality' . __FUNCTION__));
    }

    protected function getAuthorizationToken(Credentials $credentials): Token
    {

    }
}