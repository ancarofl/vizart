<?php
App::uses('IntrebariTraduceri', 'Model');

/**
 * IntrebariTraduceri Test Case
 */
class IntrebariTraduceriTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.intrebari_traduceri',
		'app.intrebare',
		'app.categorie_intrebare',
		'app.raspuns',
		'app.language'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->IntrebariTraduceri = ClassRegistry::init('IntrebariTraduceri');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IntrebariTraduceri);

		parent::tearDown();
	}

}
