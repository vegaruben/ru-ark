<?php
namespace Fuunlz\Tests;

use Pimple\Container;
use Funnlz\Services\TestModeServiceProvider;


class UserTest extends \PHPUnit_Framework_TestCase {

	private $container;

	public function setUp() {
        $this->container = new Container();
        $this->container->register(new TestModeServiceProvider());
	}

	public function testMethod1() {
		$svc = $this->container['userService'];
        $user = $svc->findById(1);
        var_dump($user);
	}

}
