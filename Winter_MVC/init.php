<?php

/**
 * Winter_MVC library
 *
 * @version 2.3
 *
 * @author SWIT
 * @link https://github.com/sandiwinter/winter_mvc
 */

$Winter_MVC_version_this = 2.3;

global $Winter_MVC;

$winter_mvc_active_plugins = get_option( 'winter_mvc_active_plugins', array() );

$winter_mvc_active_plugins[dirname( __FILE__ )] = 
                array('winter_mvc_version' => $Winter_MVC_version_this,
                      'winter_mvc_file' => __FILE__ 
                     );

// get latest version
$winter_mvc_latest_version = array();

foreach($winter_mvc_active_plugins as $lib_dir => $lib_data)
{
    if(file_exists($lib_data['winter_mvc_file']) && isset($lib_data['winter_mvc_version']))
    {
        if(empty($winter_mvc_latest_version) || $winter_mvc_latest_version['winter_mvc_version'] < $lib_data['winter_mvc_version'])
        {
            $winter_mvc_latest_version = $lib_data;
        }
    }
    else
    {
        unset($winter_mvc_active_plugins[$lib_dir]);
    }
}

update_option( 'winter_mvc_active_plugins', $winter_mvc_active_plugins );

if( empty($Winter_MVC) && $winter_mvc_latest_version['winter_mvc_version'] == $Winter_MVC_version_this )
{
    define( 'WINTER_MVC_PATH', dirname( __FILE__ ) );
    
    require_once 'core/mvc_loader.php';
    $Winter_MVC = new MVC_Loader();
}
elseif(file_exists($winter_mvc_latest_version['winter_mvc_file']))
{
    require_once $winter_mvc_latest_version['winter_mvc_file'];
}
else
{
    define( 'WINTER_MVC_PATH', dirname( __FILE__ ) );
    
    require_once 'core/mvc_loader.php';
    $Winter_MVC = new MVC_Loader();
}

?>