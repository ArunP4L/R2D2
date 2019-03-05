<?php
declare(strict_types=1);

class Credentials
{
    /** @var string */
    private $secret;
    /** @var string */
    private $id;

    public function __construct(string $secret, string $id)
    {
        $this->secret = $secret;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}