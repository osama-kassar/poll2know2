<?php
$mdl = empty($mdl) ? $this->request->getParam('controller') : $mdl;
$action = empty($action) ? $this->request->getParam('action') : $action;
$link = empty($link) ? '' : $link;
$onlyIcons = empty($onlyIcons) ? false : $onlyIcons;
$img = empty($img) ? '' : $img;

if(empty($obj)){ return; }

if($mdl == 'Polls'){
    $photoUrl = $this->request->getParam('webroot').'img/'.strtolower($mdl).'_photos/'.$obj->seo_image;
    $url = $this->Url->build(["action" => "view", $obj->slug]);
    $rec = json_encode(["title"=>$obj->poll_title, "desc"=>$obj->poll_text, "photo"=>$photoUrl, "tags"=>$obj->seo_keywords, "url"=>$url],JSON_UNESCAPED_UNICODE);
}
if($mdl == 'Exams'){
    $photoUrl = $this->request->getParam('webroot').'img/'.strtolower($mdl).'_photos/'.$obj->seo_image;
    $url = $this->Url->build(["action" => "view", $obj->slug]);
    $rec = json_encode(["title"=>$obj->exam_title, "desc"=>$obj->exam_desc, "photo"=>$photoUrl, "tags"=>$obj->seo_keywords, "url"=>$url],JSON_UNESCAPED_UNICODE);
}
if($mdl == 'Scores' && $action == 'view'){
    $photoUrl = $this->request->getParam('webroot').'img/'.strtolower($mdl).'_photos/'.$obj->score_photo;
    $url = $this->Url->build(["action" => "view", $obj->id]);
    $rec = json_encode(["title"=>$obj->result->result_name, "desc"=>$obj->result->result_text, "photo"=>$photoUrl, "tags"=>$obj->exam->seo_keywords, "url"=>$url],JSON_UNESCAPED_UNICODE);
}
if($mdl == 'Scores' && $action == 'game'){
    $photoUrl = $this->request->getParam('webroot').'img/exams_photos/'.$obj->exam->seo_image;
    $url = $this->Url->build(["action" => "view", $obj->slug, "id"=>$obj->id]);
    $rec = json_encode(["title"=>$obj->user_name.' '.__('want_play_with_you'), "desc"=>$obj->exam->exam_desc, "photo"=>$photoUrl, "tags"=>$obj->exam->seo_keywords, "url"=>$url],JSON_UNESCAPED_UNICODE);
}
if($mdl == 'Matches'){
    $photoUrl = $this->request->getParam('webroot').'img/exams_photos/'.$obj->exam->seo_image;
    $url = $this->Url->build(["action" => "view", $obj->slug, "id"=>$obj->id]);
    $rec = json_encode(["title"=>$obj->score1->user_name.' '.__('want_play_with_you').': '.$obj->exam->exam_title, "desc"=>$obj->exam->exam_desc, "photo"=>$photoUrl, "tags"=>$obj->exam->seo_keywords, "url"=>$url],JSON_UNESCAPED_UNICODE);
}
if($mdl == 'Competitions'){
    $photoUrl = $this->request->getParam('webroot').'img/'.strtolower($mdl).'_photos/'.$obj->seo_image;
    $url = $this->Url->build(["action" => "view", $obj->id]);
    $rec = json_encode(["title"=>$exam->exam_title, "desc"=>__("result_competition_in")." ".$exam->exam_desc, "photo"=>$photoUrl, "tags"=>$exam->seo_keywords, "url"=>$url], JSON_UNESCAPED_UNICODE);
}
?>

<?php 
    if(!empty($img)){
        echo $this->Html->image($img, ["style"=>"width:100%"]);
    }
