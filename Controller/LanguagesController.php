<?php
App::uses('AppController', 'Controller');
/**
 * Languages Controller
 *
 * @property Language $Language
 * @property PaginatorComponent $Paginator
 */
class LanguagesController extends AppController {

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
	public function admin_index() {
		$this->Language->recursive = 0;
		$this->set('languages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Language->exists($id)) {
			throw new NotFoundException(__('Inregistrare invalida'));
		}
		$options = array('conditions' => array('Language.' . $this->Language->primaryKey => $id));
		$this->set('language', $this->Language->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Language->create();
			if ($this->Language->save($this->request->data)) {
				$this->Flash->success(__('Informatiile au fost salvate.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('A avut loc o eroare. Incercati din nou.'));
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
		if (!$this->Language->exists($id)) {
			throw new NotFoundException(__('Inregistrare invalida'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Language->save($this->request->data)) {
				$this->Flash->success(__('Informatiile au fost salvate.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('A avut loc o eroare. Incercati din nou.'));
			}
		} else {
			$options = array('conditions' => array('Language.' . $this->Language->primaryKey => $id));
			$this->request->data = $this->Language->find('first', $options);
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
		$this->Language->id = $id;
		if (!$this->Language->exists()) {
			throw new NotFoundException(__('Inregistrare invalida'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Language->delete()) {
			$this->Flash->success(__('Limba a fost stearsa'));
		} else {
			$this->Flash->error(__('A avut loc o eroare. Incercati din nou.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
