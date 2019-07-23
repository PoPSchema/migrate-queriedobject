<?php
namespace PoP\QueriedObject;

abstract class AbstractCMSRoutingState implements CMSRoutingStateInterface
{
    public function __construct()
    {
        CMSRoutingStateFactory::setInstance($this);
    }
}