?>
<div class="shareBar <?=$onlyIcons ? 'bigFont' : ''?>" ng-init="link = '<?=$link?>'">
    <?php if(!$onlyIcons){?>
        <h4><i class="fa fa-share-alt"></i> <?=__($link == '' ? 'shareit' : 'share_the_link')?></h4>
    <?php }?>
    <a href="javascript:void(0);" id="whatsapp_share_btn"
       data-toggle="tooltip" title="" data-original-title="<?=__('whatsapp')?>"
        onclick="openWin('whatsapp');"
        ng-click="link=='' ? callAction('/sharecounter?id=<?=$obj->id?>&mdl=<?=$mdl?>') : ''; ">
        <i class="fab fa-whatsapp"></i>
    </a>
    <a href="javascript:void(0);" id="facebook_share_btn"
       data-toggle="tooltip" title="" data-original-title="<?=__('facebook')?>"
        onclick="openWin('facebook');"
        ng-click="link=='' ? callAction('/sharecounter?id=<?=$obj->id?>&mdl=<?=$mdl?>') : ''; ">
        <i class="fab fa-facebook"></i>
    </a>
    <a href="javascript:void(0);" id="twitter_share_btn"
       data-toggle="tooltip" title="" data-original-title="<?=__('twitter')?>"
        onclick="openWin('twitter');" 
        ng-click="link=='' ? callAction('/sharecounter?id=<?=$obj->id?>&mdl=<?=$mdl?>') : ''; ">
        <i class="fab fa-twitter"></i>
    </a>
    <a href="javascript:void(0);" id="linkedin_share_btn"
       data-toggle="tooltip" title="" data-original-title="<?=__('linkedin')?>"
        onclick="openWin('linkedin');" 
        ng-click="link=='' ? callAction('/sharecounter?id=<?=$obj->id?>&mdl=<?=$mdl?>') : ''; ">
        <i class="fab fa-linkedin"></i>
    </a>
    <a href="javascript:void(0);" id="pinterest_share_btn"
       data-toggle="tooltip" title="" data-original-title="<?=__('pinterest')?>"
        onclick="openWin('pinterest');"
        ng-click="link=='' ? callAction('/sharecounter?id=<?=$obj->id?>&mdl=<?=$mdl?>') : ''; ">
        <i class="fab fa-pinterest"></i>
    </a>
    <a href="javascript:void(0);" id="email_share_btn"
       data-toggle="tooltip" title="" data-original-title="<?=__('email')?>"
        onclick="openWin('email');"
        ng-click="link=='' ? callAction('/sharecounter?id=<?=$obj->id?>&mdl=<?=$mdl?>') : ''; ">
        <i class="fa fa-envelope"></i>
    </a>
<?php if($link == '' && !$onlyIcons){?>
    <small><?=__('shared')?>: <?=$obj->stat_shares==null?0:$obj->stat_shares?></small>
<?php }?>
</div>
<script>
    function _setShare(tar){//obj = title, desc, photo, tags, url
        var obj = JSON.parse('<?=addslashes($rec)?>');
        var _Url = '<?=$link?>' == '' ? document.URL : encodeURI('<?=$link?>');
        var isMobile ='<?=!$this->request->is('mobile') ? 0 : 1?>';
        var hashTags = obj.tags.replace(/\s/g, '_');
        var title = obj.title;
        var p = obj.desc;
        var imgPath = obj.photo
        var url='';
        // console.log(obj)
        if(tar=='whatsapp' && isMobile == 1){url='whatsapp://send?text='+title+' \n '+encodeURI(_Url)}
        if(tar=='whatsapp' && isMobile == 0){url='https://api.whatsapp.com/send?text='+title+' \n '+encodeURI(_Url)}
        if(tar=='facebook'){url='https://www.facebook.com/sharer/sharer.php?u='+_Url}
        if(tar=='twitter'){url='https://twitter.com/intent/tweet?text='+title+'&url='+encodeURI(_Url)+'&hashtags='+hashTags}
        
        if(tar=='linkedin'){url='https://www.linkedin.com/shareArticle?mini=true&url='+encodeURI(_Url)+'&title='+title+'&summary='+encodeURI(p)+'&source=https://poll2know.com'}
        
        if(tar=='pinterest'){url='https://pinterest.com/pin/create/button/?url='+encodeURIComponent(_Url)+'&image_url='+encodeURIComponent(imgPath)+'&description='+encodeURIComponent(p)}
        if(tar=='email'){url='mailto:email?subject='+obj.title+'&body=<?=__('checklink').'\n\n\r\r   '?>'+(_Url) }
//        console.log("url", url)
        return url
    }

    function openWin(tar){
        var urlTar = _setShare(tar);
        var conf = "directories=no, menubar=no, status=no, location=no, titlebar=no, toolbar=no, scrollbars=no, width=700, height=400, resizeable=no, top=150, left=250";
        var popup=window.open(urlTar, '_blank', conf); //'http://localhost/poll2know/pages/sharer'
        //var dom = popup.document.body;
    }
</script>