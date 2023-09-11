<?php
// set time zone
date_default_timezone_set('Africa/Lusaka');
// webName
define("__SITE_NAME__", "WPETS");
// iniialization file
define("__CONFIG_PATH__", "config/");
// define controller path
define("__CONTROLLER_PATH__", "./app/core/controllers/");
// define model path
define("__MODELS_PATH__", "core/models/");
// views path
define("__VIEWS_PATH__", "app/core/views/");
// classes path
define("__CLASSES_PATH__", "app/includes/classes/");
// upload directory
define("__PUBLIC_DIR__", 'public/');
// host  | http://localhost/projects/afrobase/

// $_SERVER['REQUEST_URI']
// $_SERVER['HTTP_HOST']
define("__BASE_URL__", "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
//define("__BASE_URL__", "http://localhost/projects/wpets/");

// assets location     ++++ uploads/
define("__ASSETS_DIR__", __BASE_URL__ . __PUBLIC_DIR__ . "assets/");

// contact details
define("__ABOUT_FILE__", "PROJECT REPORT - WPETS.pdf");

