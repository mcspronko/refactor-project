<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service;

/**
 * Class Environment
 */
class Environment
{
    /**
     * @var bool
     */
    private $isSandbox;

    /**
     * Environment constructor.
     * @param bool $isSandbox
     */
    public function __construct($isSandbox)
    {
        $this->isSandbox = (bool) $isSandbox;
    }

    /**
     * @param bool $flag
     */
    public function setSandbox($flag): void
    {
        $this->isSandbox = (bool) $flag;
    }

    /**
     * @return bool
     */
    public function isSandbox(): bool
    {
        return (bool) $this->isSandbox;
    }
}
