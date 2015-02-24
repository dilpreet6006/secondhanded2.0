

<!DOCTYPE html>

<html>
<head>
<?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('/bootstrap/css/bootstrap.min');
    echo $this->Html->css('/includes/css/styles');
    echo $this->Html->css('/includes/css/bootstrap-glyphicons');
    echo $this->Html->script('/includes/js/modernizr-2.6.2.min');
    echo $this->Html->script('/includes/js/jquery-1.8.2.min');
    echo $this->Html->script('/bootstrap/js/bootstrap.min');
    echo $this->Html->script('secondhanded');
?>


</head>
<body>
<div class="" id="main">

    <div class="navbar navbar-fixed-top" id="bg" >

        <div class="container" >

            <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <button class="navbar-toggle" data-target=".navbar-responsive-collapse" data-toggle="collapse" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="/">
                <?php echo $this->Html->image("logo.png", array('alt'=>'Image Failed')); ?>
            </a>

            <div class="nav-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Home</a>
                    </li>


                    </li>
                </ul>

                    <?php
                    echo $this->Form->create('Item', array(
                            'class' => 'navbar-form pull-left',
                            'id' => 'search',
                            'controller' => 'items',
                            'action' => 'search'
                    ));
                    echo $this->Form->input('searchString', array(
                            'class' => 'form-control',
                            'id' => 'searchInput',
                            'placeholder' => 'Search listings',
                            'label' => false
                    ));


                    //apparently buttons take only ONE PARAMETER
                    //still cannot figure out how to change label on button.
                    //if replace array by single string it works, but value index doesnt...
                    echo $this->Form->end(array(
                        'value' => 'fds',
                        'class' => 'btn btn-default glyphicon glyphicon-search',
                        'id' => 'searchButton',
                        'placeholder' => 'Search listings',
                        'label' => false,
                    ));
                    ?>


                <?php echo $this->element('userBar', array('user'=> $user)); ?>

            </div><!-- end nav-collapse -->

        </div><!-- end container -->

    </div><!-- end navbar-->

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand" style="margin-left:-0.7cm; margin-top:0.8cm;">
                    <a href="home.html">
                        <?php echo $this->Html->image("images/sidebarName.png", array('alt'=>'Image Failed')); ?>
                    </a>
                </li>
                <li>
                    <a href="#">About Us</a>
                </li>
                <li>
                    <a href="#">Locations</a>
                </li>
                <li>
                    <a href="#">Categories</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Support</a>
                </li>
                <li>
                    <a href="#">FAQs</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

<div id="content">

    <?php echo $this->Session->flash(); ?>

    <?php echo $this->fetch('content'); ?>


</div>


        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <h6>Copyright &copy; 2015 SecondHandEd</h6>
                    </div> <!-- end col-sm-2 -->

                    <div class="col-sm-4">
                        <h6>About Us</h6>
                        <p>Try-hard church-key drinking vinegar sriracha, biodiesel XOXO scenester listicle blog four dollar toast post-ironic cornhole photo booth bicycle rights. Try-hard church-key drinking vinegar sriracha, biodiesel XOXO scenester listicle blog four dollar toast post-ironic cornhole photo booth bicycle rights.  </p>
                    </div> <!-- end col-sm-2 -->

                    <div class="col-sm-2">
                        <h6>Navigation</h6>
                        <ul class="unstyled">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div> <!-- end col-sm-2 -->

                    <div class="col-sm-2">
                        <h6>Follow Us</h6>
                        <ul class="unstyled">
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Google Plus</a></li>
                        </ul>
                    </div> <!-- end col-sm-2 -->

                    <div class="col-sm-2">
                        <h6>Coded with <span class="glyphicon glyphicon-heart"></span> by Team 6 </h6>
                    </div> <!-- end col-sm-2 -->
                </div> <!-- end row -->
            </div> <!-- end container -->
        </footer>
        <!-- End Footer -->

        <!-- All Javascript at the bottom of the page for faster page loading -->

        <!-- First try for the online version of jQuery-->
        <script src="http://code.jquery.com/jquery.js"></script>

        <!-- If no online access, fallback to our hardcoded version of jQuery -->
        <script>window.jQuery || document.write('<script src="includes/js/jquery-1.8.2.min.js"><\/script>')</script>

        <!-- Bootstrap JS -->
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <!-- Custom JS -->
        <script src="includes/js/script.js"></script>

        <?php
        // GET THIS OUT OF HERE, INTO ELEMENT
        ?>
        <div class="container">
            <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Basic Modal</h4>
                        </div>
                        <div class="modal-body">
                            <div class="login">
                                <h1>Login to Web App</h1>
                                <!-- form start -->
                                <?php echo $this->Form->create('User', array(
                                    'controller' => 'users',
                                    'action' => 'login'
                                ));?>

                                <p>
                                    <?php echo $this->Form->input('name');?>
                                </p>
                                <p>
                                    <?php echo $this->Form->input('password');?>
                                </p>
                                <p class="remember_me">
                                    <label>
                                        <input type="checkbox" name="remember_me" id="remember_me">
                                        Remember me on this computer
                                    </label>
                                </p>
                                <p class="submit">
                                    <!-- submit / Form END -->
                                    <?php echo $this->Form->end(__('Login')); ?>
                                </p>
                            </div>

                            <div class="login-help">
                                <p>Forgot your password? <a href="index.html">Click here to reset it</a>.</p>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>