<?php
App::uses('AppController', 'Controller');
/**
 * Visitors Controller
 *
 * @property Visitor $Visitor
 * @property PaginatorComponent $Paginator
 */
class VisitorsController extends AppController {

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
		$this->Visitor->recursive = 0;
		$this->set('visitors', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Visitor->exists($id)) {
			throw new NotFoundException(__('Invalid visitor'));
		}
		$options = array('conditions' => array('Visitor.' . $this->Visitor->primaryKey => $id));
		$this->set('visitor', $this->Visitor->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Visitor->create();
			if ($this->Visitor->save($this->request->data)) {
				$this->Flash->success(__('The visitor has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The visitor could not be saved. Please, try again.'));
			}
		}
	}

	public function salveaza() {
		$this->autoRender = false;
	//	pr($this->request->data);exit;
		if ($this->request->is('post')) {
			$this->Visitor->create();
			$data['Visitor']['raspunsuri'] = json_encode($this->request->data['raspunsuri']);
			$data['Visitor']['ticket_id'] = $this->request->data['bilet'];
			if ($this->Visitor->save($data)) {
				$this->Flash->success(__('Datele au fost salvate'));
				return $this->redirect(array('action' => 'index'));
			} else {
				exit;
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
	public function edit($id = null) {
		if (!$this->Visitor->exists($id)) {
			throw new NotFoundException(__('Invalid visitor'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Visitor->save($this->request->data)) {
				$this->Flash->success(__('The visitor has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The visitor could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Visitor.' . $this->Visitor->primaryKey => $id));
			$this->request->data = $this->Visitor->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Visitor->id = $id;
		if (!$this->Visitor->exists()) {
			throw new NotFoundException(__('Invalid visitor'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Visitor->delete()) {
			$this->Flash->success(__('The visitor has been deleted.'));
		} else {
			$this->Flash->error(__('The visitor could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}




}
