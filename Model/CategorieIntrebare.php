<?php

App::uses('AppModel', 'Model');

class CategorieIntrebare extends AppModel {

    public $useTable = 'categorii_intrebari';
    public $hasMany = array(
        'Intrebare' => array('foreignKey' => 'categorie_intrebare_id'),
       
    );

}
