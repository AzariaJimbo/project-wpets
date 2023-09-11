<?php
/*******************************************
 *             main site routes 
 ********************************************/
Route::set('index.php', function ($params) {
    View::RenderView('Index', $params);  
});

Route::set('getSensorData', function ($params) {
    View::RenderView('getSensorData', $params);  
});

Route::set('controllerActions', function ($params) {
    View::RenderView('controllerActions', $params);
});

