
<!DOCTYPE html>

<html>
<head>

    <title></title>
    <meta name="description" content="">

    <!-- Mobile viewport optimized -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('/bootstrap/css/bootstrap.min');
    echo $this->Html->css('/includes/css/styles');
    echo $this->Html->css('/includes/css/styles2');
    echo $this->Html->css('/includes/css/bootstrap-glyphicons');
    echo $this->Html->script('/includes/js/modernizr-2.6.2.min');
    echo $this->Html->script('/includes/js/jquery-1.8.2.min');
    echo $this->Html->script('/bootstrap/js/bootstrap.min');
    echo $this->Html->script('secondhanded');
    ?>
    <style>


    </style>

</head>
<body>
<div class="container" id="main">

    <div class="navbar navbar-fixed-top" id="bg" >

        <div class="container" >

            <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <button class="navbar-toggle" data-target=".navbar-responsive-collapse" data-toggle="collapse" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="/">
                <?php echo $this->Html->image("images/logo.png", array('alt'=>'Image Failed')); ?>
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
                    'label' => false,
                ));

                echo $this->fetch('searchOptions');

                //apparently buttons take only ONE PARAMETER
                //still cannot figure out how to change label on button.
                //if replace array by single string it works, but value index doesnt...
               echo $this->Form->end(array(
                    'class' => 'btn btn-default glyphicon glyphicon-search',
                    'id' => 'searchBtn',
                    'placeholder' => 'Search listings',
                    'label' => false,
                ));
                ?>

            </div><!-- end nav-collapse -->



            <?php echo $this->element('userBar', array('user' => 0)); ?>
        </div><!-- end container -->

    </div><!-- end navbar-->

    <div class="carousel slide" id="myCarousel">

        <!-- indicators -->

        <ol class="carousel-indicators">
            <li class="active" data-slide-to="0" data-target="#myCarousel"></li>
            <li data-slide-to="1" data-target="#myCarousel"></li>
            <li data-slide-to="2" data-target="#myCarousel"></li>
        </ol>

        <!-- wrapper for slides -->
        <div class="carousel-inner">

            <div class="item active" id="slide1">
                    <?php //echo $this->Html->image("carousel_medium_01.png", array('alt'=>'Image Failed',  'width' => '100%', 'height' => '100%')); ?>
            </div><!-- end item -->

            <div class="item" id="slide2">
                <div class="carousel-caption">
                    <h4></h4>
                    <p></p>
                </div><!-- end carousel-caption-->
            </div><!-- end item -->

            <div class="item" id="slide3">
                <div class="carousel-caption">
                    <h4></h4>
                    <p></p>
                </div><!-- end carousel-caption-->
            </div><!-- end item -->

        </div> <!-- end carousel-inner -->

        <!-- controls -->

        <a class="left carousel-control" data-slide="prev" href="#myCarousel"><span class="icon-prev"></span></a>
        <a class="right carousel-control" data-slide="next" href="#myCarousel"><span class="icon-next"></span></a>

    </div> <!-- end Carousel -->

    <br/>

    <div class="row" id="features">
        <div class="col-sm-4 feature">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">COMPUTER TECHNOLOGY</h3>
                </div> <!-- end panel-heading -->

                <?php echo $this->Html->image("computer-technology.jpg", array('alt'=>'Image Failed', 'class' => 'layout_category')); ?>
                <a href="" target="_blank" class="btn btn-warning btn-block">Select Orange</a>
            </div> <!-- end panel -->
        </div> <!--end feature -->

        <div class="col-sm-4 feature">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">ARCHITECTURE</h3>
                </div> <!-- end panel-heading -->

                <?php echo $this->Html->image("architecture.jpg", array('alt'=>'Image Failed', 'class' => 'layout_category')); ?>
                <a href="" target="_blank" class="btn btn-success btn-block">Select Purple</a>
            </div> <!-- end panel -->
        </div> <!--end feature -->

        <div class="col-sm-4 feature">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">CONSTRUCTION MANAGEMENT</h3>
                </div> <!-- end panel-heading -->

                <?php echo $this->Html->image("construction.jpg", array('alt'=>'Image Failed', 'class' => 'layout_category')); ?>
                <a href="" target="_blank" class="btn btn-Danger btn-block">Select Yellow</a>
            </div> <!-- end panel -->
        </div> <!--end feature -->
    </div> <!-- end features -->


    <div class="row" id="moreInfo">

    </div> <!-- end moreInfor -->


</div> <!--End Container -->


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

</body>
</html>