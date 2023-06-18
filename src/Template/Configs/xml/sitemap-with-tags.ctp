<?php
    $baseUrl = "https://poll2know.com";
    $langs = $this->Do->get('langs');
    $lng = $this->request->getParam("lang");
//debug($lng);
//debug($currlang);die();
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <?php // EXAMS ?>
    <?php foreach($exams as $link){ 
            if(!$lng || $currlang == $langs[$link->language_id] ){
    ?>
        <url>
            <loc><?= $baseUrl.'/'.$langs[$link->language_id].'/exam/'.htmlentities(urlencode($link->slug)) ?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    <?php   }
        }; ?>
    
    
    <?php // POLLS ?>
    <?php foreach($polls as $link){ 
            if(!$lng || $currlang == $langs[$link->language_id] ){
    ?>
        <url>
            <loc><?= $baseUrl.'/'.$langs[$link->language_id].'/poll/'.htmlentities(urlencode($link->slug)) ?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    <?php   }
        }; ?>
    
    
    <?php // CATEGORIES -> SEARCH ?>
    <?php 
        if($lng == 'ar' || !$lng){
            foreach($cats_ar as $link){ 
                /*if($link["exams_count"] > 0 || $link["polls_count"] > 0){ ?>
    
        <url>
            <loc><?= $baseUrl.'/ar/search/'.$link['id'].'/'.htmlentities(urlencode(__($link['category_name'])))?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    
            <?php }*/?>
            <?php if($link["polls_count"] > 0){ ?>
    
        <url>
            <loc><?= $baseUrl.'/ar/polls/0/'.$link['id'].'/'.htmlentities(urlencode(__($link['category_name'])))?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    
            <?php }?>
            <?php if($link["exams_count"] > 0){ ?>
    
        <url>
            <loc><?= $baseUrl.'/ar/exams/0/'.$link['id'].'/'.htmlentities(urlencode(__($link['category_name'])))?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    
            <?php } ?>
        <?php } ?>
    <?php } ?>
    
    
    <?php 
        if($lng == 'tr' || !$lng){
            foreach($cats_tr as $link){ 
            /*if($link["exams_count"] > 0 || $link["polls_count"] > 0){ ?>
    
        <url>
            <loc><?= $baseUrl.'/tr/search/'.$link['id'].'/'.htmlentities(urlencode(__($link['category_name'])))?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    
            <?php }*/?>
            <?php if($link["polls_count"] > 0){ ?>
    
        <url>
            <loc><?= $baseUrl.'/tr/polls/0/'.$link['id'].'/'.htmlentities(urlencode(__($link['category_name'])))?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    
            <?php }?>
            <?php if($link["exams_count"] > 0){ ?>
    
        <url>
            <loc><?= $baseUrl.'/tr/exams/0/'.$link['id'].'/'.htmlentities(urlencode(__($link['category_name'])))?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    
            <?php }?>
        <?php }?>
    <?php } ?>
    
    
    <?php 
        if($lng == 'en' || !$lng){
            foreach($cats_en as $link){ 
            /*if($link["exams_count"] > 0 || $link["polls_count"] > 0){ ?>
    
        <url>
            <loc><?= $baseUrl.'/en/search/'.$link['id'].'/'.htmlentities(urlencode(__($link['category_name'])))?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    
            <?php }*/?>
            <?php if($link["polls_count"] > 0){ ?>
    
        <url>
            <loc><?= $baseUrl.'/en/polls/0/'.$link['id'].'/'.htmlentities(urlencode(__($link['category_name'])))?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    
            <?php }?>
            <?php if($link["exams_count"] > 0){ ?>
    
        <url>
            <loc><?= $baseUrl.'/en/exams/0/'.$link['id'].'/'.htmlentities(urlencode(__($link['category_name'])))?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    
            <?php }?>
        <?php }?>
    <?php } ?>
    
    
</urlset>