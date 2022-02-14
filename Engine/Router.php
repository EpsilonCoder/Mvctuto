<?php
namespace TestProject\Engine;
class Router
{
    public static function run (array $aParams)
    {
        $sNamespace = 'TestProject\Controller\\';
        $sDefCtrl = $sNamespace . 'Blog';
        $sCtrlPath = ROOT_PATH . 'Controller/';
        $sCtrl = ucfirst($aParams['ctrl']);

        if (is_file($sCtrlPath . $sCtrl . '.php'))
        {
            $sCtrl = $sNamespace . $sCtrl;
            $oCtrl = new $sCtrl;

            if ((new \ReflectionClass($oCtrl))->hasMethod($aParams['act']) && (new \ReflectionMethod($oCtrl, $aParams['act']))->isPublic())
                call_user_func(array($oCtrl, $aParams['act']));
            else
                call_user_func(array($oCtrl, 'notFound'));
        }
        else
        {
            call_user_func(array(new $sDefCtrl, 'notFound'));
        }
    }
}
