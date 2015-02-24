
<?php if($user): ?>
<ul class="nav navbar-nav pull-right">

    <li class="dropdown">

        <a href="#" id="icon"><span class="glyphicon glyphicon-bell" ></span> </a>

        <a href="#" id="icon"><span class="glyphicon glyphicon-shopping-cart" ></span> </a>

        <a href="#" class="dropdown-toggle" id="account" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></b>
            <?php echo $user['User']['name']; ?>

            </h1><strong class="caret"></strong></a>

        <ul class="dropdown-menu">
            <li>
                <a href="#"><span class=""></span> Profile</a>
            </li>

            <li>
                <a href="#"><span class=""></span>My Listings</a>
            </li>


            <li>
                <a href="#"><span class=""></span> Settings</a>
            </li>

            <li class="divider"></li>

            <li>
                <a href=""><span class="glyphicon glyphicon-off"></span> Sign out</a>
            </li>
        </ul>
    </li>
</ul>
<?php else : ?>
<div class="nav navbar-nav pull-right">
    <?php
    echo $this->Html->link(
        'Login',
        '#',
        array(
            'class' => 'btn btn-lg btn-success login',
            'target' => '_blank',
            'data-toggle' => 'modal',
            'data-target' => '#basicModal')
    );
    echo $this->Html->link(
        'Register',
        array(
            'controller' => 'users',
            'action' => 'add'),
        array(
            'class' => 'btn btn-lg btn-success register')
    );
    ?>
            <?php
            /*        CLEAN THIS UP!
             *
             * echo $this->Html->image("cake.icon.png", array(
    "id" => "registerButton",
    "alt" => "image broken",
    'url' => array('controller' => 'users', 'action' => 'add')
            )).$this->Html->image("default.png", array(
    "id" => "loginButton",
    "alt" => "image broken"
)); */?>
</div>
<?php endif; ?>