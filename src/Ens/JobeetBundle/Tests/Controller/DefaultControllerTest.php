<?php

namespace Ens\JobeetBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {
	public function testIndex() {
		$client = static::createClient ();
		
		$crawler = $client->request ( 'GET', '/category/index' );
		
		$this->assertEquals ( 'Ens\JobeetBundle\Controller\CategoryController::showAction', $client->getRequest ()->attributes->get ( '_controller' ) );
		
		$this->assertTrue ( 404 === $client->getResponse ()->getStatusCode () );
	}
}
