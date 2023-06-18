<?php
//$content = explode("\n", $content);
echo '<h1>'. __("contact_info") .'</h1>';
foreach ($content as $k=>$line) {
    if(is_array($line)) { 
        echo '<h2>'.__($k).'</h2>';
        foreach ($line as $subk=>$subline) {
            echo '<blockqoute><p><b>'.__($subk).'</b>: '  . $subline . "</p><blockqoute>";
        }
    }
    echo '<p><b>'.__($k).'</b>: ' . $line . "</p>";
};
