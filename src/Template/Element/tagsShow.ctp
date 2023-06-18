

<div class="pro-tags">
    <?php 
    foreach(explode(",", $tags) as $tag){
        if(@$type == "nolink"){
            echo '<div class="pro-tag bg-info"> #'.str_replace(" ", "_", $tag).' </div>';
        }else{
            echo $this->Html->link('<div class="pro-tag bg-info"> <i class="fas fa-tag"></i> '.$tag.' </div>', 
             ["controller"=>"Categories", "action"=>"index", $tag, '0'], 
             ["escape"=>false]);
        }
    }
    ?>
</div>
