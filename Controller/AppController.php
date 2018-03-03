<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {


	 public $components = array(
        'Flash',
        'Session',
        'Paginator',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login',
                'admin' => false
            ),
            'loginRedirect' => array(
                'controller' => 'home',
                'action' => 'index',
                'admin' => false
            ),
            'logoutRedirect' => array(
                'controller' => 'home',
                'action' => 'index',
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
                    'userModel' => 'User',
                    'fields' => array('username' => 'email', 'password' => 'password')
                )
            )
        ),
    );

    public function beforeFilter() {

		
        $this->set('logged_in', false);
        $this->Auth->allow( 'index' , 'login', 'salveaza');

        if ((isset($this->params['prefix']) && ($this->params['prefix'] == 'admin'))) {
            if ($this->Auth->user('grup_id') > 2) {
                $this->redirect(array('controller' => 'home', 'action' => 'index', 'admin' => false));
            }
            $this->Auth->allow('login');
            $this->theme = 'Catalog';
        } else {
            $this->theme = 'Frontend';
        }
        
        if ($this->Auth->user('id')) {
            $this->set('user', $this->Auth->user());
            $this->set('logged_in', true);
        }
    }
}
