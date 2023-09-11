<?php
$paths = "paths.php";
require_once($paths);

//require database config
$db_path = "core/database/Database.php";
require_once($db_path);

//include config files
require_once(__CONFIG_PATH__ . 'Route.php');
require_once(__CONFIG_PATH__ . 'Route_Authentication.php');
require_once(__CONFIG_PATH__ . 'View.php');


// JMedia
require_once(__CLASSES_PATH__ . 'time.php');

// models
require_once(__MODELS_PATH__ . 'BaseModel.php');
require_once(__MODELS_PATH__ . 'RecordsModel.php');

// Controller
require_once(__CONTROLLER_PATH__ . 'Controller.php');

//require routes files
require_once('routes/Routes.php');
// at file end
Route_Authentication::Authenticate();


