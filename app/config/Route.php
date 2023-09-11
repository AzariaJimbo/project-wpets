<?php
// get URL
class Route {
    //variables
    protected static $valid_routes = [];

    //get URL function
    protected static function getUrl ()
    {
        /*  @funcion to get the url  */
        if (isset($_GET['url']))
        {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL); 
            $url = explode('/', $url);
        }
        else
        {
            $url = null;
        }
        return $url;
    }

    public static function set ($route, $function)
    {
        /*  @funcion to set a route  */

        self::$valid_routes[] = $route;
        if (self::getUrl()[0] == $route)
        {
            $params = self::getUrl();
            unset($params[0]);
            //call function
            call_user_func($function, $params);
        }
    }
}