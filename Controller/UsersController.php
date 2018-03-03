<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {


    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login');
        
    }

    public function login() {
       

        if ($this->request->is('post')) {

            if ($this->Auth->login()) {
                switch ($this->Auth->user('grup_id')) {
                    case 1:
                    case 2:
                        $url = array('controller' => 'home', 'action' => 'index', 'admin' => true);
                        break;
                    case 3:
                        $url = array('controller' => 'home', 'action' => 'index', 'admin' => false);
                        break;
                }

              
                return $this->redirect($url);
            }
            $this->Flash->error(__('Adresa de email sau parola este gresita.'));
        }
    }


  

    public function recuperare() {
        if ($this->request->is('post')) {
            $user = $this->User->findByEmail($this->request->data['User']['email']);
            if ($user) {
                $recovery = base64_encode($this->generate_password(50));
                $user['User']['recovery'] = $recovery;
                $this->User->save($user);

                $Email = new CakeEmail();
                $Email->from(array('no-reply@mairesponsabili.ro' => 'Mai responsabili'))
                        ->emailFormat('html')
                        ->to($user['User']['email'])
                        ->subject('Recuperare parola')
                        ->send('Salut, <br/> Cineva a cerut recuperarea parolei asociate acestei adrese de email pentru site-ul <a href="http://mairesponsabili.ro">Mai responsabili</a>. Daca vrei sa iti schimbi parola asociata contului <a href="http://mairesponsabili.ro/users/parolanoua?recovery=' . $recovery . '">da click aici</a> (e posibil ca noua parola sa intre in folderul de SPAM asa ca verifica si acolo). Daca nu, actuala parola ramane valabila. <br/><br/> Iti multumim ca esti o persoana responsabila, <br/> <em>Echipa Mai responsabili</em>');
            }

            $this->Flash->success(__('Va rugam sa verificati adresa de email furnizata. Daca aceasta exista in baza noastra de date, veti primi adresa de resetare a parolei.'));
            $url = array('controller' => 'users', 'action' => 'recuperare');
            return $this->redirect($url);
        }
    }

    public function parolanoua() {
        if ($this->request->query['recovery']) {
            $user = $this->User->findByRecovery($this->request->query['recovery']);
            if ($user) {
                $new_password = $this->generate_password(16);
                $user['User']['password'] = $new_password;
                $user['User']['recovery'] = '';
                $this->User->save($user);
                $Email = new CakeEmail();
                $Email->from(array('no-reply@mairesponsabili.ro' => 'Mai responsabili'))
                        ->emailFormat('html')
                        ->to($user['User']['email'])
                        ->subject('Parola noua')
                        ->send('Salut, <br/> Noua ta parola pentru site-ul <a href="http://mairesponsabili.ro">Mai responsabili</a>este: ' . $new_password . ' <br/><br/> Iti multumim ca esti o persoana responsabila, <br/> <em>Echipa Mai responsabili</em>');
            }

            $this->Flash->success(__('Parola noua a fost trimisa pe email.'));
            $url = array('controller' => 'users', 'action' => 'recuperare');
        } else {
            $url = array('controller' => 'home', 'action' => 'index');
        }
        return $this->redirect($url);
    }

     public function schimbare_parola() {
        $this->User->id = $this->Auth->user('id');

        if (!$this->User->exists()) {
            throw new NotFoundException(__('User invalid'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            

            $this->request->data['User']['id'] = $this->Auth->user('id');
            $this->request->data['User']['grup_id'] = $this->Auth->user('grup_id');
            
            
            if($this->request->data['User']['parola'] != $this->request->data['User']['parola2']) {
                $this->Flash->error(__('Cele doua parole nu sunt identice'));
                return $this->redirect(array('action' => 'schimbare_parola'));
            } else {
                 $this->request->data['password'] = $this->request->data['User']['parola'] ;
            }
            
          
            
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Parola a fost modificata'));
                return $this->redirect(array('action' => 'profil'));
            }
            $this->Flash->error(
                    __('A avut loc o eroare. Incercati din nou')
            );
        } else {
            $this->request->data = $this->User->findById($this->Auth->user('id'));






            unset($this->request->data['User']['password']);
        }
    }
    public function profil() {
        if (!$this->Auth->user('id')) {
            return $this->redirect(array('action' => 'login'));
        }

        $this->set('userData', $this->User->findById($this->Auth->user('id')));
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function admin_index() {
        $this->User->recursive = 2;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function inregistrare() {
	if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $helper = $this->fb->getRedirectLoginHelper();
        $permissions = array('email'); // optional
        $this->set('loginUrl', $helper->getLoginUrl($this->facebookLoginUrl, $permissions));
        if ($this->Auth->user('id')) {
            return $this->redirect(array('controller' => 'home', 'action' => 'index'));
        }
        $this->set('judete', $this->User->Judet->find('list', array('fields' => array('id', 'nume'))));
        if ($this->request->is('post')) {
            $this->request->data['User']['grup_id'] = 3;
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Contul tau a fost creat!'));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Flash->error(
                    __('A avut loc o eroare')
            );
        }
    }

    public function admin_add() {

        $this->set('grupuri', $this->User->Grup->find('list', array('fields' => array('id', 'nume'))));
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Am creat contul.'));
                return $this->redirect(array('action' => 'add'));
            }
            $this->Flash->error(
                    __('A avut loc o eroare')
            );
        }
    }

    public function modifica() {
        $this->User->id = $this->Auth->user('id');

        if (!$this->User->exists()) {
            throw new NotFoundException(__('User invalid'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if (strlen($this->request->data['User']['password']) == 0) {
                unset($this->request->data['User']['password']);
            }

            $this->request->data['User']['id'] = $this->Auth->user('id');
            $this->request->data['User']['grup_id'] = $this->Auth->user('grup_id');
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Datele au fost modificate'));
                return $this->redirect(array('action' => 'profil'));
            }
            $this->Flash->error(
                    __('A avut loc o eroare. Incercati din nou')
            );
        } else {
            $this->request->data = $this->User->findById($this->Auth->user('id'));

            unset($this->request->data['User']['password']);
        }
    }

    public function admin_edit($id = null) {
        $this->User->id = $id;
        $this->set('grupuri', $this->User->Grup->find('list', array('fields' => array('id', 'nume'))));
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if (strlen($this->request->data['User']['password']) == 0) {
                unset($this->request->data['User']['password']);
            }
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                    __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

    public function admin_profil() {

        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['User']['id'] = $this->Auth->user('id');
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Informatiile au fost salvate.'));
                return $this->redirect(array('controller' => 'home', 'action' => 'index'));
            }
        }

        $this->request->data = $this->User->findById($this->Auth->user('id'));
    }

    private function generate_password($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }

}
