<?php

namespace Controller\Core;

class Front
{
    public static function init()
    {
        $request = \Mage::getModel('Model\Core\Request');
        $controller = $request->getControllerName();
        $actionName = $request->getActionName() . 'Action';
        $controllerClassName = \Mage::prepareClassName('Controller', $controller);
        $controller = \Mage::getController($controllerClassName);
        $controller->$actionName();
    }
}
