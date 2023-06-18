<?php
    $baseUrl = "https://poll2know.com";
    $langs = $this->Do->get('langs');
?>
<div style="direction: ltr">
<table class="table table-responsive">
    
    <?php // EXAMS ?>
    <?php foreach($exams as $link){ ?>
        <tr>
            <td><?= $baseUrl.'/'.$langs[$link->language_id].'/'.(($link->slug)) ?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    <?php }; ?>
    
    
    <?php // POLLS ?>
    <?php foreach($polls as $link){ ?>
        <tr>
            <td><?= $baseUrl.'/'.$langs[$link->language_id].'/'.(($link->slug)) ?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    <?php }; ?>
    
    
    <?php // CATEGORIES -> SEARCH ?>
    <?php foreach($cats_ar as $link){ 
            if($link["exams_count"] > 0 || $link["polls_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/ar/search/'.$link['id'].'/'.((__($link['category_name'])))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
        <?php }?>
        <?php if($link["polls_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/ar/polls/0/'.$link['id'].'/'.((__($link['category_name'])))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
        <?php }?>
        <?php if($link["exams_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/ar/exams/0/'.$link['id'].'/'.((__($link['category_name'])))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
        <?php }?>
    
    <?php } ?>
    
    
    <?php foreach($cats_tr as $link){ 
            if($link["exams_count"] > 0 || $link["polls_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/tr/search/'.$link['id'].'/'.((__($link['category_name'])))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
        <?php }?>
        <?php if($link["polls_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/tr/polls/0/'.$link['id'].'/'.((__($link['category_name'])))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
        <?php }?>
        <?php if($link["exams_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/tr/exams/0/'.$link['id'].'/'.((__($link['category_name'])))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
        <?php }?>
    
    <?php } ?>
    
    
    <?php foreach($cats_en as $link){ 
            if($link["exams_count"] > 0 || $link["polls_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/en/search/'.$link['id'].'/'.((__($link['category_name'])))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
        <?php }?>
        <?php if($link["polls_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/en/polls/0/'.$link['id'].'/'.((__($link['category_name'])))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
        <?php }?>
        <?php if($link["exams_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/en/exams/0/'.$link['id'].'/'.((__($link['category_name'])))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
        <?php }?>
    
    <?php } ?>
    
    
    <?php // TAGS ?>
    <?php foreach($tags_ar as $link){ 
            if($link["exams_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/ar/exams/0/'.(($link['tag']))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
    <?php } elseif($link["polls_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/ar/polls/0/'.(($link['tag']))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
    <?php }
        }?>
    
    
    <?php foreach($tags_tr as $link){ 
            if($link["exams_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/tr/exams/0/'.(($link['tag']))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
    <?php } elseif($link["polls_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/tr/polls/0/'.(($link['tag']))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
    <?php }
        }?>
    
    
    <?php foreach($tags_en as $link){ 
            if($link["exams_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/en/exams/0/'.(($link['tag']))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
    <?php } elseif($link["polls_count"] > 0){ ?>
    
        <tr>
            <td><?= $baseUrl.'/en/polls/0/'.(($link['tag']))?></td>
            <td><?= date('Y-m-d') ?></td>
        </tr>
    
    <?php }
        }?>
    
</table>
</div>