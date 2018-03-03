<?php
/**
 * Visitor Fixture
 */
class VisitorFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'minor' => array('type' => 'smallinteger', 'null' => false, 'default' => '0', 'length' => 1, 'unsigned' => false),
		'exposition_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => false, 'key' => 'index'),
		'grup' => array('type' => 'smallinteger', 'null' => false, 'default' => '0', 'length' => 1, 'unsigned' => false),
		'ghidaj' => array('type' => 'smallinteger', 'null' => false, 'default' => '0', 'length' => 1, 'unsigned' => false),
		'urban' => array('type' => 'smallinteger', 'null' => false, 'default' => '0', 'length' => 1, 'unsigned' => false),
		'tara' => array('type' => 'string', 'null' => false, 'default' => 'România', 'length' => 60, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'exposition_id' => array('column' => 'exposition_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'minor' => 1,
			'exposition_id' => 1,
			'grup' => 1,
			'ghidaj' => 1,
			'urban' => 1,
			'tara' => 'Lorem ipsum dolor sit amet',
			'created' => '2018-02-18 09:52:58'
		),
	);

}
