<?php
namespace PoP\QueriedObject;

trait Dataloader_SingleTrait
{
    public function getDBObjectIDOrIDs($data_properties)
    {   
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        return $vars['routing-state']['queried-object-id'];
    }

    public function executeGetData(array $ids): array {
    
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        return $vars['routing-state']['queried-object'];
    }
}
