<?php
namespace GuzzleHttp1\Command\Guzzle\ResponseLocation;

use GuzzleHttp1\Command\Guzzle\Parameter;
use GuzzleHttp1\Message\ResponseInterface;
use GuzzleHttp1\Command\CommandInterface;

/**
 * Extracts the reason phrase of a response into a result field
 */
class ReasonPhraseLocation extends AbstractLocation
{
    public function visit(
        CommandInterface $command,
        ResponseInterface $response,
        Parameter $param,
        &$result,
        array $context = []
    ) {
        $result[$param->getName()] = $param->filter(
            $response->getReasonPhrase()
        );
    }
}
