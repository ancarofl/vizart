<?php
App::uses('RaspunsuriTraduceri', 'Model');

/**
 * RaspunsuriTraduceri Test Case
 */
class RaspunsuriTraduceriTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.raspunsuri_traduceri',
		'app.raspuns',
		'app.intrebare',
		'app.categorie_intrebare',
		'app.intrebari_traduceri',
		'app.language'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RaspunsuriTraduceri = ClassRegistry::init('RaspunsuriTraduceri');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RaspunsuriTraduceri);

		parent::tearDown();
	}

}
