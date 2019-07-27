<?php

namespace Slipsr\Http\Message\Manipulator;

use Psr\Http\Message\RequestInterface;
use Slipsr\Http\Message\Builder\RequestBuilderInterface;

interface RequestManipulatorFactoryInterface
{
    /**
     * @param RequestInterface $request
     * @return RequestBuilderInterface
     */
    public function createRequestManipulator(RequestInterface $request): RequestBuilderInterface;
}
