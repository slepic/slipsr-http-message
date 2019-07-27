<?php

namespace Slipsr\Http\Message\Manipulator;

use Psr\Http\Message\RequestInterface;
use Slipsr\Http\Message\Builder\RequestBuilderInterface;

class RequestManipulatorFactory implements RequestManipulatorFactoryInterface
{
    public function createRequestManipulator(RequestInterface $request): RequestBuilderInterface
    {
        return new RequestManipulator($request);
    }
}
