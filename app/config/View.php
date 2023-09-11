<?php
// View class
class View extends Route {

    private static $method = "controller";

    public static function RenderView ($view_name, $params)
    {
        if (in_array(self::getUrl()[0], self::$valid_routes))
        {
            // controller path
            $controller_path = __CONTROLLER_PATH__ . $view_name . ".php";

            if (file_exists($controller_path))
            {
                // require the requested view controller
                require_once($controller_path);
                $view_name = new $view_name;
                $class_name = get_class($view_name);

                // check if second param-method is passed
                if (isset(self::getUrl()[1])) {

                    // check if method exists
                    if (method_exists($view_name, self::getUrl()[1]))
                    {
                        self::$method = self::getUrl()[1];
                        unset($params[1]);

                        $params = array_values($params);
                        //call_user_func_array([$class_name, self::$method], [$class_name, $params]);
                    }
                }

                // get name from class object
                call_user_func_array([$class_name, self::$method], [self::$method, $params]);
            } 
            else 
            {
                echo 'no controller, check if it is defined in view.php';
            }
        }
    }

    // end of class
}

