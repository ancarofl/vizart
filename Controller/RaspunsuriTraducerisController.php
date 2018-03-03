<?php
App::uses('AppController', 'Controller');
/**
 * RaspunsuriTraduceris Controller
 *
 * @property RaspunsuriTraduceri $RaspunsuriTraduceri
 * @property PaginatorComponent $Paginator
 */
class RaspunsuriTraducerisController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RaspunsuriTraduceri->recursive = 0;
		$this->set('raspunsuriTraduceris', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RaspunsuriTraduceri->exists($id)) {
			throw new NotFoundException(__('Invalid raspunsuri traduceri'));
		}
		$options = array('conditions' => array('RaspunsuriTraduceri.' . $this->RaspunsuriTraduceri->primaryKey => $id));
		$this->set('raspunsuriTraduceri', $this->RaspunsuriTraduceri->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RaspunsuriTraduceri->create();
			if ($this->RaspunsuriTraduceri->save($this->request->data)) {
				$this->Flash->success(__('The raspunsuri traduceri has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The raspunsuri traduceri could not be saved. Please, try again.'));
			}
		}
		$raspuns = $this->RaspunsuriTraduceri->Raspun->find('list');
		$languages = $this->RaspunsuriTraduceri->Language->find('list');
		$this->set(compact('raspuns', 'languages'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->RaspunsuriTraduceri->exists($id)) {
			throw new NotFoundException(__('Invalid raspunsuri traduceri'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->RaspunsuriTraduceri->save($this->request->data)) {
				$this->Flash->success(__('The raspunsuri traduceri has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The raspunsuri traduceri could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RaspunsuriTraduceri.' . $this->RaspunsuriTraduceri->primaryKey => $id));
			$this->request->data = $this->RaspunsuriTraduceri->find('first', $options);
		}
		$raspuns = $this->RaspunsuriTraduceri->Raspun->find('list');
		$languages = $this->RaspunsuriTraduceri->Language->find('list');
		$this->set(compact('raspuns', 'languages'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RaspunsuriTraduceri->id = $id;
		if (!$this->RaspunsuriTraduceri->exists()) {
			throw new NotFoundException(__('Invalid raspunsuri traduceri'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->RaspunsuriTraduceri->delete()) {
			$this->Flash->success(__('The raspunsuri traduceri has been deleted.'));
		} else {
			$this->Flash->error(__('The raspunsuri traduceri could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
