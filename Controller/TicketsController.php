<?php
App::uses('AppController', 'Controller');
/**
 * Tickets Controller
 *
 * @property Ticket $Ticket
 * @property PaginatorComponent $Paginator
 */
class TicketsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter() {
		parent::beforeFilter();
        $this->theme = 'Catalog';
    }

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Ticket->recursive = 0;
		$this->set('tickets', $this->Paginator->paginate());
	}

	public function index() {
		echo json_encode($this->Ticket->find('all'));exit;
	}


/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Ticket->create();
			if ($this->Ticket->save($this->request->data)) {
				$this->Flash->success(__('Biletul a fost creat.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('A avut loc o eroare. Va rugam sa incercati din nou.'));
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
		if (!$this->Ticket->exists($id)) {
			throw new NotFoundException(__('A avut loc o eroare. Va rugam sa incercati din nou.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Ticket->save($this->request->data)) {
				$this->Flash->success(__('Biletul a fost salvat'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('A avut loc o eroare. Va rugam sa incercati din nou.'));
			}
		} else {
			$options = array('conditions' => array('Ticket.' . $this->Ticket->primaryKey => $id));
			$this->request->data = $this->Ticket->find('first', $options);
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
		$this->Ticket->id = $id;
		if (!$this->Ticket->exists()) {
			throw new NotFoundException(__('A avut loc o eroare. Va rugam sa incercati din nou.'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Ticket->delete()) {
			$this->Flash->success(__('Biletul nu a putut fi salvat.'));
		} else {
			$this->Flash->error(__('A avut loc o eroare. Va rugam sa incercati din nou.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
