<?php
namespace GuzzleHttp1\Command\Guzzle\RequestLocation;

use GuzzleHttp1\Command\Guzzle\Parameter;
use GuzzleHttp1\Message\RequestInterface;
use GuzzleHttp1\Command\Guzzle\Operation;
use GuzzleHttp1\Command\CommandInterface;

/**
 * Adds query string values to requests
 */
class QueryLocation extends AbstractLocation
{
    public function visit(
        CommandInterface $command,
        RequestInterface $request,
        Parameter $param,
        array $context
    ) {
        $request->getQuery()[$param->getWireName()] = $this->prepareValue(
            $command[$param->getName()],
            $param
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
            foreach ($command->toArray() as $key => $value) {
                if (!$operation->hasParam($key)) {
                    $request->getQuery()[$key] = $this->prepareValue(
                        $value,
                        $additional
                    );
                }
            }
        }
    }
}
