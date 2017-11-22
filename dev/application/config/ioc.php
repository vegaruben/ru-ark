<?php
use Pimple\Container;
use Funnlz\Mappers\PdoAdapter;


$container = new Container();

// define some services
$container['config'] = function ($c){
    $upload_config = array();
    $upload_config['upload_path']   = '/home/aldo/projects/Funnlz.io/github/ru-ark/dev/public/media';
    $upload_config['allowed_types'] = 'gif|jpg|png';
    $upload_config['max_size']      = 2000;
    //$config['max_width']     = 1024;
    //$config['max_height']    = 768;

    $allconfig = ["ProductImageUpload"=>
        $upload_config
    ];

    return $allconfig;
};
$container['pdo'] = function ($c) {
	$dsn = 'mysql:host=localhost;port=3306;dbname=funnlzapp';
	$user = 'root';
	$password = 'willamette';
	
    $pdo = new \PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    return $pdo;
};

$container['pdo_adapter'] = function ($c){
	return new PdoAdapter($c);
};
/*servicess*/
$container['userService'] = function ($c){
    return new \Funnlz\Services\UserService($c);
};
$container['hybridAuth'] = function ($c){
    $config   = dirname(__FILE__) . '/hybridauth.php';
    //var_dump(require_once $config);
    $hybridauth = new Hybrid_Auth($config);
    return $hybridauth;
};
$container['mailerService'] = function ($c){
    $config =  require_once dirname(__FILE__) . '/smtp.php';
    return new \Funnlz\Services\MailerService($c,$config);
};
$container['productService'] = function ($c){
    return new \Funnlz\Services\ProductService($c);
};
$container['mediaService'] = function ($c){
    return new \Funnlz\Services\MediaService($c);
};
$config['ioc'] = $container;
