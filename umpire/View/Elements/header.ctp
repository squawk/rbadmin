<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <?php echo $this->Html->link('<span class="menu-text">Umpires</span>' , '/', array('class' => 'brand', 'escape' => false, 'data-source-mobile' => 'baseball.icon.jpg')) ?>
        <?php if (AuthComponent::user('id')): ?>
        <ul class="nav">
          <li class="<?php echo $this->params->controller == 'shows' ? 'active' : '';  ?>">
            <?php echo $this->Html->link('<i class="icon-calendar"></i> <span class="menu-text">My Schedule</span>', array('controller' => 'games', 'action' => 'myschedule'), array('escape' => false)) ?>
          </li>
          <li class="<?php echo $this->params->controller == 'shows' ? 'active' : '';  ?>">
            <?php echo $this->Html->link('<i class="icon-inbox"></i> <span class="menu-text">Game Requests</span>', array('controller' => 'games', 'action' => 'request'), array('escape' => false)) ?>
          </li>
          <?php if (AuthComponent::user('role') == 'admin'): ?>
          <li class="dropdown">
            <?php echo $this->Html->link('<i class="icon-file-alt"></i> <span class="menu-text">Administrator</span> <b class="caret"></b>', '#', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'escape' => false, 'id' => 'drop2')) ?>
            <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
              <li>
                <?php echo $this->Html->link('Assign Games' ,array('controller' => 'games', 'action' => 'assign_games')) ?>
              </li>
            </ul>
          </li>
          <?php endif; ?>
        </ul>
        <?php endif; ?>

        <ul class="nav pull-right">
          <?php if( AuthComponent::user('id')): ?>
          <li class="dropdown">
            <?php echo $this->Html->link('<i class="icon-user icon-white"></i> <span class="menu-text">' . AuthComponent::user('name') . '</span> <b class="caret"></b>', '#', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'escape' => false)) ?>
            <ul class="dropdown-menu" role="menu">
              <li>
                <?php echo $this->Html->link('<i class="icon-black icon-user"></i> Profile', array('controller' => 'umpires', 'action' => 'profile'), array('escape' => false)) ?>
              </li>
              <li>
                <?php echo $this->Html->link('<i class="icon-black icon-lock"></i> Change Password', array('controller' => 'umpires', 'action' => 'change_password'), array('escape' => false)) ?>
              </li>
              <li>
                <?php echo $this->Html->link('<i class="icon-black icon-off"></i> Logout', array('controller' => 'umpires', 'action' => 'logout'), array('escape' => false)) ?>
              </li>
            </ul>
          </li>
        <?php else: ?>
          <li class="dropdown">
            <?php echo $this->Html->link('<i class="icon-off icon-white"></i> <span class="menu-text">Login/Register</span> <b class="caret"></b>', '#', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'escape' => false)) ?>
            <ul class="dropdown-menu" role="menu">
              <li>
                <div class="span3"><?php echo $this->element('form_login') ?></div>
              </li>
            </ul>
          </li>
        <?php endif; ?>

        </ul>


    </div>
  </div>
</div>
