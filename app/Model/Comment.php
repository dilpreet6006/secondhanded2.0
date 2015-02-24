<?php
App::uses('Model', 'Model');
class Comment extends AppModel{
    var $name = 'Comment';
    // public $actsAs = array('Containable');

    //target is a belongsto relationship instead of the intuitive hasone
    //this is because foreign key is on owner, therefore comment carries its target if comments belongs to target
    public $belongsTo = array(
        'Author' => array(
            'className' => 'User',
            'foreignKey' => 'author_id'
        ),
         'Item' => array(
            'className' => 'Item',
            'foreignKey' => 'item_id'
        ),
        'Target' => array(
            'className' => 'Comment',
            'foreignKey' => 'target_id'
        )
    );
}