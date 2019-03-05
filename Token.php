<?php
declare(strict_types=1);

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

    private function __construct(string $accessToken, int $expiresIn, string $tokenType, string $scope)
    {
        $this->accessToken = $accessToken;
        $this->expiresIn = $expiresIn;
        $this->tokenType = $tokenType;
        $this->scope = $scope;
    }

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
        $keys = ['access_token', 'expires_in', 'token_type', 'scope',];
        return count (array_filter($keys, function (string $key) use ($data) {
            return !in_array($key, $data);
        })) > 0;

    }
}

