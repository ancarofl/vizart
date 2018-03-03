<?php

App::uses('AppModel', 'Model');

class Grup extends AppModel {

    public $useTable = 'grupuri';
    public $hasMany = array(
        'User' => array('foreignKey' => 'grup_id')
    );
  

    public function getGrupNameById($id) {
        $grup = $this->find('first', array('conditions' => array('Grup.id' => $id)));
        return $grup['Grup']['nume'];
    }

}
