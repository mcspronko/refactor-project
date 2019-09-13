<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service\Http\Client;

use JournalMedia\Sample\Api\ClientInterface;
use JournalMedia\Sample\Api\ConverterInterface;
use JournalMedia\Sample\Service\Filesystem;
use JournalMedia\Sample\Service\Http\ClientException;
use JournalMedia\Sample\Service\Http\ConverterException;
use JournalMedia\Sample\Service\Http\TransferFactory;
use Symfony\Component\Finder\Finder;

/**
 * Class File
 */
class File implements ClientInterface
{
    /**
     * @var ConverterInterface
     */
    private $converter;

    /**
     * @var Finder
     */
    private $finder;

    /**
     * @var string
     */
    private $location;

    /**
     * @var array
     */
    private $resourceMapping;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * File constructor.
     * @param Finder $finder
     * @param ConverterInterface $converter
     * @param array $resourceMapping
     * @param Filesystem $filesystem
     * @param string $location
     */
    public function __construct(
        Finder $finder,
        ConverterInterface $converter,
        array $resourceMapping,
        Filesystem $filesystem,
        $location
    ) {
        $this->finder = $finder;
        $this->converter = $converter;
        $this->resourceMapping = $resourceMapping;
        $this->filesystem = $filesystem;
        $this->location = $location;
    }

    /**
     * @param TransferFactory $transferFactory
     * @return array|mixed
     * @throws ClientException
     * @throws ConverterException
     */
    public function send(TransferFactory $transferFactory)
    {
        $transfer = $transferFactory->build();
        $uri = $transfer->getUri();

        $uri = str_replace($transferFactory->getApiUrl(), '', $uri);
        $parts = explode('/', $uri);
        if (isset($parts[1]) && (int) $parts[1] > 0) {
            $uri = $parts[0];
        }
        if (!isset($this->resourceMapping[$uri])) {
            throw new ClientException(sprintf('The resource name can\'t be found for the given URI: %s', $uri));
        }

        $fileName = $this->resourceMapping[$uri];

        $this->finder->in($this->filesystem->getRootDir() . DIRECTORY_SEPARATOR . $this->location);

        $result = '';
        foreach ($this->finder->name($fileName) as $file) {
            $result = $file->getContents();
            break;
        }

        //The Hack, due to differences between curl and file formats
        $result = json_decode($result, true);
        $result = [
            'response' => [
                'articles' => $result,
                'pagination' => []
            ]
        ];
        $result = json_encode($result);

        return $this->converter->convert($result);
    }
}
