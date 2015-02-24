<?php
App::uses('Model', 'Model');
class Item extends AppModel{
    var $name = 'Item';
   // public $actsAs = array('Containable');

    public $belongsTo = array(
        'Owner' => array(
            'className' => 'User',
            'foreignKey' => 'owner_id'
        )
    );

    public $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'item_id'
        )
    );

    var $hasAndBelongsToMany = array(
        'Watcher' => array(
            'className' => 'User',
            'joinTable' => 'items_users',
            'foreignKey' => 'item_id',
            'associationForeignKey' => 'user_id',
            //deleting item will delete relationship
            'dependent' => true
        ),
    );

    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post,
            'owner_id' => $user)) !== false;
    }
}