<?php

namespace Slipsr\Http\Message\Manipulator;

use Psr\Http\Message\ResponseInterface;
use Slipsr\Http\Message\Builder\ResponseBuilderInterface;

class ResponseManipulatorFactory implements ResponseManipulatorFactoryInterface
{
    public function createResponseManipulator(ResponseInterface $response): ResponseBuilderInterface
    {
        return new ResponseManipulator($response);
    }
}
