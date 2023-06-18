<?php
    $baseUrl = "https://poll2know.com";
    $langs = $this->Do->get('langs');
    $lng = '';
    $appf = $this->Do->get('app_folder');
    $url_lng = explode("/", str_replace($appf, '', $_SERVER['REQUEST_URI']));
    if(in_array($url_lng[1], $langs)){
        $lng = $url_lng[1];
    }
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <?php // EXAMS ?>
    <?php foreach($exams as $link){ 
            if(empty($lng) || $lng == $langs[$link->language_id] ){
    ?>
        <url>
            <loc><?= $baseUrl.'/'.$langs[$link->language_id].'/exam/'.htmlentities(urlencode($link->slug)) ?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    <?php   }
        }; ?>
    
    
    <?php // POLLS ?>
    <?php foreach($polls as $link){ 
            if(empty($lng) || $lng == $langs[$link->language_id] ){
    ?>
        <url>
            <loc><?= $baseUrl.'/'.$langs[$link->language_id].'/poll/'.htmlentities(urlencode($link->slug)) ?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    <?php   }
        }; ?>
    
    
    <?php // CATEGORIES -> SEARCH ?>
    <?php 
        if(empty($lng) || $lng == 'ar'){
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
        if(empty($lng) || $lng == 'tr'){
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
        if(empty($lng) || $lng == 'en'){
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
    
    <?php if($lng){?>
        <url>
            <loc><?=$baseUrl?>/<?=$lng?>/exams</loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
        <url>
            <loc><?=$baseUrl?>/<?=$lng?>/polls</loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
        <url>
            <loc><?=$baseUrl?>/<?=$lng?>/pages/privacy-policy</loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    
        <url>
            <loc><?=$baseUrl?>/<?=$lng?>/pages/terms-of-use</loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    
        <url>
            <loc><?=$baseUrl?>/<?=$lng?>/pages/about-us</loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
        </url>
    <?php }?>
    
</urlset>