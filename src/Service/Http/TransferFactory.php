<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service\Http;

/**
 * Class TransferFactory
 */
class TransferFactory
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
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return Transfer
     */
    public function build()
    {
        return new Transfer(
            $this->uri,
            $this->method,
            $this->username,
            $this->password
        );
    }
}
