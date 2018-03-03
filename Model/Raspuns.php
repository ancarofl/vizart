<?php

App::uses('AppModel', 'Model');

class Raspuns extends AppModel {

    public $useTable = 'raspunsuri';
    public $belongsTo = array('Intrebare');
     public $hasMany = array(       
        'RaspunsuriTraduceri' => array(
            'className' => 'RaspunsuriTraduceri',
            'foreignKey' => 'raspuns_id',
            'dependent' => true
        )
    );

    public function decodeAnswer($raspuns) {
        $raspunsuri = array();
        foreach (json_decode($raspuns) as $answer) {
            $raspunsuri[$answer->name][] = $answer->value;
        }
        return $raspunsuri;
    }

}
