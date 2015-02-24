<div class="container">
    <div class="headerList">
        <h3>My Listings</h3>
    </div>
    <div class="row" pull-right>

                <?php
                echo $this->element('itemThumb', array(
                    "items" => $user['MyItem'],
                    "emptyMessage"=> 'Add an item to your Watchlist!'
                ));
                ?>
    </div>
</div>

<div class="container">
    <div class="headerList">
        <h3>Add  / Edit Item</h3>
    </div>
    <div class="col-lg-6">
        <?php
        echo $this->Form->create('Item', array(
            'type' => 'file',
            'class' => 'new_item_form',
            'inputDefaults' => array(
                'class' => 'form-control',
                'div' => array(
                    'class' => 'form-group'
                )
        )
        ));
        echo $this->Form->input('title', array(

        ));


        echo $this->Form->input('author', array(

        ));
        echo $this->Form->input('isbn', array(

        ));
        echo $this->Form->input('course', array(

        ));
        //THESE OPTIONS NEED TO BE EXPORTED TO A TABLE TO ADD/REMOVE
        echo $this->Form->input('field', array(
            'options' => array('Computer Technology','Architecture','Fashion Design','Construction & engineering','Dance'),
            'empty' => '(choose one)',

        ));
        echo $this->Form->input('price', array(
            'type' => 'number',

        ));
        echo $this->Form->input('description',  array(
            'type' => 'textarea',
            'escape' => false,

        ));
        echo $this->Form->input('condition', array(
            'options' => array(
                'Mint' => 'Mint',
                'Great' => 'Great',
                'OK' => 'OK',
                'Rough' => 'Rough',
                'Not Pretty' => 'Not Pretty'),
            'empty' => '(choose one)'
        ));
        echo $this->Form->input('semester',  array(
            'options' => array(1,2,3,4,5,6,7,8),
            'empty' => '(choose one)'
        ));
        echo $this->Form->button('Add Item', array('type' => 'submit'));

        //automatically gets users from "$users" variable somehow
        //(not needed anymore since the logged in user will supply user_id)
        //echo $this->Form->input('Item.User', array('multiple' => 'checkbox'));
         ?>
    </div>
    <?php
        echo '<div id="upload" class="col-sm-3 listImage">';
        echo $this->element('image', array(
        'id' => 'preview_img'
        ));

        echo $this->Form->input('Image', array(
        'type' => 'file',
        'onchange' => 'readURL(this);'
        ));

        echo '</div>';

        //no button if parameters empty
        echo $this->Form->end();
    ?>

</div>