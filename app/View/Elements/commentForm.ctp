<?php
//this element takes a target_id which should be set to false for a basic form
// also requires a parent_id
$commentFormArray = array(
    'url' => array(
            'controller' => 'items',
            'action' => 'add_comment',
            // include target only if exists by adding it
            // had to include numeric indexes manually for it to work.
            $item['Item']['id']) +
        (($target && $parent)? array(1 => $target, 2 => $parent) : array()),
    'class' => (($target)? ' comment_reply_form ' : ' comment_form ')
);

// THIS NEEDS TO BE AN ELEMENT, AND REUSABLE FOR COMMENT REPLY FORM INSERTION
// new comment form
echo $this->Form->create('Comment', array_merge($commentFormArray, array(
    //'id' => 'comment_form',
)));
echo $this->Form->input('body', array(
    'class' => ' comment_body ',
    'id' => 'comment_body',
    'empty' => 'Ask the seller a question',
    //   'placeholder' => 'Search listings',
    'label' => false,
));

//apparently buttons take only ONE PARAMETER
//still cannot figure out how to change label on button.
//if replace array by single string it works, but value index doesnt...
echo $this->Form->end(array(
    'value'=> 'fds',
    'class' => 'btn btn-default',
    'placeholder' => 'Search listings',
    'label' => false,
));
?>