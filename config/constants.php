<?php
$assetUrl = config('app.asset_url').'/';
$public_path = public_path('/');

// foreach (['_PATH'=>$public_path,'_URL'=>$assetUrl] as $key => $value)
// {
//     // Access the directory Path and Url using CONST_PATH OR CONST_URL constants
//     define("USER".$key, $value.'upload/user/');
// }

define("URL", $assetUrl);
define("PATH",$public_path);
define("USER",'upload/user/');
define("ADMIN",'upload/admin/');
// define("MODALANIMATION", setting('site_modal_action') ?? 'fade');
// trading types
define('INTRADAY', 'intraday');
define('DELIVERY', 'delivery');

// trade_entry_type const values;
define('OPENING', 'opening');
define('CLOSING', 'closing');

define('NODE_SRV_IP', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost');
define('NODE_SRV_PORT',':3000');

define('UNAUTH_403_MESSAGE',"You are not authorized to perform this action.");

// define('NODE_SRV_IP','https://dosage-filme-eden-developing.trycloudflare.com');
// define('NODE_SRV_PORT','');
// define('NODE_SRV_URL',NODE_SRV_IP.NODE_SRV_PORT);

define('NODE_SRV_URL',env("NODE_SRV_URL", NODE_SRV_IP.NODE_SRV_PORT));

