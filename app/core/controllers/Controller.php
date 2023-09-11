<?php
// Database config
class Controller extends Database {
    // createview function
    protected static function CreateView ($view_name, $data = [])
    {
        // current view -> views_path is defined in the init file
        $current_view = __VIEWS_PATH__ . $view_name . ".php";
        //check if file exists
        if (file_exists($current_view))
        {
            //require the view  
            require_once($current_view);
        }
        else
        {
            echo "No View!";
        }
    }

    protected static function current_pageGetter ($page) {
        if (is_numeric($page)) {
            return floor($page);
        } else {
            return 1;
        }
    }
}