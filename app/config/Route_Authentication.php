<?php
// Route Authentication class
class Route_Authentication extends Route {
    
    // checking if the resquested route is in the routes provided

    public static function Authenticate ()
    {
        /*  @Authenticate Route
        *   @Return url if true else die
        *   @
        */

        $url = self::getUrl()[0];

        if (in_array($url, self::$valid_routes))
        {
            return $url;
        }
        else
        {
            // die('Invalid Route!');
            header("Location: ". __BASE_URL__ );
        }
    }
}
