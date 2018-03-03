<?php

App::uses('AppModel', 'Model');

class Intrebare extends AppModel {

    public $useTable = 'intrebari';
    public $actsAs = array('Tree');
    public $hasMany = array(
        'Raspuns' => array(
            'className' => 'Raspuns',
            'foreignKey' => 'intrebare_id',
            'order' => 'Raspuns.ordine ASC',
            'dependent' => true
        ),
        'IntrebariTraduceri' => array(
            'className' => 'IntrebariTraduceri',
            'foreignKey' => 'intrebare_id',
            'dependent' => true
        )
    );
    public $belongsTo = array(
        'CategorieIntrebare' => array(
            'className' => 'CategorieIntrebare',
            'foreignKey' => 'categorie_intrebare_id'
        )
    );

    public function getIntrebariSiRaspunsuri() {
        $intrebari = $this->find('all');
        $return = array();
       
        foreach ($intrebari as $key => $intrebare) {
            $return[$intrebare['Intrebare']['id']] = array('intrebare' => $intrebare['Intrebare']['intrebare']);
            $return[$intrebare['Intrebare']['id']]['raspunsuri'] = $this->convertToListArray($intrebare['Raspuns']);
        }
        return $return;
    }

    public function convertToListArray($raspunsuri) {
        $return = array();
        foreach ($raspunsuri as $raspuns) {
            $return[$raspuns['id']] = $raspuns['raspuns'];
        }
        return $return;
    }

}
