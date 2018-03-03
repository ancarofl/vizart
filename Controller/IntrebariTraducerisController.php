<?php
App::uses('AppController', 'Controller');
/**
 * IntrebariTraduceris Controller
 *
 * @property IntrebariTraduceri $IntrebariTraduceri
 * @property PaginatorComponent $Paginator
 */
class IntrebariTraducerisController extends AppController {

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
		$this->IntrebariTraduceri->recursive = 0;
		$this->set('intrebariTraduceris', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->IntrebariTraduceri->exists($id)) {
			throw new NotFoundException(__('Invalid intrebari traduceri'));
		}
		$options = array('conditions' => array('IntrebariTraduceri.' . $this->IntrebariTraduceri->primaryKey => $id));
		$this->set('intrebariTraduceri', $this->IntrebariTraduceri->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->IntrebariTraduceri->create();
			if ($this->IntrebariTraduceri->save($this->request->data)) {
				$this->Flash->success(__('The intrebari traduceri has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The intrebari traduceri could not be saved. Please, try again.'));
			}
		}
		$intrebares = $this->IntrebariTraduceri->Intrebare->find('list');
		$languages = $this->IntrebariTraduceri->Language->find('list');
		$this->set(compact('intrebares', 'languages'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->IntrebariTraduceri->exists($id)) {
			throw new NotFoundException(__('Invalid intrebari traduceri'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->IntrebariTraduceri->save($this->request->data)) {
				$this->Flash->success(__('The intrebari traduceri has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The intrebari traduceri could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('IntrebariTraduceri.' . $this->IntrebariTraduceri->primaryKey => $id));
			$this->request->data = $this->IntrebariTraduceri->find('first', $options);
		}
		$intrebares = $this->IntrebariTraduceri->Intrebare->find('list');
		$languages = $this->IntrebariTraduceri->Language->find('list');
		$this->set(compact('intrebares', 'languages'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->IntrebariTraduceri->id = $id;
		if (!$this->IntrebariTraduceri->exists()) {
			throw new NotFoundException(__('Invalid intrebari traduceri'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->IntrebariTraduceri->delete()) {
			$this->Flash->success(__('The intrebari traduceri has been deleted.'));
		} else {
			$this->Flash->error(__('The intrebari traduceri could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
