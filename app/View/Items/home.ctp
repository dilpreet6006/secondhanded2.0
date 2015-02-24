
<div class="row" id="bigCallout">

    <div class="col-sm-12">
        <div id="banner">
            <?php echo $this->Html->image("images/Banner1.png",
                array('alt' => 'image failed',
                    "class" => "img-responsive, img-rounded"
                ));?>
        </div>
    </div> <!--end col-12 -->
</div> <!-- end bigCallout -->
<!--End of First Tab -->

<!-- WATCHING LIST -->
<div class="homeItemsRow">
    <div class="container" id="thumbs">
        <div class="row">
            <div class="col-sm-9">
                <h3>Watching</h3>
            </div>
        </div> <!-- End Row -->

        <!-- ITEM DIV MAKER -->
        <div class="row" pull-right>
            <?php
            echo $this->element('itemThumb', array(
                "items" => $user['WatchItem'],
                "emptyMessage"=> 'Add an item!'
            ));
            ?>
        </div>
    </div>
</div>
<!-- WATCHING LIST -->
<div class="homeItemsRow">
    <div class="container" id="thumbs">
        <div class="row">
            <div class="col-sm-9">
                <h3>MyItems</h3>
            </div>
        </div> <!-- End Row -->

        <!-- ITEM DIV MAKER -->
        <div class="row" pull-right>
            <?php
            echo $this->element('itemThumb', array(
                "items" => $user['MyItem'],
                "emptyMessage"=> 'Post a new item!'
            ));
            ?>
        </div>
    </div>
</div>



<?php /*
foreach ($items as $item){
    echo "<h2>".$item['Item']['title']."</h2>";
    echo "<h3>".$item['Owner']['name']."</h3>";
    //image  paths must include only the folder after img. so that instead of img/files/x.png, it is files/x.png
    // if no image, use default
    if($item['Item']['img_url']) {
        echo $this->Html->image($item['Item']['img_url'], array(
            "alt" => "Image Failed",
            'url' => array(
             //   'controller' => 'items', 'action' => 'view', 6
                '#'
            )
        ));
    }else echo $this->Html->image("default.png", array('alt' => 'image failed', 'class' => 'item_image'));

    foreach($item['Watcher'] as $user)
    {
        echo "<h1>".$user['name']."</h1>";
    }
}
 */