<div class="searchOptions item well">
<?php

$semester = null;

// PUT SEARCH STUFF TOGETHER!! ORGANIZE FORMS
// DUUPPPLLIICAAATTEE!!!!!
echo $this->Form->create('Item', array(
    'class' => 'navbar-form',
    'id' => 'search',
    'controller' => 'items',
    'action' => 'search'
));
echo $this->Form->input('searchString', array(
    'class' => 'form-control',
    'id' => 'searchInput',
    'placeholder' => 'Search listings',
    'label' => false,
    'type' => 'hidden'
));


echo $this->Form->input('semester',  array(
    'class' => 'form-control small',
    //associative array so that indexes and values are the equal
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8),
    //this number is not the value, but the index
    //therefore if the values are numbers starting at 1, 'default'=>4 shows value 5
   // 'default' => (isset($user['User']['semester']) && $user['User']['semester'] != '') ?
   //     $user['User']['semester'] : null,
    // cant do this yet because the user semester tracking isnt implemented
    'empty' => '(Semester)',
    'label' => false,
));

echo $this->Form->input('condition', array(
    'class' => 'form-control small',
    'options' => array('ANY','Mint','Great','OK','Rough','Not Pretty'),
    'empty' => '(Condition)',
    'label' => false,
));

//THESE OPTIONS NEED TO BE EXPORTED TO A TABLE TO ADD/REMOVE
echo $this->Form->input('field', array(
    'class' => 'form-control small',
    'options' => array('ANY','Computer Technology','Architecture','Fashion Design','Construction & engineering','Dance'),
    'empty' => '(Field)',
    'label' => false,
));

echo $this->Form->input('field2', array(
    'class' => 'form-control small',
    'label' => false,
    'options' => array('Computer Technology','Architecture','Fashion Design','Construction & engineering','Dance'),
    'empty' => '(Field)'
));


echo $this->Form->end('Submit');
?>
</div>