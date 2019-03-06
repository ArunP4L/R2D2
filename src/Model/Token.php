<?php
declare(strict_types=1);

namespace Model;

use RuntimeException;

class Token
{
    /** @var string */
    private $accessToken;
    /** @var int */
    private $expiresIn;
    /** @var string */
    private $tokenType;
    /** @var string */
    private $scope;

    /**
     * @param string $accessToken
     * @param int $expiresIn
     * @param string $tokenType
     * @param string $scope
     */
    private function __construct(string $accessToken, int $expiresIn, string $tokenType, string $scope)
    {
        $this->accessToken = $accessToken;
        $this->expiresIn = $expiresIn;
        $this->tokenType = $tokenType;
        $this->scope = $scope;
    }

    /**
     * @param array $data
     * @return Token
     */
    static public function buildFromArray(array $data): self
    {
        if(self::hasMissingKeys($data)){
            throw new RuntimeException('Invalid creation attempt, missing data.');
        }

        return new self(
            $data['access_token'],
            $data['expires_in'],
            $data['token_type'],
            $data['scope']
        );
    }

    /**
     * @param array $data
     * @return bool
     */
    private static function hasMissingKeys(array $data): bool
    {
        $keys = ["access_token", "expires_in", "token_type", "scope"];
        return count (array_filter($keys, function (string $key) use ($data) {
            return !array_key_exists($key, $data);
        })) > 0;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->accessToken;
    }
}

