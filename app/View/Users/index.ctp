<?php

foreach ($users as $user){

echo "<h2>".$user['User']['name']."</h2>";
//echo "<h3>".$user['User']['email']."</h3>";

    foreach($user['MyItem'] as $item)
    {
        echo "<h1>".$item['title']."</h1>";
    }

echo "<h3>WatchItems</h3>";
    foreach($user['WatchItem'] as $item)
    {
        echo "<h1>".$item['title']."</h1>";
    }
}

