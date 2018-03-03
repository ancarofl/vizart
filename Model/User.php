<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $belongsTo = array('Grup' => array('foreignKey' => 'grup_id'),);
     
  
    public $validate = array(
        'email' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Nu ati introdus o adresa de email'
            ),
            'email' => array(
                'rule' => 'email',
                'message' => 'Adresa de email nu pare corecta'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Incercati o alta adresa de email.'
            ),
        ),
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Cum va numiti?'
            ),
           
        ),
        'password' => array(
            'required' => array(
                'on'         => 'create',
                'rule' => 'notBlank',
                'message' => 'Trebuie totusi o parola',
            ),
            'length' => array(
                'rule'      => array('between', 8, 100),
                'message'   => 'Minim opt caractere va rugam.',
                'allowEmpty' => true
            ),
            
        ),
        'repeat_password'=>array(
                'on'         => 'create',
                'rule'=>array('password_confirm'),
                'message'=>'Parolele nu se potrivesc',                         
            ),    
        
    );
    
     public function password_confirm(){ 
        if ($this->data['User']['password'] !== $this->data['User']['repeat_password']){
            return false;       
        }
        return true;
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
            );
        }
        return true;
    }

}
