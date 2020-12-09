<?php

namespace rapidPHP\modules\router\classier\handler;

use Exception;
use rapidPHP\modules\common\classier\AB;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\core\classier\Controller;
use rapidPHP\modules\core\classier\Model;
use rapidPHP\modules\core\classier\web\View;
use rapidPHP\modules\core\classier\web\ViewInterface;
use rapidPHP\modules\core\classier\web\ViewTemplate;
use rapidPHP\modules\core\classier\web\WebController;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\router\classier\Action;

class ViewHandler implements HandlerInterface
{

    /**
     * @var self
     */
    private static $instance;

    /**
     * @return self
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * @param Controller $controller
     * @param $result
     * @param array $options
     * @return false|mixed|string|void|null
     * @throws Exception
     */
    public function onResult(Controller $controller, $result, $options = [])
    {

        $action = Build::getInstance()->getData($options, 'action');

        if ($result instanceof ViewTemplate) {
            return $result->view();
        } else if ($result instanceof ViewInterface) {
            return $result->display();
        } else if ($action instanceof Action) {
            $template = $action->getTemplate();

            if (empty($template)) return;

            if (is_subclass_of($template, ViewInterface::class)) {
                if (is_string($result)) $result = ['data' => $result];

                /** @var ViewInterface $viewInterface */
                $viewInterface = Classify::getInstance($template)
                    ->newInstance($controller, $result);

                return $viewInterface->display();
            } else if ($controller instanceof WebController) {

                $view = View::display($controller, $template);

                $view->assign($result);

                return $view->view();
            }
        }

    }
}