
<!DOCTYPE html>
<html lang="<?=$currlang?>" dir="<?=$currlang=='ar' ? 'rtl' : 'ltr'?>">
    <head>
        
    <?php // SCRIPTS in HEADER ?>
    <?php if(!$isLocal){?>
        
        <?php // foremedia.net ads ?>
        <script>
            // window.addEventListener('DOMContentLoaded', function () {
            //     var script = document.createElement('script');
            //     script.src = 'https://platform.foremedia.net/code/15428/analytics';
            //     script.type = 'text/javascript';
            //     script.setAttribute('async', '');
            //     document.getElementsByTagName('head')[0].appendChild(script)
            // });
        </script>

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-K8GQTZ1T0G"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-K8GQTZ1T0G');
        </script>
        <!-- End Google tag (gtag.js) -->
        
        <!-- Google Adsense -->
        <script data-ad-client="ca-pub-8020871962555557" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- End Google Adsense -->
        
        <!-- Hotjar Tracking Code for https://poll2know.com -->
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:3177220,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>

    <?php }?>
        
        
        
    <?= $this->Html->charset() ?>
    
    <title>
        <?= __('sitename') ?> - <?= __($this->fetch('title')) ?> 
    </title>
        
        
    <script type="application/ld+json">
    
    {
      "@context": "https://schema.org",
      "@type": "NewsArticle",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?=$mainDt['server_url']?><?=urldecode( $mainDt['current_url'] )?>"
      },
      "headline": "<?=__($this->fetch('title'))?>",
      "image": [
        "<?=$mainDt['server_url']?><?=$metaDt['_photo']?>"
      ],
      "datePublished": "<?=$metaDt['_created']?>",
      "dateModified": "<?=$metaDt['_modified']?>",
      "author": {
        "@type": "Person",
        "name": "Osama Kassar"
      },
      "publisher": {
        "@type": "Organization",
        "name": "Dev Zonia",
        "logo": {
          "@type": "ImageObject",
          "url": "https://devzonia.com/Library/img/logo.svg"
        }
      }
    }
    </script>

    <?= $this->Html->meta('icon') ?>
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
        
    <?php
        $url_params = str_replace($app_folder, "",  $_SERVER["REQUEST_URI"] );
        $url_params =  $url_params == '/' ? '' : str_replace("/".$currlang."/", "", $url_params );
    ?>
    <link rel="canonical" href="https://poll2know.com/<?=$currlang.'/'.$url_params?>" />
        
    <?php // Meta Tags ?>
    <meta name="yandex-verification" content="3b51f14bd8b2b0f5" />
    <meta name="google-site-verification" content="6GpL8eaZQTeI60nFvqgMxnLu9-fdVbXUw5WXbvBLUso" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="encoding" content="utf-8">
    <meta http-equiv="Cache-control" content="public" />
    <meta http-equiv="Cache-control" content="max-atge=120 ETag: x234dff" />
    <meta http-equiv="Cache-control" content="max-age=31557600" />



    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />

    <?php // Meta SEO ?>
    <meta name="generator" content="<?=__('sitename')?> <?=__( $metaDt['_title'] )?>" />
    <meta name="keywords" content="<?=__( $metaDt['_keywords' ] )?>" />
    <meta name="description" content="<?=__( $metaDt['_description'] )?>" />
    <meta name="author" content="DevZonia" />
    <meta name="date" content="Jul. 10, 2019" />

    <?php // Meta Open Graph ?> 
    <meta property="og:title" content="<?=__( $mainDt['site_main_title'] )?> <?=__( $metaDt['_title'] )?>" />
    <meta property="og:url" content="<?=$mainDt["server_url"].urldecode( $mainDt['current_url'] )?>" />
    <meta property="og:description" content="<?=__( $metaDt['_description'] )?>" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="<?=$mainDt['server_url']?><?=$metaDt['_photo']?>" />
    <meta property="og:locale" content="<?=$currlang.'_'.strtoupper($currlang)?>" />
        
    <?php // Meta tags ?>
    <?php $tags = explode(",",$metaDt['_keywords' ]);
      foreach($tags as $tag){?>
            <meta property="article:tag" content="<?=$tag?>" />
    <?php }?>
    
    <?php // Twitter Meta tags ?>
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="<?=__( $metaDt['_description'] )?>" />
    <meta name="twitter:title" content="<?=__( $metaDt['_title'] )?>" />
    <meta name="twitter:image" content="<?=$mainDt['server_url']?><?=$metaDt['_photo']?>" />
        
        <META NAME="robots" CONTENT="INDEX, FOLLOW" />
        
