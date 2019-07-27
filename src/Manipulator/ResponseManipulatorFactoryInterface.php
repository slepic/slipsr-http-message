<?php

namespace Slipsr\Http\Message\Manipulator;

use Psr\Http\Message\ResponseInterface;
use Slipsr\Http\Message\Builder\ResponseBuilderInterface;

interface ResponseManipulatorFactoryInterface
{
    /**
     * @param ResponseInterface $response
     * @return ResponseBuilderInterface
     */
    public function createResponseManipulator(ResponseInterface $response): ResponseBuilderInterface;
}
