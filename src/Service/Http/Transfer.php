<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service\Http;

/**
 * Class Transfer
 */
class Transfer
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * Transfer constructor.
     * @param $uri
     * @param $method
     * @param string $username
     * @param string $password
     */
    public function __construct(
        $uri,
        $method,
        $username = '',
        $password = ''
    ) {
        $this->uri = $uri;
        $this->method = $method;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}