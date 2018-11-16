<?php
namespace GuzzleHttp1\Command\Guzzle\ResponseLocation;

use GuzzleHttp1\Command\Guzzle\Parameter;
use GuzzleHttp1\Message\ResponseInterface;
use GuzzleHttp1\Command\CommandInterface;

abstract class AbstractLocation implements ResponseLocationInterface
{
    /** @var string */
    protected $locationName;

    /**
     * Set the name of the location
     *
     * @param $locationName
     */
    public function __construct($locationName)
    {
        $this->locationName = $locationName;
    }

    public function before(
        CommandInterface $command,
        ResponseInterface $response,
        Parameter $model,
        &$result,
        array $context = []
    ) {}

    public function after(
        CommandInterface $command,
        ResponseInterface $response,
        Parameter $model,
        &$result,
        array $context = []
    ) {}

    public function visit(
        CommandInterface $command,
        ResponseInterface $response,
        Parameter $param,
        &$result,
        array $context = []
    ) {}
}
