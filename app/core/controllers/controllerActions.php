<?php
// Index (Home) controller
class controllerActions extends Controller {

    // controller methods
    private static $view = "controllerActions";
    public static function controller ($view_name, $params)
    {
        // self::CreateView( self::$view, $data);
    }
}


if ($_POST['get_data']) {
    ?>
        <input type="hidden" id="transmitted-power" value="<?php print_r(RecordsModel::transmitted_power())?>">
        <input type="hidden" id="received-power" value="<?php print_r(RecordsModel::received_power())?>">
        <input type="hidden" id="coil-active" value="<?php print_r(RecordsModel::coil_active())?>">
        <input type="hidden" id="previous_coil_active" value="<?php print_r(RecordsModel::previous_coil_active())?>">
    <?php
}

