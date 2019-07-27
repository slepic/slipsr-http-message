<?php

namespace Slipsr\Http\Message\Builder;

interface RequestBuilderFactoryInterface
{
    /**
     * @return RequestBuilderInterface
     */
    public function createRequestBuilder(): RequestBuilderInterface;
}
