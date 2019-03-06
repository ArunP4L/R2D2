<?php
declare(strict_types=1);

namespace Model;

class Token
{
    /** @var string */
    private $accessToken;

    /**
     * @param string $accessToken
     */
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->accessToken;
    }
}

