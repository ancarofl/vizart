<?php

class Siruta extends AppModel {
    public $useTable = 'siruta';
    public $primaryKey = 'siruta';
    public $abreviereJudete = array('AB' => 20, 'AG' => 38, 'AR' => 29, 'BC' => 47, 'BH' => 56, 'BN' => 65, 'BR' => 92, 'BT' => 74, 'B' => 403, 'BV' => 83, 'BZ' => 109, 'CJ' => 127,
    'CL' => 519, 'CS' => 118, 'CT' => 136, 'CV' => 145, 'DB' => 154, 'DJ' => 163, 'GJ' => 181, 'GL' => 172, 'GR' => 528,
     'HD' => 207, 'HR' => 190, 'IF' => 234, 'IL' => 216, 'IS' => 225, 'MH' => 252, 'MM' => 243, 'MS' => 261, 'OT' => 289,
     'NT' => 270, 'PH' => 298, 'SB' => 323, 'SJ' => 314, 'SM' => 305, 'SV' => 332, 'TL' => 369, 'TM' => 350, 'TR' => 341, 'VL' => 387, 'VN' => 396, 'VS' => 378 );




     public function getLocalitatiByJudetId($id) {
        return $this->retrieveLevel3($this->retrieveLevel2($id));
    }

    public function retrieveLevel2($id) {
        return $this->find('list', array(
                'conditions' => array($this->alias.'.sirsup' => $id),
                'fields' => array($this->alias.'.siruta')
            ));
    }

    public function retrieveLevel3($ids) {
        $res =  $this->find('list', array(
                'conditions' => array($this->alias.'.sirsup' => $ids),
                'fields' => array($this->alias.'.siruta', $this->alias.'.denloc'),
                'order' => array($this->alias.'.denloc')
            ));


    }

    public function getNameById($id) {
        $location = $this->find('first', array('conditions' => array($this->alias.'.siruta' => $id),
            'fields' => array('denloc')));
        return $location[$this->alias]['denloc'];
    }

    public function getNamesOfPlacesByIds($ids) {
        $locations = $this->find('list', array('conditions' => array($this->alias.'.siruta' => $ids),
            'fields' => array('siruta', 'denloc')));
        return $locations;
    }




    public function getJudete(){
        $judete = $this->find('all', array('conditions' => array('Siruta.niv' => "1"), 'fields' => array('Siruta.siruta as id, Siruta.denloc as nume')));
        return $judete;
    }


    public function getJudetePtSelect(){
        $judete = $this->find('all', array('conditions' => array('Siruta.niv' => "1"), 'fields' => array('Siruta.siruta as id, Siruta.denloc as nume'),
            'order' => array('Siruta.denloc')));
        $judeteOut = array();
        $judeteOut['403'] = 'Bucuresti';
        foreach($judete as $judet){
            if($judet['Siruta']['id'] != 403){
                $judeteOut[$judet['Siruta']['id']] = ucwords(strtolower(str_replace('', '', $judet['Siruta']['nume'])));
            }
        }
        return $judeteOut;
    }

    public function getJudetIdByAbbreviation($abbr) {
      if(!isset($this->abreviereJudete[$abbr])) { $abbr = 'B'; }
      return $this->abreviereJudete[$abbr];
    }




}
