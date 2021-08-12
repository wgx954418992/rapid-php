<?php

namespace rapidPHP\modules\router\classier\handler;

use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\core\classier\Controller;
use rapidPHP\modules\core\classier\web\View;
use rapidPHP\modules\core\classier\web\ViewTemplate;
use rapidPHP\modules\core\classier\web\WebController;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\router\classier\Action;

class ViewHandler extends HandlerInterface
{


    /**
     * @param Controller $controller
     * @param $result
     * @param array $options
     * @return false|mixed|string|void|null
     * @throws Exception
     */
    public function onResult(Controller $controller, $result, array $options = [])
    {

        $action = Build::getInstance()->getData($options, 'action');

        if ($result instanceof ViewTemplate) {
            return $result->view();
        } else if ($action instanceof Action) {
            $template = $action->getTemplate();

            if (empty($template)) return;

            if ($controller instanceof WebController) {

                $view = View::display($controller, $template);

                $view->assign($result);

                return $view->view();
            }
        }

    }
}
