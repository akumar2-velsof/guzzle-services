<?php
namespace GuzzleHttp1\Command\Guzzle\RequestLocation;

use GuzzleHttp1\Command\Guzzle\Parameter;
use GuzzleHttp1\Message\RequestInterface;
use GuzzleHttp1\Post\PostBodyInterface;
use GuzzleHttp1\Post\PostFileInterface;
use GuzzleHttp1\Post\PostFile;
use GuzzleHttp1\Command\CommandInterface;

/**
 * Adds POST files to a request
 */
class PostFileLocation extends AbstractLocation
{
    public function visit(
        CommandInterface $command,
        RequestInterface $request,
        Parameter $param,
        array $context
    ) {
        $body = $request->getBody();
        if (!($body instanceof PostBodyInterface)) {
            throw new \RuntimeException('Must be a POST body interface');
        }

        $value = $param->filter($command[$param->getName()]);
        if (!($value instanceof PostFileInterface)) {
            $value = new PostFile($param->getWireName(), $value);
        }

        $body->addFile($value);
    }
}
