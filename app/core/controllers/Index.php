<?php
// Index (Home) controller
class Index extends Controller {

    // controller methods  
    private static $view = "index";

    public static function controller ($view_name, $params) {  
        $data = [
            "parameters"        => $params,
        ];

        $view_name = self::$view; 
        self::CreateView($view_name, $data);
    }
}