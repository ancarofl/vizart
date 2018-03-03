<?php
App::uses('Exposition', 'Model');

/**
 * Exposition Test Case
 */
class ExpositionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.exposition'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Exposition = ClassRegistry::init('Exposition');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Exposition);

		parent::tearDown();
	}

}
