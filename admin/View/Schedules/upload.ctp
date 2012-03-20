<?php
    echo $this->Form->create('Schedule', array('type' => 'file'));
    echo $this->Form->input('filename', array('type' => 'file'));
    echo $this->Form->input('dir', array('type' => 'hidden'));
    echo $this->Form->input('mimetype', array('type' => 'hidden'));
    echo $this->Form->input('filesize', array('type' => 'hidden'));
    echo $this->Form->end('Submit');
?>