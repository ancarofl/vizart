<?php

App::uses('AppController', 'Controller');

/**
 * Intrebares Controller
 *
 * @property Intrebare $Intrebare
 * @property PaginatorComponent $Paginator
 */
class IntrebariController extends AppController {

    public $components = array('Paginator');
    public $uses = array('Intrebare');
    public $paginate = array(
        'limit' => 500
    );

    public function beforeFilter() {
       parent::beforeFilter();
    }

    public function index($id = null) {


       // echo "<pre>";
         $this->loadModel('Intrebare');
         $this->Intrebare->contain(array('IntrebariTraduceri', 'Raspuns.RaspunsuriTraduceri'));
         $conditions = array(
            
            'order' => array('Intrebare.ordine'), 'conditions' => array('status' => 1));
          if(is_numeric($id)) {
            $conditions['conditions']['Intrebare.categorie_intrebare_id'] = $id;
        }

        $intrebari = $this->Intrebare->find('all', $conditions);

       
        echo json_encode($intrebari);exit;
    }

    /**
     * index method
     *
     * @return void
     */
    public function admin_index() {
        
      $this->Intrebare->recursive = 0;
        $this->set('intrebari', $this->Paginator->paginate());
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Intrebare->create();
            if ($this->Intrebare->save($this->request->data)) {
                $this->Flash->success(__('Intrebarea a fost salvata.'));
                return $this->redirect(array('action' => 'edit', $this->Intrebare->id));
            } else {
                $this->Flash->error(__('A avut loc o eroare.'));
            }
        }
        $this->set('intrebari', $this->Intrebare->find('list', array('fields' => array('id', 'intrebare'))));
        $this->set('categorii_intrebari', $this->Intrebare->CategorieIntrebare->find('list', array('fields' => array('id', 'nume'),
            'order' => array('CategorieIntrebare.nume'))));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {

        $this->loadModel('Language');

        $languages = $this->Language->find('list', array('conditions' => array('is_default' => '0')));
        $this->set('languages', $languages);

        if (!$this->Intrebare->exists($id)) {
            throw new NotFoundException(__('Intrebarea nu exista'));
        }
        if ($this->request->is(array('post', 'put'))) {
         //   pr($this->request->data);exit;
            if ($this->Intrebare->save($this->request->data)) {
                    $this->Intrebare->IntrebariTraduceri->deleteAll(array('IntrebariTraduceri.intrebare_id' => $id));
                foreach($this->request->data['IntrebariTraduceri'] as $languageId => $value) {
                    if($value != "") {
                        $this->Intrebare->IntrebariTraduceri->create();
                        $this->Intrebare->IntrebariTraduceri->save(array('IntrebariTraduceri' => array('language_id' => $languageId, 'intrebare_id' => $id, 'translation' => $value)));
                    }
                    
                }

                $this->Flash->success(__('Intrebarea a fost salvata.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('A avut loc o eroare.'));
            }
        } else {
            $this->Intrebare->contain(array('Raspuns.RaspunsuriTraduceri', 'IntrebariTraduceri'));
            $options = array('conditions' => array('Intrebare.' . $this->Intrebare->primaryKey => $id));
            $intrebare = $this->Intrebare->find('first', $options);
           // pr($intrebare);exit;
            $this->request->data = $intrebare;
            $this->set('intrebari', $this->Intrebare->find('list', array('fields' => array('id', 'intrebare'))));
            $this->set('categorii_intrebari', $this->Intrebare->CategorieIntrebare->find('list', array('fields' => array('id', 'nume'),
            'order' => array('CategorieIntrebare.nume'))));
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Intrebare->id = $id;
        if (!$this->Intrebare->exists()) {
            throw new NotFoundException(__('Intrebarea nu exista'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Intrebare->delete()) {
            $this->Flash->success(__('Intrebarea a fost stearsa.'));
        } else {
            $this->Flash->error(__('A avut loc o eroare.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function admin_salveaza_raspunsuri($id = null) {
        if ($id) {
            $this->Intrebare->id = $id;
          //  pr($this->request->data);exit;
            if (!$this->Intrebare->exists()) {
                throw new NotFoundException(__('Intrebarea nu exista'));
            }
            foreach ($this->request->data['Raspuns'] as $key => $val) {
                if (!isset($this->request->data['Raspuns'][$key]['id'])) {
                    $this->request->data['Raspuns'][$key]['intrebare_id'] = $id;
                }
                if (strlen($this->request->data['Raspuns'][$key]['raspuns']) == 0) {
                    unset($this->request->data['Raspuns'][$key]);
                }
            }
            $this->Intrebare->Raspuns->saveAll($this->request->data['Raspuns']);

            foreach($this->request->data['RaspunsuriTraduceri'] as $raspuns_id => $translation) {
                 $this->Intrebare->Raspuns->RaspunsuriTraduceri->deleteAll(array('RaspunsuriTraduceri.raspuns_id' => $raspuns_id));
                 foreach($translation as $language_id => $translation) {
                    if($translation != "") {
                        $this->Intrebare->Raspuns->RaspunsuriTraduceri->create();
                        $this->Intrebare->Raspuns->RaspunsuriTraduceri->save(
                            array('RaspunsuriTraduceri' => array('language_id' => $language_id, 'raspuns_id' => $raspuns_id, 'translation' => $translation)));
                    }
                 }
            }

            $this->Flash->success("Raspunsurile au fost salvate");
            $this->redirect(array('action' => 'edit', $id));
        }
    }

}
