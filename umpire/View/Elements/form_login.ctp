<h3>Login</h3>
<?php echo $this->Form->create('Umpire', array('url' => array('action' => 'login'))) ?>
  <div class="control-group">
    <div class="controls">
      <div class="input-prepend">
        <span class="add-on"><i class="icon-user"></i></span>
        <?php echo $this->Form->input('username', array('placeholder' => 'Username', 'label' => false, 'div' => false)) ?>
      </div>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <div class="input-prepend">
        <span class="add-on"><i class="icon-key"></i></span>
        <?php echo $this->Form->input('password', array('placeholder' => 'Password', 'label' => false, 'div' => false)) ?>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary"><i class="icon-off icon-white"></i> Login</button>
</form>
<div><?php echo $this->Html->link('Register for an Account', array('controller' => 'umpires', 'action' => 'register')); ?></div>
