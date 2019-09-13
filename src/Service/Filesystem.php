<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service;

/**
 * Class Filesystem
 */
class Filesystem
{
    /**
     * @return string
     */
    public function getRootDir()
    {
        return BASE_PATH;
    }
}
