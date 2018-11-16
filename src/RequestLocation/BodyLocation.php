<?php
namespace GuzzleHttp1\Command\Guzzle\RequestLocation;

use GuzzleHttp1\Command\CommandInterface;
use GuzzleHttp1\Command\Guzzle\Parameter;
use GuzzleHttp1\Message\RequestInterface;
use GuzzleHttp1\Stream\Stream;

/**
 * Adds a body to a request
 */
class BodyLocation extends AbstractLocation
{
    public function visit(
        CommandInterface $command,
        RequestInterface $request,
        Parameter $param,
        array $context
    ) {
        $value = $command[$param->getName()];
        $request->setBody(Stream::factory($param->filter($value)));
    }
}
