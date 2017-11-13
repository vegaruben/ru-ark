<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 06/11/17
 * Time: 10:36
 */

namespace Funnlz\Services;
use Pimple\ServiceProviderInterface;
use Pimple\Container;
use Funnlz\Mappers\PdoAdapter;
use \PDO;

//this class is used by phpunit on Funnlz/Tests

class TestModeServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        //echo 'registering';
        // define some services
        $container['pdo'] = function ($c) {
            $dsn = 'mysql:host=localhost;port=3306;dbname=funnlzapp';
            $user = 'root';
            $password = 'willamette';

            $pdo = new PDO($dsn, $user, $password);
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
    }

}