
<?php
//give layout the search options menu
//get menu from searchOptions component which is given values to display,
//values gotten from previous submission or user object
$this->assign('searchOptions', $this->element('itemSearchOptions', array(
        "user" => $user,
        'searchString' => (isset($searchString))? $searchString : null
   // "emptyMessage"=> 'Post a new item!'
)));
?>

<?php echo $this->fetch('searchOptions'); ?>

<div class="homeItemsRow">
    <div class="container" id="thumbs">


        <!-- ITEM DIV MAKER -->
        <div class="row" >
            <?php
            echo $this->element('itemSearchResults', array(
                "items" => $results,
                "emptyMessage"=> 'Post a new item!'
            ));
            ?>
        </div>
    </div>
</div>
