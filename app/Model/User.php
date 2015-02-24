<?php
App::uses('Model', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class User extends AppModel{
    var $name = 'User';

    public $hasMany = array(
        'MyItem' => array(
            'className' => 'Item',
            'foreignKey' => 'owner_id',
            //dependent causes deleting user to delete items
            //this goes on the owner model
            'dependent' => true
        )
    );

    var $hasAndBelongsToMany = array(
        'WatchItem' => array(
            'className' => 'Item',
            'joinTable' => 'items_users',
            'foreignKey' => 'user_id',
            'associationForeignKey' => 'item_id',
             'dependent' => true
        ),
    );

    public $validate = array(
        'name' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'message' => 'Letters and numbers only'
            ),
            'between' => array(
                'rule'    => array('lengthBetween', 5, 15),
                'message' => 'Between 5 to 15 characters'
            )
        ),
        'password' => array(
            'rule' => array('minLength', '8'),
            'message' => 'Minimum 8 characters long'
        ),
        'email' => array(
            'rule' => 'email',
            'allowEmpty' => true
        ),
        'born' => array(
            'rule' => 'date',
            'message' => 'Enter a valid date',
            'allowEmpty' => true
        )
    );

    //replace password for hashed password
    //login checks every hash method
    //Needs blowfishhasher (at the top)
    public function beforeSave($options = array()){
        parent::beforeSave();

        //IMPLEMENT A WAY TO TRACK SEMESTERS FOR STUDENTS, AND ASK USERS FOR FEEDBACK TO PREVENTS ERRORS
        //THIS LINE BELOW RUNS, BUT DOESNT ACCOMPLISH THE TASK, IT ONLY INCREMENTS THE VALUE SUBMITTED.
        //$this->data[$this->alias]['semester'] = intval($this->data[$this->alias]['semester']) + 1;

        // hash password
        // debug( $this->data[$this->alias]['password']);
        // this does not rehash passwords already stored,
        // only if theres a new password in data, it will be hashed
        if(isset($this->data[$this->alias]['password'])){
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }

}