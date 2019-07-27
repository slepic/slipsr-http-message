<?php

namespace Slipsr\Http\Message\Builder;

interface ResponseBuilderFactoryInterface
{
    /**
     * @return ResponseBuilderInterface
     */
    public function createResponseBuilder(): ResponseBuilderInterface;
}
