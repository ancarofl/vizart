<?php

App::uses('AppController', 'Controller');

/**
 * Raspunss Controller
 *
 * @property Raspuns $Raspuns
 * @property PaginatorComponent $Paginator
 */
class RaspunsuriController extends AppController {

    public $components = array('Paginator');
    public $uses = array('Raspuns', 'RaspunsRespondent');
    public $paginate = array(
        'limit' => 25,
            // 'contain' => array('Sondaj')
    );

    public function admin_moveup($id = null) {
        $raspuns = $this->Raspuns->findById($id);
        if ($raspuns) {
            if ($raspuns['Raspuns']['ordine'] != 1) {
                $next = $raspuns['Raspuns']['ordine'] - 1;
                $raspuns2 = $this->Raspuns->find('first', array('conditions' =>
                    array('intrebare_id' => $raspuns['Raspuns']['intrebare_id'],
                        'Raspuns.ordine' => $next)));
                $raspuns2['Raspuns']['ordine'] = $raspuns['Raspuns']['ordine'];
                $raspuns['Raspuns']['ordine'] = $next;

                $this->Raspuns->saveAll(array($raspuns, $raspuns2));
                $this->redirect(array('controller' => 'intrebari', 'action' => 'edit', $raspuns['Raspuns']['intrebare_id']));
            }
        }
    }

    public function admin_movedown($id = null) {
        $raspuns = $this->Raspuns->findById($id);
        if ($raspuns) {
            $next = $raspuns['Raspuns']['ordine'] + 1;
            $raspuns2 = $this->Raspuns->find('first', array('conditions' =>
                array('intrebare_id' => $raspuns['Raspuns']['intrebare_id'],
                    'Raspuns.ordine' => $next)));
            $raspuns2['Raspuns']['ordine'] = $raspuns['Raspuns']['ordine'];
            $raspuns['Raspuns']['ordine'] = $next;

            $this->Raspuns->saveAll(array($raspuns, $raspuns2));
            $this->redirect(array('controller' => 'intrebari', 'action' => 'edit', $raspuns['Raspuns']['intrebare_id']));
        }
    }

    /**
     * index method
     *
     * @return void
     */
    public function admin_index($id = null) {

        $conditions = array();
        if ($id !== null) {
            if ($this->RaspunsRespondent->Sondaj->exists($id)) {
                $intrebari = $this->RaspunsRespondent->Sondaj->Intrebare->getIntrebariSiRaspunsuri($id);
                if (!isset($intrebari[0]['sondaj'])) {
                    $this->Flash->error('Acest sondaj nici macar nu are intrebari.');
                    $this->redirect(array('controller' => 'intrebari', 'action' => 'index', $id));
                }
                $this->set('sondaj', $intrebari[0]['sondaj']);
            }


            $raspunsuri = $this->Paginator->paginate('RaspunsRespondent', $conditions);

            foreach ($raspunsuri as $key => $raspuns) {
                $raspunsuri[$key]['RaspunsRespondent']['raspunsuri'] = $this->Raspuns->decodeAnswer($raspuns['RaspunsRespondent']['raspunsuri']);
            }

            $this->set('raspunsuri', $raspunsuri);
            $this->set('intrebari', $intrebari);
        }
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->Raspuns->exists($id)) {
            throw new NotFoundException(__('Raspunsul nu exista'));
        }
        $options = array('conditions' => array('Raspuns.' . $this->Raspuns->primaryKey => $id));
        $this->set('raspuns', $this->Raspuns->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Raspuns->create();
            if ($this->Raspuns->save($this->request->data)) {
                $this->Flash->success(__('Raspunsul a fost salvata.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('A avut loc o eroare.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->Raspuns->exists($id)) {
            throw new NotFoundException(__('Raspunsul nu exista'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Raspuns->save($this->request->data)) {
                $this->Flash->success(__('Raspunsul a fost salvat.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('A avut loc o eroare.'));
            }
        } else {
            $options = array('conditions' => array('Raspuns.' . $this->Raspuns->primaryKey => $id));
            $this->request->data = $this->Raspuns->find('first', $options);
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
        $this->Raspuns->id = $id;
        if (!$this->Raspuns->exists()) {
            throw new NotFoundException(__('Raspunsul nu exista'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Raspuns->delete()) {
            $this->Flash->success(__('Raspunsul a fost sters.'));
        } else {
            $this->Flash->error(__('A avut loc o eroare.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function admin_sterge($id = null) {
        $raspuns = $this->Raspuns->findById($id);
        if (!$raspuns) {
            throw new NotFoundException(__('Raspunsul nu exista'));
        }
        //$this->request->allowMethod('post', 'delete');
        if ($this->Raspuns->delete($id)) {
            $this->Flash->success(__('Raspunsul a fost sters.'));
        } else {
            $this->Flash->error(__('A avut loc o eroare.'));
        }
        return $this->redirect(array('controller' => 'intrebari', 'action' => 'edit', $raspuns['Raspuns']['intrebare_id']));
    }

}