<?php 
    
    $fontsInit = '<link rel="preload" href="'.$path.'/fonts/ArbFONTS-Droid-Sans-Arabic.ttf" as="font">';
    $fontsInit .= '
        <style>
            @font-face {
              font-family: "Jannat";
              src: url("'.$path.'/fonts/ArbFONTS-Droid-Sans-Arabic.ttf");
            }
        </style>';
    $fontsInit .= '<link rel="preload" href="'.$path.'/webfonts/fa-solid-900.woff2" as="font">';
        
    $fontsInit .= '
        <style>
            @font-face{font-family:"Font Awesome 5 Free";font-style:normal;font-weight:900;font-display:auto;src:url('.$path.'/webfonts/fa-solid-900.eot);src:url('.$path.'/webfonts/fa-solid-900.eot?#iefix) format("embedded-opentype"),url('.$path.'/webfonts/fa-solid-900.woff2) format("woff2"),url('.$path.'/webfonts/fa-solid-900.woff) format("woff"),url('.$path.'/webfonts/fa-solid-900.ttf) format("truetype"),url('.$path.'/webfonts/fa-solid-900.svg#fontawesome) format("svg")}.fa,.far,.fas{font-family:"Font Awesome 5 Free"}
        </style>';
        
    $fontsInit .= '<link rel="preload" href="'.$path.'/webfonts/fa-brands-400.woff2" as="font">';
    $fontsInit .= '
        <style>
            @font-face{font-family:"Font Awesome 5 Brands";font-style:normal;font-weight:normal;font-display:auto;src:url('.$path.'/webfonts/fa-brands-400.eot);src:url('.$path.'/webfonts/fa-brands-400.eot?#iefix) format("embedded-opentype"),url('.$path.'/webfonts/fa-brands-400.woff2) format("woff2"),url('.$path.'/webfonts/fa-brands-400.woff) format("woff"),url('.$path.'/webfonts/fa-brands-400.ttf) format("truetype"),url('.$path.'/webfonts/fa-brands-400.svg#fontawesome) format("svg")}.fab{font-family:"Font Awesome 5 Brands"}
        </style>';
        
    $fontsInit .= '<link rel="preload" href="'.$path.'/webfonts/fa-regular-400.woff2" as="font">';
    $fontsInit .=
        '<style>
            @font-face{font-family:"Font Awesome 5 Free";font-style:normal;font-weight:400;font-display:auto;src:url('.$path.'/webfonts/fa-regular-400.eot);src:url('.$path.'/webfonts/fa-regular-400.eot?#iefix) format("embedded-opentype"),url('.$path.'/webfonts/fa-regular-400.woff2) format("woff2"),url('.$path.'/webfonts/fa-regular-400.woff) format("woff"),url('.$path.'/webfonts/fa-regular-400.ttf) format("truetype"),url('.$path.'/webfonts/fa-regular-400.svg#fontawesome) format("svg")}.far{font-weight:400}
        </style>';
    
    
    if($isLocal){
        //<!--  Style files  -->
        echo $fontsInit;
        echo $this->Html->css('yellow.min'); 
        echo $this->Html->css('fa-all.min'); 
        //echo $this->Html->css('bootstrap-tagsinput');
        // ** echo $this->Html->css('ng-tags-input.min');
        // ** echo $this->Html->css('ng-tags-input.bootstrap.min');
        // echo $this->Html->css('animate.min');
        echo $this->Html->css('easySelect.min');
        echo $this->Html->css('custom');
    	
        //<!-- JavaScript files -->
        echo $this->Html->script('jquery-1.12.3.min');
        echo $this->Html->script('angular.min');
        echo $this->Html->script('angular-animate.min');
        echo $this->Html->script('angular-sanitize.min');
        //echo $this->Html->script('bootstrap-tagsinput.min');
        // ** echo $this->Html->script('ng-tags-input.min');
        echo $this->Html->script('easySelect');
        echo $this->Html->script('myfunc');
        echo $this->Html->script('scripts');
    }else{
        
        echo $fontsInit;
        
        echo '<link rel="preload" href="'.$path.'/webfonts/fa-brands-400.woff2" as="font">';
        echo '<link rel="preload" href="'.$path.'/webfonts/fa-solid-900.woff2" as="font">';
        echo '<link rel="preload" href="'.$path.'/css/all.css" as="style">';
        echo '<link rel="preload" href="'.$path.'/js/all.js" as="script">';
        
        echo $this->Html->css('all');
        echo $this->Html->script('all', ['async'=>'']);
    }
    echo $currlang != 'ar' ? $this->Html->css('custom-ltr') : ''; 
        
    $isChart = 0;
    if(strpos($_SERVER['REQUEST_URI'], '/poll/') !== false || 
       strpos($_SERVER['REQUEST_URI'], '/matches/') !== false){
        echo $this->Html->script('ng-google-chart.min'); 
        $isChart = 1;
    }
    
    if($authUser != null){
        echo $this->Html->script('/gentela/vendors/ckeditor4.13.0/ckeditor');
        echo $this->Html->script('/gentela/vendors/ckeditor4.13.0/angular-ckeditor');
    }
    
    if($this->request->getParam('controller') == 'Firms'){
        echo $this->Html->css("mapbox-gl");
        echo $this->Html->css("mapbox-gl-geocoder");
        echo $this->Html->script("mapbox-gl");
        echo $this->Html->script("mapbox-gl-geocoder.min");
    }
    
?>

</head>

<body class="<?=$currlang == 'ar' ? 'bodyrtl' : ''?>">
    <div ng-app="poll2know" ng-controller="ctrl as ctrl">


        <?php // SCRIPTS in BODY ?>
        <?php if(!$isLocal){?>
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N6PLRNB"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
        <?php }?>


        
        <div class="se-pre-con"></div>

        <?php // image for whatsapp ?>
        <link itemprop="thumbnailUrl" href="<?=$mainDt['server_url']?><?=$metaDt['_photo']?>">
        <span itemprop="thumbnail" itemscope itemtype="http://schema.org/ImageObject">
            <link itemprop="url" href="<?=$mainDt['server_url']?><?=$metaDt['_photo']?>">
        </span>

        
        
        
        
        <div> <?=$this->element('header');?> </div>
        <div> <?= $this->fetch('content');?> </div>
        <div> <?=$this->element('footer');?> </div>
        
        
        
        
        
        <div> <?=$this->element('modal');?> </div>

        <div id="msgHolder" onClick="this.setAttribute('style', 'opacity:0; visibility:hidden;')">
            <div class="{{msgColor}}">
                <span><i class="fa fa-times"></i></span>
                <figure>
                    <div>{{modalMsg}}</div>
                    <i style="color: red;">{{modalError}}</i>
                </figure>
            </div>
        </div>
            
        <div id="imgHolder" onClick="this.setAttribute('style', 'opacity:0; visibility:hidden;')"></div>
            
        <div id="flash"></div>
        <?= $this->Flash->render() ?>
    </div>
<!-- ANGULARJS APP -->
<script>
    
(function() {
    var ptrn=[];
        ptrn['isEmail'] 		= /^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,7}$/;
        ptrn['isNumber'] 		= /^[0-9]$/;
        ptrn['isInteger'] 		= /^[\s\d]$/;
        ptrn['isFloat'] 		= /^[0-9]?\d+(\.\d+)?$/;
        ptrn['isVersion'] 		= /^(?:(\d+)\.)?(?:(\d+)\.)?(\*|\d+)$/
        ptrn['isPassword'] 		= /^[A-Za-z0-9@#$%^&*()!_-]{4,32}$/;
        ptrn['isParagraph'] 	= /^[^()]{40,255}$/;
        ptrn['isEmpty'] 		= /^[^()]{3,255}$/; ///^((?!undefined).){3,255}$/;
        ptrn['isSelected'] 	    = /^.{1,255}$/;
        ptrn['isZipcode'] 		= /^\+[0-9]{1,4}$/;
        ptrn['isPhone'] 		= /^[\s\d]{9,15}$/;
        ptrn['is4Digits']       = /^[0-9].{3,4}$/;
        ptrn['Arabic']          = /^[\u0600-\u06ff]|[\u0750-\u077f]|[\ufb50-\ufc3f]|[\ufe70-\ufefc]$/;


    var errorMsg=[];
        errorMsg['isEmail'] 		= '<?=__('is-email-msg')?>';
        errorMsg['isNumber']	   = '<?=__('is-number-msg')?>';
        errorMsg['isInteger'] 	  = '<?=__('is-integer-msg')?>';
        errorMsg['isFloat'] 		= '<?=__('is-flaot-msg')?>';
        errorMsg['isVersion']	  = '<?=__('is-version-msg')?>';
        errorMsg['isPassword'] 	 = '<?=__('is-password-msg')?>';//Only Alphabet, Numbers and symboles @ # $ % ^ & * ( ) ! _ - allowed;
        errorMsg['isParagraph'] 	= '<?=__('is-paragraph-msg')?>';//Paragraph should be between 40 and 255 character;
        errorMsg['isEmpty'] 		= '<?=__('is-empty-msg')?>';
        errorMsg['isSelected']  = '<?=__('is-selected-empty-msg')?>';
        errorMsg['isPhone'] 		= '<?=__('is-phone-msg')?>';
        errorMsg['is4Digits'] 		= '<?=__('is-4-digits-msg')?>';
    
    var _setError = function(elm ,msg, clr){
            
        !msg ? msg="" : msg;
        !clr ? clr=false : clr;

        var tar=$(elm).parent();
        if(elm.type=="checkbox"){tar=$(elm).parent().parent().parent()}
        if($('.error-message',tar).html() == undefined){
            $(tar).append('<div class="error-message"></div>');
        }
        $('.error-message',tar).text(msg)	
    }
    var _getErrors = function (obj, form_name){
        
        $(".error-message").text('');
        for(var prop in obj) {
            var value = obj[prop];
            if(typeof obj[prop] !== 'object'){continue;}
            var arr = $.map(value, function(val, index) {
                return [val];
            });
            var elm = $( '#'+form_name+' [name="'+prop+'"]' );
            if(Array.isArray(elm)){
                _setError($( '#'+form_name+' [name="'+prop+'"]' )[0] ,arr[0])
            }else{
                _setError($( '#'+form_name+' [name="'+prop+'"]' ) ,arr[0])
            }
        }
    }
        
    
    var poll2know = angular.module('poll2know', [
        'ngAnimate', 
        'ngSanitize'
        <?=$authUser != null ? ", 'ckeditor'" : ''?>
        <?=$isChart == 1 ? ", 'googlechart'" : ''?>
    ]);
    
    poll2know.controller('ctrl', function($scope, $http, $location, $timeout, $q) {
        
        $scope.DEF = {
            poll_type: JSON.parse('<?=addslashes( json_encode($this->Do->get('types')))?>'),
            bool: JSON.parse('<?=addslashes( json_encode($this->Do->get('bool')))?>'),
            rec_state: JSON.parse('<?=addslashes( json_encode($this->Do->get('statuses')))?>')
        };
        

        

        $scope.ckoptions = {
            language: '<?= $currlang ?>',
            startupOutlineBlocks: true,
            forcePasteAsPlainText: true,
            toolbar: [
                // [ 'Source', 'ShowBlocks' ],
                // [ 'BidiLtr', 'BidiRtl' ],
                ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'],
                // [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
                // [ 'Link','Unlink','Anchor' ],
                // [ 'Format','Styles','Font' ],
            ]
        }
        $scope.ckoptions_img = {

            filebrowserBrowseUrl: '<?=$app_folder?>/pages/photos',
            filebrowserImageBrowseUrl: '<?=$app_folder?>/pages/photos',
            filebrowserUploadUrl: '<?=$app_folder?>/admin/articles/uploadphoto?ajax=1',
            filebrowserImageUploadUrl: '<?=$app_folder?>/admin/articles/uploadphoto?ajax=1',
            contentsLangDirection: '<?=$currlang=='ar' ? 'RTL' : 'LTR'?>',

            language: '<?= $currlang ?>',
            startupOutlineBlocks: true,
            forcePasteAsPlainText: true,
            toolbar: [
                            
                [ 'Maximize' ],
                [ 'Source' ],
                [ 'BidiLtr', 'BidiRtl' ],
                [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ],
                [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', 'ShowBlocks'],
                [ 'Link','Unlink','Anchor' ],
                [ 'Image','Flash','Youtube','Table','HorizontalRule','Smiley','SpecialChar' ]
                //[ 'Bold','Italic','Underline','Strike' ],
                //[ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ],
                //[ 'Find','Replace' ],
                //[ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ],
                // [ 'Format','Styles','Font' ],
                // [ 'TextColor','BGColor', 'FontSize'],
                // [ 'Maximize','ShowBlocks' ]

            ]
        }


        
        $scope.filesInfo={}
        $scope.files={"exams":[], "polls":[], "options":[]};
        $scope.deletedphotos = [];
        
        $scope.signMode = "login";
        $scope.curr_modal_page = "Users/login";
        $scope.error_messages = [];
        $scope.app_folder = '<?php echo $app_folder?>';
        $scope.currlang = '<?php echo $currlang?>';
        $scope.currUrl  = window.location.href;
        $scope.param1 = '<?=empty($this->request->getParam('pass')[0]) ? '' : $this->request->getParam('pass')[0]?>';
        $scope.baseUrl = $scope.app_folder+"/"+$scope.currlang;
        $scope.thm = '<?=$theme?>';
        $scope.webroot = $scope.app_folder+"/"+$scope.thm
        $scope.dmn = window.location.origin;
        $scope.protocol = location.protocol;
        $scope.currTab = '1';
        $scope.mapLngLat='';
        $scope.isExamStarted = false;
//        $scope.chartsObj = angular.fromJson('<?='{}'?>');
        $scope.chartsObj = angular.fromJson('<?=isset($chartsObj) ? $chartsObj : '{}'?>');
        
//        console.log($scope.chartsObj);
        $scope.getChart = function(obj){
            return angular.fromJson(obj);
        }
        
        $scope.fields = {
            "1" :["slug", "company_name", "company_logo"], 
            "2" :["slug", "req_title", "req_photos"], 
            "3" :["slug", "article_title", "article_photo"]
        };
        $scope.userdt  = {
            gender:'1', 
            user_name: '<?=empty($authUser) ? '' : $authUser['user_fullname']?>', 
            user_email: '<?=empty($authUser) ? '' : $authUser['email']?>'
        };
        $scope.poll = {};
        $scope.prcntg=[];
        $scope.latestScores=[];
        $scope.lists = {
            polls:[], 
            exams:[], 
            contacts:[], 
            scores:[], 
            comments:[]
        }
        $scope.rec = {
            poll:{}, 
            exam:{}, 
            contact:{}, 
            score:{}, 
            comment:{comment_useremoji:"2.svg", 
                     comment_target: '<?=$this->request->getParam('controller')?>',
                     comment_target_slug: '<?=empty($this->request->getParam('pass')[0]) ? 'null' : $this->request->getParam('pass')[0]?>'},
            competition: {id:-1},
            cmptRes: {winner:{competitor_configs:{}}},
            searchRes: {},
            emailus: {reason:'reporting_error', message:'', from:''}
        }
        $scope.typesIcon = ["", "dot-circle", "check", "star"]
        $scope.isInv = '<?=empty($isInv) ? -1 : $isInv ?>';
        $scope.cmptId = '<?=empty($cmptId) ? -1 : $cmptId ?>';
        
        if($scope.cmptId > 0 && $scope.isInv < 0){
            $scope.cmptUser = JSON.parse('<?=empty($competitorDt) ? '{}' : addslashes( json_encode($competitorDt, JSON_UNESCAPED_UNICODE) )?>');
        }
        
        var path = '<?php echo $authUrl?>';
        var urlBase = $scope.baseUrl;

        $scope.loadSearch = function(dt) {
            $scope.searchResult=[];
            if($scope.fsearch.keyword.length>1){
                $scope.searchResult = dt;
            }
        };
        
        $scope.nl2br = function(str, is_xhtml) {
//            if (typeof str === 'undefined' || str === null) {
//                return '';
//            }
//            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br>' : '</ br>';
//            var res = (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
            return str;//res
        }
        $scope.setRand = function(n){
            return Math.floor( Math.random()*n )
        }
        $scope.range = function(n) {
            var arr = [];
            for(var i=1; i<n; i++){ arr.push(i) }
            return arr;
        };
        $scope.isMinAnswers = function( val, obj ){
            !val ? val=1 : val;
            if(!obj){return false;}
            var arr = Object.values(obj);
            arr = arr.filter(itm=>itm);
            if(arr.length >= val*1){return true;}
            return false;
        }
        $scope.getSelectVal = function(tar){
            return $("select", tar).val();
        }
        $scope.toElm  = function(tar) {
            var elmTarget2 = $('#'+tar);
            if(elmTarget2.length>0){
                $("html, body").animate({
                    scrollTop: elmTarget2.offset().top + " "
                }, 1000);
            }
       }

        var _setCvr = function(tar ,param){
            var elm = document.getElementById( tar );
            if(param==1){
                elm.style.opacity=1;
                elm.style.zIndex=200;
            }else{
                elm.style.opacity=0;
                elm.style.zIndex=-1;
            }
        }
        var _setCvrBtn = function(tar ,param, icon){
            !icon ? icon = false : icon;
            var span = $( "#"+tar+ " > span" );
            var btn = $( "#"+tar );
            if(param==1){ 
                span.html('<i class="fas fa-spinner fa-pulse"></i>');
                btn.css("pointer-events", "none");
                btn.attr("disabled", true);
            }else{ 
                if(icon){
                    span.html('<i class="fas fa-'+icon+'"> </i>');
                }else{
                    span.html('')
                }
                btn.css("pointer-events", "all");
                btn.attr("disabled", false);
            }
        }

        
        $scope.showMore = function(elm){
            $('#'+elm).toggleClass("do_show_more");
        }
        
        $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';

	
        $scope.prcntg = function(v1, v2){
            v1 = v1*1;
            v2 = v2*1;
            if(v1>v2){ return 100;}
            if(v1 > 0 || v2 > 0){
                return (v1 / v2) * 100;
            }
            return 0;
        }
        var headers = { 
            'X-CSRF-Token' : '<?=$this->request->getCookie('csrfToken')?>',
            'Accept': 'application/json',
            'Content-Type': 'application/json' 
        }
        $scope.callAction = function(url, dt, method, cvr, icon, form){
            
            !dt ? dt = '' : dt;
            !method ? method = 'get' : method;
            !cvr ? cvr = '' : cvr;
            !icon ? icon = '' : icon;
            !form ? form = '' : form;// show message and check errors
            
            if(cvr!=''){ _setCvrBtn(cvr, 1) }
            
            var requestObj = {
                    method  : method, 
                    url     : $scope.dmn + $scope.baseUrl + url, 
                    data    : typeof dt === 'string' ? $scope.rec[dt] : dt, 
                    headers : headers
                }
            return $http(requestObj).then(function(res){
                var resdt = res.data;
                if(res.data.data){  resdt = res.data.data }
                
                if(cvr!=''){ _setCvrBtn(cvr, 0, icon) }
                if(res.data.status == 'SUCCESS'){
                    if(dt == 'poll'){ $scope.poll = resdt }
                    if(dt == 'exam'){ $scope.rec[dt] = resdt }
                    if(dt == 'exams'){ $scope.lists[dt] = resdt }
                    if(dt == 'searchRes'){ $scope.rec.searchRes = resdt }
                    if(dt == 'latestScores'){ $scope.latestScores = resdt }
//                    console.log($scope.latestScores, resdt);
                    if(form!=''){
                        var msg = '<?=__("save-success")?>';
                        if(res.data.msg){  msg = res.data.msg }
                        _opAlert(msg, "success");
                        if(typeof dt === 'string'){
                            if($scope.rec[dt].captchaId){
                                $("#captcha_btn_"+$scope.rec[dt].captchaId).click();
                            }
                            $scope.rec[dt] = {}
                        }
                            _getErrors(resdt, form)
                    }
                }else{
                    _getErrors(resdt, form)
                }
            })
        }
        $scope.doSave = function(orginialObj, tar){
            
            !tar ? tar='exam' : tar;
            var obj = {}
            Object.assign(obj, orginialObj);
            
            var p = { img: 'exam_seo_image', mdl: 'exams', btn: '#exam_btn' }
            if(tar == 'exam'){
                obj.results = obj.polls = null;
            }
            if(tar == 'result'){
                p = { img: 'result_photos'+obj.id, mdl: 'results', btn: '#exam_btn' }
            }
            if(tar == 'poll'){
                p = { img: 'seo_image'+obj.id, mdl: 'polls', btn: '#poll_btn' }
            }
            obj.img=$scope.filesInfo[ p.img ];
            var defer = $q.defer();
            defer.resolve(
                $scope.callAction('/'+p.mdl+ '/save/'+ obj.id +'?ajax=1', obj, 'POST', 'save_'+tar+'_btn', 'save', tar+'_form')
            )
            var done = defer.promise;
            
            done.then( function(res){
                setTimeout(()=>{
                    $scope.callAction('/exams/me?ajax=1&list=1', 'exams');
                    $scope.callAction('/exams/me?ajax=1&id='+obj.id, 'exam');
                },1500)
            })
        }
        $scope.doRegister = function(){
            _setCvrBtn("register_btn", 1, "user-plus")
            $http({
                method  : "POST",
                url	 : urlBase+"/register?ajax=1",
                data	: $scope.userdt 
            })
            .then(function(res) {
                _setCvrBtn("register_btn", 0, "user-plus")
                if(res.data.status == 'SUCCESS'){
                    _opAlert('<?=__("register-success")?>', "success")
                    $('#register_mdl [data-dismiss="modal"]').click();
                }else{
                    _getErrors(res.data, 'reg_form')
                    _opAlert('<?=__("register-fail")?>', "error")
                }
            }, function(res){
                console.log("register fail ", res)
            });
        }

        $scope.doLogin = function(){
            _setCvrBtn("login_btn", 1)
            $http({
                method  : "POST",
                url	 : urlBase+"/login?ajax=1",
                data	: $scope.userdt 
            })
            .then(function(res) {
                _setCvrBtn("login_btn", 0, "sign-in-alt")
                if(res.data.status){
                    _opAlert('<?=__("login-success")?>', "success")
                    $('#login_mdl [data-dismiss="modal"]').click();
                    window.location.href = '<?=$authUrl?>';
                }else{
                    if(res.data.status == "NOT_ACTIVE"){
                        _opAlert('<?php __("account_not_active")?>', "error");
                    }
                    _opAlert('<?=__("login-fail")?>', "error");
                }
            }, function(err){
                _setCvrBtn("login_btn",0,"sign-in-alt")
            });
        }
        
        $scope.doClick = function(tar){
            // $timeout(function(){
            //     return $(tar).click();
            // },2000)
        }
        /////////// Modal and Message ///////////////
        var _opAlert = function(msg, color){
            
            !color ? color='default' : color;
            if(color.indexOf("#") > -1){ 
                if($(color).length>0){
                    return $(color)[0].click(); 
                }else{
                    return $(color).click(); 
                }
            }
            $('#flash').html("<div class='message "+ color +" animated fadeInDown' onclick=\"this.classList.add('animated', 'fadeOutUp');\"> <span class='jello'> <i class='fas fa-times'></i> "+msg+"</span></div>");
        }
        $scope.opAlert = function(msg, color){
            !color ? color='default' : color;
            _opAlert(msg, color)
        }
        /////////// End Modal and Message ///////////////
        
        /////////// Users Operations ////////////////////
        $scope.doResend = function(activeTar){

            !activeTar ? activeTar='sms' : activeTar;

            _setCvr('getsms_cvr',1);
            var msg = "132465";
            $http({
                method  : "POST",
                url	 : "https://bulksms.vsms.net/eapi/submission/send_sms/2/2.0?username=Turkeyde&password=Mary123Mary123&message=" + msg + "&msisdn=905346346466,905392467519"
            }).than(function(data) {
                _setCvr('getsms_cvr', 0)
            }, function(res){
                $('#flash').html("<div class='message error' onclick=$(this).addClass('fadeOut');><span class='fadeIn'><?=__('send-fail')?></span></div>");
                _setCvr('getsms_cvr', 0)
            })
        }

        $scope.doActivate = function(activeTar){

            !activeTar ? activeTar='sms' : activeTar;

            _setCvr('activate_cvr',1);
            $http({
                method  : "POST",
                url	 : urlBase+"/activate?ajax=1&activeTar="+activeTar,
                data	: $scope.userdt 
            })
            .then(function(res) {
                _setCvr('activate_cvr', 0)
                if(res.data !== '1'){
                }
            }, function(res){
                $('#flash').html("<div class='message error' onclick=$(this).addClass('fadeOut');><span class='fadeIn'><?=__('send-fail')?></span></div>");
                _setCvr('activate_cvr', 0)
            })
        }

        $scope.doGetPassword = function(){
            _setCvrBtn('getpassword_btn',1);
            $http({
                method  : "POST",
                url	 : urlBase+"/users/getpassword?ajax=1",
                data	: $scope.userdt 
            })
            .then(function(res) {
                _setCvrBtn('getpassword_btn',0, 'lock');
                if(res.data != 1){
                    _opAlert('<?=__("send-fail")?>', "error");
                    _getErrors(res.data, 'getpassword_form');
                }else{
                    _opAlert('<?=__("send-success")?>', "success");
                    $('#getpassword').modal('hide');
                }
            }, function(res){
                _opAlert('<?=__("send-fail")?>', "error");
                _setCvr('getpassword_cvr', 0)
            })
        }
        /////////// End Users Operations ////////////////////

        /////////// Exams Operations ////////////////////
        $scope.doExamAnswer = function(pollObj){
            _setCvrBtn ('poll_btn' ,1);
            _setCvrBtn ('poll_cvr' ,1);
            
            if(typeof pollObj.selectedOptions === 'object'){
                for(var key in pollObj.selectedOptions){
                    pollObj.selectedOptions[key] == false ? delete pollObj.selectedOptions[key] : '';
                }
            }
            pollObj.isCompetition = $scope.cmptId;
            
            var requestObj = {
                    method  : 'post', 
                    url     : $scope.dmn + $scope.baseUrl + '/exams/answer', 
                    data    : pollObj, 
                    headers : headers }
            
            // save answer
            $http(requestObj).then(function(res){
                console.log("doExamAnswer res", res.data.data)
//                $scope.poll={};
//                _setCvrBtn ('poll_btn' , 0, 'paper-plane');
//                _setCvrBtn ('poll_cvr' ,0);
                
                // update competitor
                if($scope.cmptId>0){
                    var cDt = $scope.rec.competition.competitorDt;
                    cDt.answers = res.data.data.answers;
                    cDt.exam_id = $scope.rec.competition.exam_id;
                    if(cDt.id > -1){
                        $http({
                            method  : "POST",
                            url	    : urlBase+"/competitions/updateCompetitor/"+cDt.id+"?ajax=1",
                            data    : cDt
                        }).then(function(res2){
                            if(res.data.status == "COMPETITION"){
                                return window.location.href = "<?=$path.'/'.$currlang?>/competitions/view/" +res.data.data.competition_id;
                            }else{
                                return window.location.href = "<?=$path.'/'.$currlang?>/exam/"+$scope.param1+"/?id="+$scope.cmptId+"&q="+res.data.data.total_answers
                            }
                        })
                    }
                }
                if(res.data.status == "RESULT"){
                    alert("result")
                    // return window.location.href = "<?=$path.'/'.$currlang?>/scores/view/"+res.data.data.id
                }
                return window.location.href = "<?=$path.'/'.$currlang?>/exam/"+$scope.param1+"/?q="+res.data.data.total_answers
                
//                $scope.poll = res.data
            })
        }
        
        $scope.playSound = function(url){
            var audio = new Audio($scope.dmn+$scope.app_folder+url);
            audio.play();
        }
        
        $scope.chkCompetition = function(id){
            $http.get(urlBase+"/competitions/chk/"+id+"?ajax=1").then(function(res){
//                console.log(res.data.data)
                if(res.data.status == "SUCCESS"){
                    var curCmpttr = res.data.data.competitors[res.data.data.competitors.length-1];
                    if(res.data.data.competitors.length > $scope.rec.competition.competitors.length ){
                        $scope.playSound('/img/hello_'+ $scope.currlang +'_'+curCmpttr.competitor_gender+'_1.mp3')
                    }
                    $scope.rec.competition = res.data.data;
                    console.log(res.data.data.rec_state +"==="+ $scope.poll.isExamStarted +"==="+ curCmpttr.competitor_configs.isFounder)
                    
                    if(res.data.data.rec_state == 2 && !$scope.poll.isExamStarted && curCmpttr.competitor_configs.isFounder == 0){
                        $scope.poll.isExamStarted = true;
                        $scope.playSound('/img/start.aac')
                    }
                    if($scope.cmptId > -1){
                        setTimeout(function(){
                            $scope.chkCompetition(id);
                        }, 5000);
                    }
                }else{
                    if(res.data.msg == 'competition_expired'){
                        $scope.deleteCompetition(id, true);
                    }
                    _opAlert("<?=__("competition_closed")?>", "default");
                    window.location.href = $scope.baseUrl+"/exam/"+$scope.param1;
                }
            })
        }
        
        $scope.chkCompetitionResult = function(id){
            $http.get(urlBase+"/competitions/view/"+id+"?ajax=1").then(function(res){
                if(res.data.status == "SUCCESS"){
                    $scope.rec.cmptRes = res.data.data;

                    if($scope.rec.cmptRes.rec_state*1 < 3){
                        setTimeout(function(){
                            $scope.chkCompetitionResult(id);
                        }, 5000)
                    }else{
                        $scope.playSound('/img/start.aac')
                    }
                }else{
                    console.log(res.data)
                }
            })
        }
        
        $scope.createCompetition = function(id){
            !id ? id='' : id;
            _setCvrBtn("competition_btn", 1);
            console.log("$scope.rec.competition", $scope.rec.competition)
            $http({
                method  : "POST",
                url	 : urlBase+"/competitions/add/"+id+"?ajax=1",
                data	: $scope.rec.competition
            }).then(function(res){
                if(res.data.status == "SUCCESS"){
                    window.location.href = $scope.baseUrl+"/exam/"+$scope.param1+"/?id="+res.data.data.id;
                }else if(res.data.status != "FAIL"){
                    _opAlert(res.data.status, "error");
                }else{
                    _opAlert('<?=__('create_competition_failed')?>', "error");
                }
            })
        }
        
        $scope.startCompetition = function(id){
            if($scope.rec.competition.competitors.length<2){
                _opAlert('<?=__('too_few_competitors')?>', "error");
                return ;
            }
            $scope.toElm('top');;
            return $scope.callAction('/competitions/edit/'+id+'?ajax=1', {rec_state:2}, 'POST', 'competition_btn')
        }
        
        $scope.deleteCompetition = function(id, noConfirm){
            if(!noConfirm){ 
                if(!confirm('<?=__('delete_record')?>')){ return ; }
            }
            $http({
                method  : "DELETE",
                url	: urlBase+"/competitions/delete/"+id+"?ajax=1"
            }).then(function(res){
                if(!noConfirm){
                    window.location.href = $scope.baseUrl+"/exam/"+$scope.param1
                }
            })
        }
        if($scope.cmptId>-1 || $scope.isInv>-1){
            $scope.rec.competition = JSON.parse('<?=addslashes( json_encode($currentCompetition, JSON_UNESCAPED_UNICODE) )?>');
            setTimeout(()=>{
                if($scope.cmptId>-1){$scope.toElm('top');}
                if($scope.isInv>-1){$scope.toElm('user_form');}
            }, 500)
        }
        
        /////////// End Exams Operations ////////////////////
        var _setShare = function(tar, obj){//obj = title, desc, photo, tags, url
            var _Url = encodeURI(document.URL);
            var hashTags = obj.tags.replace(/\s/g, '_');
            var pageUrl = decodeURI(document.URL);
            var title = obj.title;
            var p = obj.desc;
            var imgPath = obj.photo
            var url='';
            if(tar=='whatsapp' && screen.width < 600){url='whatsapp://send?text='+title+' \n '+pageUrl}
            if(tar=='whatsapp' && screen.width > 600){url='https://api.whatsapp.com/send?text='+title+' \n '+pageUrl}
            if(tar=='facebook'){url='https://www.facebook.com/sharer/sharer.php?u='+pageUrl}
            if(tar=='twitter'){url='https://twitter.com/intent/tweet?text='+title+'&url='+_Url+'&hashtags='+hashTags}
            if(tar=='google-plus'){url='https://plus.google.com/share?url='+pageUrl}
            if(tar=='linkedin'){url='https://www.linkedin.com/shareArticle?mini=true&url='+_Url+'&title='+title+'&summary='+p+'&source=poll2know.com'}
            if(tar=='pinterest'){url='https://pinterest.com/pin/create/button/?url='+encodeURIComponent(pageUrl)+'&image_url='+encodeURIComponent(imgPath)+'&description='+encodeURIComponent(p)}
            if(tar=='email'){url='mailto:email?subject='+obj.title+'&body=<?=__('checklink').'\n\n\r\r   '?>'+obj.url }
            return url
        }

        $scope.openWin = function(tar, obj){
            var urlTar = _setShare(tar, obj);
            var conf = "directories=no, menubar=no, status=no, location=no, titlebar=no, toolbar=no, scrollbars=no, width=700, height=400, resizeable=no, top=150, left=250";
            var popup=window.open(urlTar, '_blank', conf); //'http://localhost/poll2know/pages/sharer'
            //var dom = popup.document.body;
        }
        
        $scope.copyToClipBoard = function(tar){
            var elm = $(tar);
            navigator.clipboard.writeText(elm.text()).then(function() {
                alert("<?=__('link_copied')?>");
            }, function(err) {
                console.error('Async: Could not copy text: ', err);
            });
        }
        
        $scope.session = function(tar, op, val){
            
            !tar ? tar = '' : tar;
            !op ? op = 'read' : op;
            !val ? val = '' : val;
            
            $http.get(urlBase+"/configs/sess/"+tar+"/"+op+"/"+val+"?ajax=1").then(function(res){
                console.log("sess ", tar, res.data);
            })
        }

        $scope.goTo = function(path, ext){

            !ext ? ext==null : ext;

            if(ext){return window.open($scope.baseUrl+path)}
            return window.location.href = $scope.dmn+$scope.app_folder+path
        }
        $scope.showMenu = function (){
            if($('.mobMenu').css('right')=='0px'){
                $('.mobMenu').css('right', '-800px');
                $('.menu_btn').html('<i class="fa fa-bars"></i>');
            }else{
                $('.mobMenu').css('right', '0px');
                $('.menu_btn').html('<i class="fa fa-times"></i>');
            }
        }
        
        $scope.getAttr = function(tar, attr){
           return $(tar).attr(attr)
        }
        $scope.isPhoto = function(photo){
            if(photo<-1 || photo == '' || photo == null){
                return false;
            }
            return true;
        }
        
        $scope.setActiveTab = function(elm){
            var activeElm = $(elm + " .show");
            var cls = elm.substr(1).split("_");
            $("."+cls).removeClass("shadow-box");
            if(activeElm.length<1){
                $(elm).addClass("shadow-box");
            }
        }
        
    });
    
    
    
    <?php // DIRECTIVES ?>
    
    poll2know.directive('setFixed', ['$window', function ($window) {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                if(window.innerWidth < 768){
                    //element[0].classList.add('smallHeader');
                    return ;	
                }
                angular.element(document).bind('scroll', function() {
                    if ($window.pageYOffset > 1) {
                        element[0].classList.add('smallHeader')
                    } else {
                        element[0].classList.remove('smallHeader')
                    }
                });
            }
        };
    }]);

    poll2know.directive("showPassword", ['$timeout', function ($timeout) {
        return {
            link: function (scope, elm, attrs, ngModel) {
                elm.bind('click', function(e) {
                    var field = $(elm).parent().find("input")
                    if(field.attr("type") == "password"){
                        $(elm).parent().find("input").attr("type", "text");
                        $(elm).removeClass("fa-eye-slash").addClass("fa-eye");
                    }else{
                        $(elm).parent().find("input").attr("type", "password");
                        $(elm).removeClass("fa-eye").addClass("fa-eye-slash");
                    }
                })
            }
        }
    }]);
    poll2know.directive("showImg", function () {
        return {
            link: function (scope, elm, attrs, ngModel) {
                elm.bind('click', function(e) {
                    if(attrs.src.indexOf(".svg")>0){return "";}
                    $('#imgHolder').html('<img src="'+attrs.src.replace("thumb/", "")+'"><i class="fa fa-times" aria-hidden="true"></i>');
                    $('#imgHolder').attr("style","opacity: 1; z-index:999;");
                })
            }
        }
    })
    poll2know.directive('chk', function () {
    return {
        restrict: 'AE',
        require: 'ngModel',
        scope: {chk: '@'},
        link: function (scope, element, attrs, ctrl) {
				ctrl.$parsers.unshift(function (viewValue) {
					
					if ( ptrn[scope.chk].test(viewValue) ) {
						_setError(element[0] , '', "#1abb9c");
						ctrl.$setValidity('checked', true);
						return viewValue;
					} else {
						_setError(element[0] ,errorMsg[scope.chk]);
						ctrl.$setValidity('checked', false);
						return undefined;
					}
				});
				ctrl.$formatters.push(function (viewValue) {
                    ctrl.$setValidity('checked', false);
				});
        }
    };
});
//    poll2know.directive('chk', function () {
//        return {
//            scope: {chk: '@'},
//            link: function (scope, element, attrs, ctrl) {
//				ctrl.$formatters.push(function (viewValue) {
//                    onBlur()
//                })
//                
//				ctrl.$parsers.unshift(function (viewValue) {
//                    onBlur()
//                })
////                element.bind('blur', onBlur);
//                function onBlur(){                    
//                    if(attrs.type == 'checkbox' || attrs.type == 'radio'){
//                        var newid = attrs.id.substr(0, attrs.id.length-1);
//                        var elms = document.querySelectorAll('[id^='+newid+']');
//                        for(var i in elms){
//                            if(elms[i].checked == true){
//                                return _setError(element[0] , '', true);
//                            }else{
//                                _setError(element[0] ,errorMsg[scope.chk]);
//                            }
//                        }
//                    }else{
//                        if ( ptrn[scope.chk].test(element[0].value) ) {
//                            _setError(element[0] , '', true);
//                        } else {
//                            _setError(element[0] ,errorMsg[scope.chk]);
//                        }
//                    }
//                    scope.$apply();
//                }
//            }
//        };
//    });
    // Doesn't work because of caching, but it works for SPA
    poll2know.directive('imgResizer', function() {
        return {
            link: function (scope, element, attrs, ctrl) {
                setTimeout(function(){
                    if(element[0].naturalHeight < element[0].naturalWidth){
                       element.addClass("setHeight")
                    }else{
                       element.addClass("setWidth")
                    }
                },1000)
            }
        }
    });
    // Doesn't work because of caching, but it works for SPA
    poll2know.directive('opModal', function() {
        return {
            link: function (scope, elm, attrs, ctrl) {
                elm.on('click', function(e){
                    e.preventDefault();
                    $("#modal_tmplt .modal-body").load('localhost'+attrs.href);
                    $("#modal_tmplt").modal('show')
//                    $("#modal_tmplt").addClass('show')
//                    $("#modal_tmplt").removeClass('fade')
                });
            }
        }
    }); 
    poll2know.directive("loadModal", function () {
        return {
            link: function (scope, elm, attrs, ngModel) {
                elm.bind('click', function(e) {
                    $("#modal_tmplt .modal-title").load(attrs.title);
                    $("#modal_tmplt .modal-body").html(content);
                })
            }
        }
    })
    poll2know.directive("isRtl", function () {
        return {
            link: function (scope, element, attrs, ctrl) {
//                console.log("isRtl", ptrn["Arabic"].test( $(element).text() ), $(element).text() )
                if(ptrn["Arabic"].test( $(element).text() ) ){
                    $(element).addClass("rtl");
                }else{
                    $(element).addClass("ltr");
                }
            }
        }
    })
    poll2know.directive('onClickOut', ['$document', function ($document) {
        return {
           restrict: 'A',
           link: function (scope, el, attr) {
               $document.on('click', function (e) {
                   if (el !== e.target && !el[0].contains(e.target)) {
                       el.removeClass('res_show')
                   }
               });
           }
        }
    }]);
    poll2know.directive('mapBox', function ($timeout) {
        return {
           restrict: 'A',
           link: function ($scope, el, attr) {
                var markers = [];
                var inc = 0;
                mapboxgl.accessToken = 'pk.eyJ1Ijoib3NhbWFxYXNzYXIiLCJhIjoiY2t2ZjdjMGs0Mzl4YjJyb2thNHg2Y3U5biJ9.EuIV0zckjatBvagMyAzXEw';
                const map = new mapboxgl.Map({
                    container: attr.id,  
                    center: [28.956680872728413, 41.01360253115541],  
                    style: 'mapbox://styles/mapbox/streets-v11', 
                    zoom: 9  
                });
                
                // map.addControl(
                //     new MapboxGeocoder({
                //         accessToken: mapboxgl.accessToken,
                //         mapboxgl: mapboxgl
                //     })
                // );
                // map.on('load', () => {
                //     // Load an image from an external URL.
                //     map.loadImage( '<?=$path?>/img/here.png', (error, image) => {
                //         if (error) throw error;
                        
                //         // Add the image to the map style.
                //         map.addImage('mycompany', image);
                        
                //         // Add a data source containing one point feature.
                //         map.addSource('point', {
                //             'type': 'geojson',
                //             'data': {
                //                 'type': 'FeatureCollection',
                //                 'features': [
                //                     {
                //                     'type': 'Feature',
                //                     'geometry': {
                //                         'type': 'Point',
                //                         'coordinates': [-77.4144, 25.0759]
                //                         }
                //                     }
                //                 ]
                //             }
                //         });
                        
                //         // Add a layer to use the image to represent the data.
                //         map.addLayer({
                //             'id': 'points',
                //             'type': 'symbol',
                //             'source': 'point', // reference the data source
                //             'layout': {
                //                 'icon-image': 'mycompany', // reference the image
                //                 'icon-size': 0.25
                //             }
                //         });
                //     });
                // });

                map.on('click', (e) => {
                    inc++;
                    $scope.$apply(function () {
                        $scope.mapLngLat = e.lngLat;
                    })
                    if(typeof markers[inc-1] === 'object'){
                        markers[inc-1].remove();
                    }

                    const marker_div = document.createElement('div');
                    marker_div.className = 'marker';
                    marker_div.innerHTML = "يس شسي شسي شسي شسي شسي شسي شسي"
                    
                    markers[inc] = new mapboxgl.Marker(marker_div).setLngLat(e.lngLat)
                        .addTo(map);
                });
           }
        }
    });
    
    poll2know.directive('fileModel', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            link: function($scope, element, attrs) {
                var model = $parse(attrs.fileModel);
                var modelSetter = model.assign;

                element.bind('change', function(changeEvent){
                    // prepare file info

                    var reader = new FileReader();
                    reader.onload = function (loadEvent) {
                        $scope.$apply(function () {
                            $scope.filesInfo[attrs.name] = {
                                lastModified: changeEvent.target.files[0].lastModified,
                                lastModifiedDate: changeEvent.target.files[0].lastModifiedDate,
                                name: changeEvent.target.files[0].name,
                                size: changeEvent.target.files[0].size,
                                type: changeEvent.target.files[0].type,
                                tmp_name: loadEvent.target.result
                            }
                        });
                    }
                    reader.readAsDataURL(changeEvent.target.files[0]);
                    // prepage file upload
                    $scope.$apply(function(){
                        modelSetter($scope, [ element[0].files[0] ]);
                    });
                });
            }
        };
    }]);

    if(window.location.href.indexOf('login=1')>-1){
        $("#login_mdl_btn")[0].click();
    }
})();
</script>

<?php // ADS CONTROL AREA?>
<script>

function addAd(id, adUnitID, cls, adType) {
    !cls ? cls = "col-12" : cls;
    !adType ? adType = "google" : adType;
    var adDiv = document.getElementById(id);
    
    if(adDiv!=null){
        $(adDiv).addClass(cls);
        $(adDiv).css("display", "block");
        if(adType == 'google'){
            var ele = document.createElement('ins');
            ele.style.display = 'block';
            ele.className = 'adsbygoogle infeed';
            ele.setAttribute('data-ad-client', 'ca-pub-8020871962555557');
            ele.setAttribute('data-ad-slot', adUnitID);
            ele.setAttribute('data-ad-format', 'auto');
            ele.setAttribute('data-full-width-responsive', 'true');

            adDiv.append(ele);

            (adsbygoogle = window.adsbygoogle || []).push({});
        }
        if(adType == 'foremedia'){
            var div = document.createElement('div')
            div.id = 'foremediaads-'+adUnitID;

            var script = document.createElement('script');
            script.src = 'https://platform.foremedia.net/code/15428/'+adUnitID;
            script.type = 'text/javascript';
            script.setAttribute('async', '');
            document.getElementById(id).appendChild(div);
            document.getElementById(id).appendChild(script);
        }
    }
}
function addAffiliate(id) {
    var elm = document.getElementById(id);
    if(!elm){ return; }
    elm.style.display = 'block';
    var img = '<img src="<?=$app_folder?>/img/affiliates/ad'+Math.floor( Math.random()*7 ) +'.png" />';
    var ad = '<a href="https://click.linksynergy.com/fs-bin/click?id=UybJp7GvYw8&offerid=1060092.17988&type=3&subid=0">'+img+'</a><img border="0" width="1" alt="" height="1" src="https://ad.linksynergy.com/fs-bin/show?id=UybJp7GvYw8&bids=1060092.17988&type=3&subid=0" target="_new" >'
    elm.innerHTML = ad;
}
function addAdCustom(id, url, img, cls, isInList, txt1, txt2) {
    !txt1 ? txt1 = '' : txt1;
    !txt2 ? txt2 = '' : txt2;
    var elm = document.getElementById(id);
    if(!elm){ return; }
    elm.style.display = 'block';
    if(isInList){ 
        elm.classList.add(...cls.split(' ')); 
        cls=''; 
    }
    var img = '<img src="<?=$app_folder?>/img/'+img+'" />';
    var ad = '<div class="'+cls+'"><a href="'+url+'" target="_new">'+txt1+img+txt2+'</a></div>';
    elm.innerHTML = ad;
}
if('<?=$isLocal?>' == 0){
    window.onload = function(){
        if(decodeURI( window.location.href ).indexOf('تركي')>-1){
            addAdCustom('rside_exam_slot', 'https://bit.ly/3SD16RI', 'ads/apostrophe_offer.webp', '', false, '<br><br><b>Apostrophe training and linguistic center <br> مركز متخصص لتعليم اللغات و التدريب</b>', '');
        }
        addAffiliate('affiliate_1')

        addAd('adArea_1st_ad', 2529350448);
        addAd('adArea_2nd_ad', 6600457395);
        
        // addAd('header_home_slot', 1065839937);
        addAdCustom('header_home_slot', 'https://bit.ly/3SD16RI', 'ads/main_ad_ar.webp', 'col-12');
        // addAd('footer_home_slot', 9613595555);
        addAdCustom('footer_home_slot', 'https://bit.ly/3SD16RI', 'ads/main_ad_ar.webp', 'col-12');
        
        // addAd('footer_score_slot', 7809559292);
        addAdCustom('footer_score_slot', 'https://bit.ly/3SD16RI', 'ads/main_ad_ar.webp', 'col-12');
        addAd('middle_score_slot1', 7809559292);
        // addAd('middle_score_slot2', 8992431413);
        addAdCustom('middle_score_slot2', 'https://bit.ly/3SD16RI', 'ads/main_ad_ar.webp', 'col-12');
        addAd('header_score_slot', 8992431413);
        
        //addAd('sponsor_slot', 6310427757);
        
        addAd('header_games_slot', 8914643439);
        addAd('header_game_slot', 4817462237);
        addAd('footer_games_slot', 2349235086);
        addAd('footer_game_slot', 2682253483);
        
        addAd('listItem_games_1_slot', 4097431027, 'col-md-6 col-lg-6');
        addAd('listItem_games_2_slot', 9158186019, 'col-md-6 col-lg-6');
        addAd('listItem_games_3_slot', 4250486023, 'col-md-6 col-lg-6');
        addAd('listItem_games_4_slot', 4158986682, 'col-md-6 col-lg-6');
        
        // addAd('header_exams_slot', 6028384390);
        addAdCustom('header_exams_slot', 'https://bit.ly/3SD16RI', 'ads/main_ad_ar.webp', 'col-12');
        // addAd('header_exam_slot', 6693571139);
        addAdCustom('header_exam_slot', 'https://bit.ly/3SD16RI', 'ads/main_ad_ar.webp', 'col-12');
        // addAd('footer_exams_slot', 9314212659);
        addAdCustom('footer_exams_slot', 'https://bit.ly/3SD16RI', 'ads/main_ad_ar.webp', 'col-12');
        // addAd('footer_exam_slot', 2427023061);
        addAdCustom('footer_exam_slot', 'https://bit.ly/3SD16RI', 'ads/main_ad_ar.webp', 'col-12');
        
        // addAd('listItem_exams_1_slot', 2365660923, 'col-md-6 col-lg-6');
        addAdCustom('listItem_exams_1_slot', 'https://bit.ly/3SD16RI', 'ads/ad2_ar.webp', 'col-md-6 col-lg-6', true);
        // addAd('listItem_exams_2_slot', 1052579254, 'col-md-6 col-lg-6');
        addAdCustom('listItem_exams_2_slot', 'https://bit.ly/3SD16RI', 'ads/ad4_ar.webp', 'col-md-6 col-lg-6', true);
        // addAd('listItem_exams_3_slot', 3366562030, 'col-md-6 col-lg-6');
        addAdCustom('listItem_exams_3_slot', 'https://bit.ly/3SD16RI', 'ads/ad2_ar.webp', 'col-md-6 col-lg-6', true);
        // addAd('listItem_exams_4_slot', 8056971301, 'col-md-6 col-lg-6');
        addAdCustom('listItem_exams_4_slot', 'https://bit.ly/3SD16RI', 'ads/ad4_ar.webp', 'col-md-6 col-lg-6', true);
        
        addAd('header_polls_slot', 3931676420);
        addAd('header_poll_slot', 4692441364);
        addAd('footer_polls_slot', 7142155519);
        addAd('footer_poll_slot', 1435722637);

        
       //addAd('listItem_polls_1_slot', 1670336986, 'col-sm-6  col-lg-4');
       //addAd('listItem_polls_2_slot', 1030180918, 'col-sm-6  col-lg-4');
       //addAd('listItem_polls_3_slot', 1806068353, 'col-sm-6  col-lg-4');
       //addAd('listItem_polls_4_slot', 4777854236, 'col-sm-6  col-lg-4');
    }
}

setTimeout(()=>{
    jQuery('.se-pre-con').fadeOut("slow");
},1000)

</script>
    <div id="bottom_div"></div>
</div>
    

</body>
</html>
