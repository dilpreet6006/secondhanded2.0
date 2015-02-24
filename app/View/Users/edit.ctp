
<h1>Edit User</h1>
<?php
echo $this->Form->create('User', array('type' => 'file'));
echo $this->Form->input('name');
echo $this->Form->input('program_id');
echo $this->Form->input('semester');
echo $this->Form->input('Image', array('type' => 'file'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Post');
?>