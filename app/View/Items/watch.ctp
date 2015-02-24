<?php
echo $this->Form->create('Item');
echo $this->Form->input('Item', array('multiple' => true)); //'checkbox' instead of true for checkbox
echo $this->Form->input('Item.Watcher', array('multiple' => true));
echo $this->Form->end('submit');