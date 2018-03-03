<?php

class HomeController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('dashboard');
	}
	

	public function dashboard() {

		$this->loadModel('Exposition');
	//	$this->set('expozitii', $this->Exposition->find('list'));

		$user = $this->Auth->user();
		//pr($user);
		
	}

	public function admin_index() {

		$this->loadModel('Visitor');
		$this->loadModel('Intrebare');


		$vizite = $this->Visitor->find('all', array(
			'group' => array('DATE(created)'),
			'fields' => array('DATE(created) as date', 'COUNT(*) as total'),
			'conditions' => array('DATE(created) > NOW() - INTERVAL 30 DAY')
			));
		$vizite = Set::combine($vizite, '{n}.0.date', '{n}.0.total');
		$vizitatori =  $this->Visitor->find('all', array(
			
			'conditions' => array('DATE(created) > NOW() - INTERVAL 30 DAY')
			));

		$intrebari 	= $this->Intrebare->getIntrebariSiRaspunsuri();
		$raspunsuriDate = array();
		foreach($vizitatori as $key => $vizitator) {
			$raspunsuri = json_decode($vizitator['Visitor']['raspunsuri'], true);
			foreach($raspunsuri as $raspuns) {
				if(!isset($raspunsuriDate[$raspuns[0]][$raspuns[1]])) {
					$raspunsuriDate[$raspuns[0]][$raspuns[1]] = 1;
				} else {
					$raspunsuriDate[$raspuns[0]][$raspuns[1]]++;
				}
			}
			
		}

		foreach($intrebari as $key => $intrebare) {
			foreach($intrebare['raspunsuri'] as $raspunsId => $raspunsText) {
				$raspunsuriDate[$key][$raspunsId] = (isset($raspunsuriDate[$key][$raspunsId]))?$raspunsuriDate[$key][$raspunsId]:0;
				$intrebari[$key]['raspunsuri'][$raspunsId] = array('text' => $raspunsText, 'total' => $raspunsuriDate[$key][$raspunsId]);
			}
		}

		
		$this->set('vizite', $vizite);
		$this->set('intrebari', $intrebari);



		
		$user = $this->Auth->user();
		//pr($user);
		
	}

}