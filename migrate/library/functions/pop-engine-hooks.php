<?php
namespace PoP\QueriedObject;
use PoP\Hooks\Facades\HooksAPIFacade;

class PoP_QueriedObject_VarsHooks
{
    public function __construct()
    {
        HooksAPIFacade::getInstance()->addAction(
            '\PoP\Engine\Engine_Vars:addVars', 
            [$this, 'setQueriedObject'], 
            0, 
            1
        );
    }
    
    public function setQueriedObject($vars_in_array)
    {
        $vars = &$vars_in_array[0];
        $cmsqueriedobjectrouting = CMSRoutingStateFactory::getInstance();

        // Allow to override the queried object, eg: by the AppShell
        list($queried_object, $queried_object_id) = HooksAPIFacade::getInstance()->applyFilters(
            '\PoP\Engine\Engine_Vars:queried-object',
            [
                $cmsqueriedobjectrouting->getQueriedObject(), 
                $cmsqueriedobjectrouting->getQueriedObjectId()
            ]
        );
        
        $vars['routing-state']['queried-object'] = $queried_object;
        $vars['routing-state']['queried-object-id'] = $queried_object_id;
    }
}

/**
 * Initialization
 */
new PoP_QueriedObject_VarsHooks();