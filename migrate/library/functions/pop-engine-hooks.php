<?php
namespace PoP\QueriedObject;
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\Engine\FieldValueResolvers\OperatorFieldValueResolver;

class PoP_QueriedObject_VarsHooks
{
    public function __construct()
    {
        HooksAPIFacade::getInstance()->addAction(
            '\PoP\ComponentModel\Engine_Vars:addVars',
            [$this, 'setQueriedObject'],
            0,
            1
        );
        HooksAPIFacade::getInstance()->addAction(
            OperatorFieldValueResolver::HOOK_SAFEVARS,
            [$this, 'setSafeVars'],
            10,
            1
        );
    }

    public function setQueriedObject($vars_in_array)
    {
        $vars = &$vars_in_array[0];
        $cmsqueriedobjectrouting = CMSRoutingStateFactory::getInstance();

        // Allow to override the queried object, eg: by the AppShell
        list($queried_object, $queried_object_id) = HooksAPIFacade::getInstance()->applyFilters(
            '\PoP\ComponentModel\Engine_Vars:queried-object',
            [
                $cmsqueriedobjectrouting->getQueriedObject(),
                $cmsqueriedobjectrouting->getQueriedObjectId()
            ]
        );

        $vars['routing-state']['queried-object'] = $queried_object;
        $vars['routing-state']['queried-object-id'] = $queried_object_id;
    }
    public function setSafeVars($vars_in_array)
    {
        // Remove the queried object
        $safeVars = &$vars_in_array[0];
        unset($safeVars['routing-state']['queried-object']);
    }
}

/**
 * Initialization
 */
new PoP_QueriedObject_VarsHooks();
