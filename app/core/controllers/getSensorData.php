<?php
// Index (Home) controller
class getSensorData extends Controller {

    // controller methods
    private static $view = "track";
    private static $params = null;

    public static function controller ($view_name, $params)
    {    
        $data = [
            "parameters"        => $params
        ];

        // self::CreateView( self::$view, $data);
    }
}

if (isset($_GET["coil_active"])) {    
    $transmitted_power  = $_GET['transmitted_power'];
    $received_power     = $_GET['received_power'];
    $coil_active        = $_GET['coil_active'];

    echo RecordsModel::recorder($received_power, $transmitted_power, $coil_active);
}
