<?php
namespace GuzzleHttp1\Command\Guzzle\RequestLocation;

use GuzzleHttp1\Command\Guzzle\Parameter;
use GuzzleHttp1\Message\RequestInterface;
use GuzzleHttp1\Post\PostBodyInterface;
use GuzzleHttp1\Command\CommandInterface;
use GuzzleHttp1\Command\Guzzle\Operation;

/**
 * Adds POST fields to a request
 */
class PostFieldLocation extends AbstractLocation
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

        $body->setField(
            $param->getWireName(),
            $this->prepareValue($command[$param->getName()], $param)
        );
    }

    public function after(
        CommandInterface $command,
        RequestInterface $request,
        Operation $operation,
        array $context
    ) {
        $additional = $operation->getAdditionalParameters();
        if ($additional && $additional->getLocation() == $this->locationName) {

            $body = $request->getBody();
            if (!($body instanceof PostBodyInterface)) {
                throw new \RuntimeException('Must be a POST body interface');
            }

            foreach ($command->toArray() as $key => $value) {
                if (!$operation->hasParam($key)) {
                    $body->setField(
                        $key,
                        $this->prepareValue($value, $additional)
                    );
                }
            }
        }
    }
}
