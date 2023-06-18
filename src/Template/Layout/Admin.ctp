<!DOCTYPE html>
<html lang="<?=$currlang?>">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
    <!-- jQuery -->
    <?php echo $this->Html->script('/gentela/vendors/jquery/dist/jquery.min.js') ?>

    <!-- Bootstrap -->
    <?php 
    if($currlang == 'ar'){
        echo $this->Html->css('bootstrap-rtl.min');
    }else{
        echo $this->Html->css('/gentela/vendors/bootstrap/dist/css/bootstrap.min.css');
    }
    ?>
    <!-- Font Awesome -->
    <?php echo $this->Html->css('/gentela/vendors/font-awesome/css/font-awesome.min.css')?>
    <!-- NProgress -->
    <?php echo $this->Html->css('/gentela/vendors/nprogress/nprogress.css')?>
    <!-- Animate -->
    <?php echo $this->Html->css('/gentela/vendors/animate.css/animate.min.css')?>
    <!-- iCheck -->
    <?php echo $this->Html->css('/gentela/vendors/iCheck/skins/flat/green.css')?>
    <!-- bootstrap-progressbar -->
    <?php //echo $this->Html->css('/gentela/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')?>
    <!-- PNotify -->
    <?php echo $this->Html->css('/gentela/vendors/pnotify/dist/pnotify.css')?>
    <?php echo $this->Html->css('/gentela/vendors/pnotify/dist/pnotify.buttons.css')?>
    <?php echo $this->Html->css('/gentela/vendors/pnotify/dist/pnotify.nonblock.css')?>
    <!-- JQVMap -->
    <?php //echo $this->Html->css('/gentela/vendors/jqvmap/dist/jqvmap.min.css')?>
    <!-- bootstrap-daterangepicker -->
    <?php echo $this->Html->css('/gentela/vendors/bootstrap-daterangepicker/daterangepicker.css')?>
    <!-- JQuery Tags Input-->
    <?php //echo $this->Html->css('bootstrap-tagsinput.min')?>
    <!-- Custom Theme Style -->
    <?php echo $this->Html->css('/gentela/build/css/custom.min.css')?>
    <!-- MY Custom Theme Style -->
    <?php echo $this->Html->css('gentela_style')?>

    <?php 
    if($currlang == 'ar'){
        echo $this->Html->css('gentela_style-rtl');
    }
    ?>

    



</head>
<body class="nav-md" ng-app="app" ng-controller="ctrl as ctrl">
    <div class="container body">
        <div class="main_container">
            
            <!-- SIDE BAR -->
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?=$app_folder?>/<?=$currlang?>/admin" class="site_title">
                            <?=$this->Html->image('/img/favicon.png', ['alt'=>'', 'height'=>'30'])?>
                            <span><?=__('sitename')?></span>
                        </a>
                    </div>

                    <div class="clearfix"></div>

                    <?php echo $this->element('gentela_sidetopbar')?>

                    <br>

                    <?php echo $this->element('gentela_sidebar')?>
            
                    <?php echo $this->element('gentela_sidefooter')?>
                </div>
            </div>
            

            <!-- CONTENT TOP -->
            <?php echo $this->element('gentela_topbar')?>

            <!-- CONTENT BODY -->
            <?php echo $this->Flash->render() ?>
            <?php echo $this->fetch('content') ?>

            <!-- FOOTER -->
            <?php echo $this->element('gentela_footer')?>

        </div>
    </div>
    
    <div id="imgHolder" onClick="this.setAttribute('style', 'opacity:0; visibility:hidden;')"></div>

    
    <!--    JAVASCRIPT      -->
    <!-- JQuery Tags Input-->
    <?php echo $this->Html->script('bootstrap-tagsinput.min')?>
    <!-- Angular -->
    <?php echo $this->Html->script('angular') ?>
    <!-- Bootstrap -->
    <?php echo $this->Html->script('/gentela/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') ?>
    <!-- HTML 2 Canvas to IMAGE -->
    <?php echo $this->Html->script('html2canvas.min')?>
    <!-- FastClick -->
    <?php //echo $this->Html->script('/gentela/vendors/fastclick/lib/fastclick.js') ?>
    <!-- NProgress -->
    <?php echo $this->Html->script('/gentela/vendors/nprogress/nprogress.js') ?>
    <!-- Chart.js -->
    <?php echo $this->Html->script('/gentela/vendors/Chart.js/dist/Chart.min.js') ?>
    <!-- gauge.js -->
    <?php //echo $this->Html->script('/gentela/vendors/gauge.js/dist/gauge.min.js') ?>
    <!-- bootstrap-progressbar -->
    <?php //echo $this->Html->script('/gentela/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') ?>

    <!-- PNotify -->
    <?php echo $this->Html->script('/gentela/vendors/pnotify/dist/pnotify.js') ?>
    <?php echo $this->Html->script('/gentela/vendors/pnotify/dist/pnotify.buttons.js') ?>
    <?php echo $this->Html->script('/gentela/vendors/pnotify/dist/pnotify.nonblock.js') ?>

    <!-- iCheck -->
    <?php //echo $this->Html->script('/gentela/vendors/iCheck/icheck.min.js') ?>
    <!-- Skycons -->
    <?php //echo $this->Html->script('/gentela/vendors/skycons/skycons.js') ?>
    <!-- Flot -->
    <?php //echo $this->Html->script('/gentela/vendors/Flot/jquery.flot.js') ?>
    <?php //echo $this->Html->script('/gentela/vendors/Flot/jquery.flot.pie.js') ?>
    <?php //echo $this->Html->script('/gentela/vendors/Flot/jquery.flot.time.js') ?>
    <?php //echo $this->Html->script('/gentela/vendors/Flot/jquery.flot.stack.js') ?>
    <?php //echo $this->Html->script('/gentela/vendors/Flot/jquery.flot.resize.js') ?>
    <!-- Flot plugins -->
    <?php //echo $this->Html->script('/gentela/vendors/flot.orderbars/js/jquery.flot.orderBars.js') ?>
    <?php //echo $this->Html->script('/gentela/vendors/flot-spline/js/jquery.flot.spline.min.js') ?>
    <?php //echo $this->Html->script('/gentela/vendors/flot.curvedlines/curvedLines.js') ?>
    <!-- DateJS -->
    <?php //echo $this->Html->script('/gentela/vendors/DateJS/build/date.js') ?>
    <!-- JQVMap -->
    <?php //echo $this->Html->script('/gentela/vendors/jqvmap/dist/jquery.vmap.js') ?>
    <?php //echo $this->Html->script('/gentela/vendors/jqvmap/dist/maps/jquery.vmap.world.js') ?>
    <?php //echo $this->Html->script('/gentela/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') ?>
    <!-- bootstrap-daterangepicker -->
    <?php echo $this->Html->script('/gentela/vendors/moment/min/moment.min.js') ?>
    <?php echo $this->Html->script('/gentela/vendors/bootstrap-daterangepicker/daterangepicker.js') ?>
    <!-- CKEditor -->
    <?php echo $this->Html->script('/gentela/vendors/ckeditor4.13.0/ckeditor') ?>
    <?php echo $this->Html->script('/gentela/vendors/ckeditor4.13.0/angular-ckeditor') ?>
    <!-- Custom Theme Scripts -->
    <?php echo $this->Html->script('/gentela/build/js/custom.min') ?>
    

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
	ptrn['isSelectEmpty'] 	= /^[^()]{1,255}$/;
	ptrn['isZipcode'] 		= /^\+[0-9]{1,4}$/;
	ptrn['isPhone'] 		= /^[\s\d]{9,15}$/;

var errorMsg=[];
	errorMsg['isEmail'] 		= '<?=__('is-email-msg')?>';
	errorMsg['isNumber']	   = '<?=__('is-number-msg')?>';
	errorMsg['isInteger'] 	  = '<?=__('is-integer-msg')?>';
	errorMsg['isFloat'] 		= '<?=__('is-flaot-msg')?>';
	errorMsg['isVersion']	  = '<?=__('is-version-msg')?>';
	errorMsg['isPassword'] 	 = '<?=__('is-password-msg')?>';//Only Alphabet, Numbers and symboles @ # $ % ^ & * ( ) ! _ - allowed;
	errorMsg['isParagraph'] 	= '<?=__('is-paragraph-msg')?>';//Paragraph should be between 40 and 255 character;
	errorMsg['isEmpty'] 		= '<?=__('is-empty-msg')?>';
	errorMsg['isSelectEmpty']  = '<?=__('is-selected-empty-msg')?>';
	errorMsg['isPhone'] 		= '<?=__('is-phone-msg')?>';


    var _setDate = function(dt, p, flag) {
        !dt ? dt = '' : dt;
        !p ? p = [0,0,0,0,0,0] : p;
        
	    var now     = new Date(dt); 
	    var year    = now.getFullYear();
	    var month   = now.getMonth()+1; 
	    var day     = now.getDate();
	    var hour    = now.getHours();
	    var minute  = now.getMinutes();
	    var second  = now.getSeconds();
        
        year+=(p[0]*1); month+=(p[1]*1); day+=(p[2]*1); 
        hour+=(p[3]*1); minute+=(p[4]*1); second+=(p[5]*1);
        
	    if(month.toString().length == 1) { month = '0'+month; }
	    if(day.toString().length == 1) {   day = '0'+day; }
	    if(hour.toString().length == 1) {  hour = '0'+hour; }
	    if(minute.toString().length == 1) { minute = '0'+minute; }
	    if(second.toString().length == 1) { second = '0'+second; }
	    var res = year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second; 
	    if(flag == 'onlydate'){  	res = year+'-'+month+'-'+day;   }
	    return res;
	}
    clrs = [
        "#7bb3eb", "#eba556", "#7c81e5", "#87e089", "#7a6f8d", "#ce4472", "#4c7494", "#b085b6", "#6c4c8c", "#eba556", "#7c81e5", "#87e089", "#7bb3eb", "#7a6f8d", "#ce4472", "#4c7494", "#b085b6", "#6c4c8c", 
        "#7bb5eb", "#eba756", "#7c83e5", "#87e389", "#7a8f8d", "#ce4475", "#4c7496", "#b385b6", "#6c8c8c", "#eba856", "#7c85e5", "#87e069", "#5bb3eb", "#7a3f8d", "#ce4475", "#4c7498", "#b085b9", "#6c8c8c",
        "#7bb7eb", "#eba956", "#7c85e5", "#87e689", "#7a4f8d", "#ce4477", "#4c7498", "#b585b6", "#6c4c5c", "#eba606", "#7c85e1", "#87e049", "#3bb3eb", "#7a0f8d", "#ce4479", "#4c7454", "#b085b3", "#6c6c8c",
        "#7bb9eb", "#eba626", "#7c87e5", "#87e989", "#7a0f8d", "#ce4479", "#4c7594", "#b885b6", "#6c4c2c", "#eba706", "#7c83e2", "#87e029", "#1bb3eb", "#7a9f8d", "#ce4422", "#4c7594", "#b085b0", "#6c0c8c"
    ]
    var getPercentage = function( arr, val ){
        var max=0;
        for(var i=0; i<arr.length; i++){
            if(arr[i].total_values*1 > max){max = arr[i].total_values};
        }
        var avrg = max/100;
            // console.log(arr[0].category_name, 'val', val, 'max', max)
        return Math.floor( (val*1) / avrg );
    }
    
var __ = this;

var app = angular.module('app', ['ckeditor']);//
app.controller('ctrl', function($scope, $http, $location, $timeout, $window, uploadFile_service, $q) {
	$scope.filesInfo={}
	$scope.files={"polls":[], "options":[]};
    $scope.deletedphotos = [];
	$scope.error_messages = [];
	$scope.app_folder = '<?=$app_folder?>';
	$scope.currlang = '<?=$currlang?>';
	$scope.path = '<?=$path?>';
	$scope.currlangid = '<?=$currlangid?>';
	$scope.userdt  = {"userInfo":null};
	$scope.currUrl  = window.location.href;
	$scope.dmn = window.location.origin;
    $scope.list = {polls:[], exams:[], scores:[]}
    $scope.rec = {poll:{}, exam:{}, result:{id:-1, result_photos:''}, tag:{}}
    $scope.searchRes=[];
    $scope.tags=[];
    $scope.notifications = {'total':0}

    $scope.sort=[];
    $scope.paging={};
    $scope.selected = {};
    $scope.selectAll=false;
    $scope.statistics={};
    $scope.isExpanded=[];
    $scope.ipUrl='https://whatismyipaddress.com/ip';

    $scope.search = {
        tar: '<?=$this->request->getQuery('tar')?>',
        from: '<?=$this->request->getQuery('from')?>',
        to: '<?=$this->request->getQuery('to')?>',
        key: '<?=$this->request->getQuery('key')?>',
    };
    $scope.ckoptions={
        language: '<?=$currlang?>',
        startupOutlineBlocks : true,
        forcePasteAsPlainText : true,
        toolbar:[
            [ 'Source', 'ShowBlocks' ],
            [ 'BidiLtr', 'BidiRtl' ],
            [ 'Bold', 'Italic', 'Underline','Strike','Subscript','Superscript','-','RemoveFormat' ],
            [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            [ 'Link','Unlink','Anchor' ],
            [ 'Format','Styles','Font' ],
        ]
    }
    $scope.ckoptions_min={
        language: '<?=$currlang?>',
        startupOutlineBlocks : true,
        forcePasteAsPlainText : true,
        toolbar:[
            [ 'Source', 'ShowBlocks' ],
            [ 'Link','Unlink','Anchor' ]
        ],
        height :'70'
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

    var act = '<?=strtolower($this->request->getParam('action'))?>';
    var ctrl = '<?=strtolower($this->request->getParam('controller'))?>';
    $scope.newEntity = function(tar, params){
        var dt = {
            "poll": {"id":-1, "poll_title":"", "poll_text":"", "poll_configs":{"expireDate":"0"}},
            "option": {"id":-1, "option_text":"", "option_photo":null, "option_configs": 	{"isCorrect":0}}
            }
        if(params != undefined){ 
            for(let k in params){
                if(k=='id'){params[k] = -Math.abs(params[k]);}
                dt[tar][ k ] = params[k];
            }
        }
        return dt[tar]
    }

    // $scope.getPercentage = function( arr, val ){
    //     var max=0;
    //     for(var i=0; i<arr.length; i++){
    //         if(arr[i].total_values*1 > max){max = arr[i].total_values};
    //     }
    //     var avrg = max/100;
    //         // console.log(arr[0].category_name, 'val', val, 'max', max)
    //     return Math.floor( (val*1) / avrg );
    // }
    // style="
    //                   width: {{ getPercentage( statistics.exams.items, exam.total_values ) }}%;
    //                   background: {{clrs[$index]}}
    //                   "
    
    $scope.toImage = function(tar){
        html2canvas(document.querySelector(tar)).then(canvas => {
            $('#imgHolder').html('<img src="'+canvas.toDataURL("image/png")+'"><i class="fa fa-times" aria-hidden="true"></i>');
            $('#imgHolder').attr("style","opacity: 1; z-index:999;");
        })
    }

    $scope.DtSetter = function(tar, val){
        var defines = {
            'bool':{0: '<?=__('disabled')?>', 1: '<?=__('enabled')?>'},
            'rec_state':{0: '<?=__('disabled')?>', 1: '<?=__('enabled')?>'},
            'language_id': JSON.parse('<?=json_encode( $this->Do->lcl( $this->Do->get('langs') ) )?>'),
        }
        if(defines[tar]){
            if(defines[tar][val]){
                return defines[tar][val];
            
            }return defines[tar];
        }
        return val;
    }

    const nToArray = function(num) {
        var arr = [];
        for(var i=0; i<num; i++){ arr[i] = i }
        return arr;   
    }

    $scope.pager = function(total, curr){
        var arr = nToArray(total).slice(curr, curr+3)
        if(curr > 1){arr.unshift(curr-1)}
        if(curr > 2){arr.unshift(curr-2)}
        return arr;
    }

    $scope.chkAll = function(tar, val){
        var all = $(tar+" input");
        for(var i =0; i<all.length; i++){
            $(all[i]).prop('checked', val)
            $scope.selected[ $(all[i]).val() ] = val
        }
    }

    $scope.multiHandle = function(url, tar){
        
            !tar ? tar = '.chkb' : tar;
            !url ? url = $scope.path+'/'+$scope.currlang : $scope.path+'/'+$scope.currlang+url;

        var ctrl = '<?=strtolower( $this->request->getParam('controller') )?>';
        var page_url = window.location.href.split('admin')[1];
        var msg = '<?=__('delete_selected_records')?>';
        var ids = [];

        if(url.indexOf('/enable/1')>-1){ msg = '<?=__('enable_selected_records')?>' }
        if(url.indexOf('/enable/0')>-1){ msg = '<?=__('disable_selected_records')?>' }
        
        if(confirm(msg)){
            for( var itm of $(tar+" input:checked") ){
                ids.push($(itm).val())
            }
            callAction(url+'/'+ids.join(), "delete").then(function(res){
                if(res.data.status == "SUCCESS"){
                    showPNote('<?=__('note-message')?>', '<?=__('send-success')?>', 'success');
                    setTimeout(function(){
                        // window.location.href = window.location.href;
                        $scope.doGet('/admin'+page_url , 'list', ctrl);
                    }, 1000)
                }else{
                    showPNote('<?=__('note-message')?>', '<?=__('send-fail')?>', 'error');
                }
            })
        }
    }

    $scope.toElm  = function(tar) {
        !tar ? tar = 'body' : (tar[0] != '#' || tar[0] != '.' ? tar = '#'+tar : tar)
        var elmTarget = $(tar).offset().top;
        $("html").animate({
           scrollTop: elmTarget
        }, 1000);
    }
    $scope.isPhoto = function(photo){
//        app_folder+'/img/options_photos/thumb/' ? 'image-placeholder.jpg' : option.option_photo
        if(photo<-1 || photo == '' || photo == null){
            return false;
        }
        return true;
    }
    $scope.chkImage = function(photo, noimg){
        !noimg ? noimg = 'image-placeholder.jpg' : noimg;
        if(photo<-1 || photo == '' || photo == null){
            return noimg;
        }
        return photo;
    }
	var _setCvrBtn = function(tar ,param){
		var elm = $( "#"+tar+ " span" );
		if(param==1){ 
			elm.html('<i class="fa fa-refresh fa-spin fa-fw"></i>');
			$("#"+tar.replace("_cvr","")).css("pointer-events", "none");
			$("#"+tar).attr("disabled", true);
		}else{ 
			elm.html('<i class="fa fa-save"></i>');
			$("#"+tar.replace("_cvr","")).css("pointer-events", "all");
			$("#"+tar).attr("disabled", false);
			// $("#"+tar.replace("_cvr","")).attr("disabled", false);	
		}
	}
	
	var _getExt = function(fileext){
        var ext = fileext.split('/')[1];
		switch(ext){
			case 'jpg':
			case 'jpeg':
				return 'jpg';
			break;
			case 'plain':
				return 'txt';
			break;
			default:
				return ext;
		}
	}
	
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
        if(form_name.indexOf("poll_form") == 1){
            $(".error-message").text('');
        }
        for(var prop in obj) {
            var value = obj[prop];
            var arr = $.map(value, function(val, index) {
                return [val];
            });
            var elm = $( '#'+form_name+' [name="'+prop+'"]' )[0];
            if(elm){
                _setError(elm ,arr[0])
            }
        }
    }
    
    var _getUpdate = function(tar){
        return $("#"+tar).click()
    }

    $scope.updt = function(tar){
        setTimeout(function(){
            return _getUpdate(tar)
        },1)
    }
        
	var currDate = _setDate();
	$scope.setDate = function(dt, p){
		return _setDate(dt, p)
	}
    
	var _setShare = function(tar){
		var pageUrl = document.URL;
		var title = document.title;
		var p = document.getElementsByTagName("article")[0].innerHTML;
		var url = '';
		if(tar == 'facebook'){
			url = decodeURI('https://www.facebook.com/sharer/sharer.php?u='+pageUrl);
		}
		if(tar == 'twitter'){
			url = decodeURI('https://twitter.com/home?status='+pageUrl);
		}
		if(tar == 'google-plus'){
			url = decodeURI('https://plus.google.com/share?url='+pageUrl);
		}
		if(tar == 'linkedin'){
			url = decodeURI('https://www.linkedin.com/shareArticle?mini=true&url='+pageUrl+'&title='+title+'&summary='+p+'&source='+pageUrl);
		}
		if(tar == 'pinterest'){
			url = decodeURI('https://pinterest.com/pin/create/button/?url='+pageUrl+'&media='+p+'&description='+p);
		}
		if(tar == 'email'){
			url = 'mailto:email';
		}
		return url;
	}
    $scope.openWin = function(tar){
		var urlTar = _setShare(tar);
		var conf = "directories=no, menubar=no, status=no, location=no, titlebar=no, toolbar=no, scrollbars=no, width=700, height=400, resizeable=no, top=150, left=250";
		var popup=window.open(urlTar, '_blank', conf); 
    }

	$http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
	
    var headers = { 
            'X-CSRF-Token' : '<?=$this->request->getCookie('csrfToken')?>',
            'Accept': 'application/json',
            'Content-Type': 'application/json' 
        }

	var callAction = function(url, type, obj){
        
		!type ? type='get' : type;
		!obj ? obj=null : obj;
        url.indexOf($scope.currlang) > -1 ? url : url =  '/'+$scope.currlang+url
        url.indexOf($scope.app_folder) > -1 ? url : url =  $scope.app_folder+url
        
		if(type == 'get'){
			var requestObj = {
					method  : type, 
					url     : url+(url.indexOf('?')>-1 ? '&' : '?')+ "ajax=1"
				}
		}else{
			var requestObj = {
					method  : type, 
					url     : url+(url.indexOf('?')>-1 ? '&' : '?')+ "ajax=1", 
					data    : obj, 
					headers : { 
						// 'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8',
						'X-CSRF-Token' : '<?=$this->request->getCookie('csrfToken')?>',
						'Accept': 'application/json',
                		'Content-Type': 'application/json',
					}
				}
		}
		return $http(requestObj)
	}

	$scope.callAction = function(url, type, obj){
        return callAction(url, type, obj)
    }
    
    $scope.getStatistics = function(tar, params, from, to){
        !from ? from = '<?=$this->request->getQuery('from')?>' : from;
        !to ? to = '<?=$this->request->getQuery('to')?>' : to;

        !tar ? tar = '' : tar = '_'+tar;
        !params ? params = 0 : params = params;
        
        callAction('/configs/statistics'+tar+'/'+params+'?from='+from+'&to='+to).then(function(res){
            if(res.data.status == 'SUCCESS'){
                $scope.statistics = res.data.data;
            }else{
                console.log(res)
            }
        })
    }

    $scope.clrs = clrs;

    var addSeperator = function(n){
        return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }
    $scope.addSeperator = function(n){
        return addSeperator(n)
    }
    
    var _doRequest = function(url, obj, method){
        
		!method ? method='get' : method;
		!obj ? obj=null : obj;

        url.indexOf($scope.currlang) > -1 ? url : url =  '/'+$scope.currlang+url
        url.indexOf($scope.app_folder) > -1 ? url : url =  $scope.app_folder+url
        
        var requestObj = {
                method  : method, 
                url     : url + (url.indexOf('?')>-1 ? '&' : '?') + "ajax=1", 
                data    : obj, 
                headers : headers
            }
        
		return $http(requestObj)
	}

    $scope.doGet= function(url, type, tar){
        !type ? type='list' : type
        _doRequest(url, null, 'get').then(function(res){
            if(type=='list'){
                $scope.list[tar] = res.data.data;
                if(res.data.paging){
                    $scope.paging = res.data.paging
                }
            }else{
                $scope.rec[tar] = res.data.data
            }
        })
    }

    $scope.getNotifications = function(){
        callAction('/configs/notifications').then(function(res){
            if(res.data.status == 'SUCCESS'){
                $scope.notifications = res.data.data
            }else{
                console.log(res)
            }
        })
    }
    // $scope.getNotifications = function(total){
    // Long-Polling
    //     callAction('/configs/notifications?total='+total+'&rand='+Math.random()*999).then(function(res){
            
    //         if(res.data.status == 'SUCCESS'){
    //             $scope.notifications = res.data.data
    //         }else{
    //             console.log('error', res.data)
    //         }
            
    //         $timeout( function() {
    //             $scope.getNotifications( $scope.notifications.total );
    //         }, 2000);
    //     });
    // }

    // var source=false;
    // $scope.getNotifications = function(stat){
    //     if(stat==1){
    //         source = new EventSource('<?=$app_folder?>/sse/notifications.php?uid=<?=$authUser['id']?>&lastlogin=<?=$authUser['stat_lastlogin']?>');
    //         source.onopen = function() {
    //             console.log('connection to stream has been opened');
    //         };
    //         source.onerror = function (error) {
    //             console.log('An error has occurred while receiving stream', error);
    //         };
    //         source.onmessage = function (stream) {
    //             $scope.notifications = JSON.parse( stream.data )
    //             console.log('Message delivered', $scope.notifications);
    //             $scope.$apply()
    //         }; 
    //     }else{
    //         if(typeof source == 'object'){source.close();} 
    //     }
    // }
    // $timeout(function(){
    //     if(!source){
    //         $scope.getNotifications(1); console.log('init');
    //     }
    // //     $window.onfocus = function() {
    // //         $scope.getNotifications(1); console.log('in');
    // //     }; 
        
    // //     $window.onblur = function() {
    // //         $scope.getNotifications(0); console.log('out');
    // //     };
    // }, 1000)

    $scope.saveResult = function(){
        
		_setCvrBtn('result_btn', 1);
        
        $scope.rec.result.exam_id = $scope.examId;
        $scope.rec.result.photos = $scope.filesInfo['result_photos'];
        var _url = '/admin/results/save/'+$scope.rec.result.id;
        callAction(_url, 'post', $scope.rec.result).then(function(res){
            _setCvrBtn('result_btn', 0);
            if(res.data.status == "SUCCESS"){
                if(!res.data.uploadedPhoto && $scope.filesInfo['result_photos']){
                    showPNote('<?=__('note-message')?>', '<?=__('photo_upload').' '.__('upload-fail')?>', 'error');
                }
                $scope.getRec('/admin/exams/view/'+$scope.examId, 'exam');
                $scope.rec.result = {id:-1, result_photos:''};
                $scope.filesInfo['result_photos'] = '';
            }else{
                _getErrors(res.data.data, "result_form");
            }
        })
    }
    
    
    var _filter = function(val) {
        if (typeof(val)!="string") return val;
        return val
          .replace(/[\"]/g, '\\"')
          .replace(/[\\]/g, '\\\\')
          .replace(/[\/]/g, '\\/')
          .replace(/[\b]/g, '\\b')
          .replace(/[\f]/g, '\\f')
          .replace(/[\n]/g, '\\n')
          .replace(/[\r]/g, '\\r')
          .replace(/[\t]/g, '\\t')
        ; 
    }
    $scope.doFilter = function(){
        var url = [];
        angular.forEach($scope.search, function(v, k){
            if(v){ url.push( k+'='+v ) }
        })
        $scope.goTo('/admin/'+ctrl+'/'+act+'?'+url.join('&'))
    }
    $scope.savePollWithOptions = function(obj, formTarget){
		var funcScope = this;
		funcScope.optionsFiles = $scope.files.options;
		_setCvrBtn(formTarget+'_cvr', 1);
        
        // upload photo
		var filename = new Date().getTime();
		if($scope.files.polls.length>0){
			_uploadFile ( $scope.files.polls[0], filename, obj.seo_image, 'polls').then(function(upRes){
                if(upRes.status != "SUCCESS"){
                    obj.seo_image = null
                    callAction('/admin/polls/save/'+obj.id, "post", obj)
                    showPNote('<?=__('note-message')?>', '<?=__('photo_upload').' '.__('upload-fail')?>', 'error');
                }
            });
            obj.seo_image = filename+'.'+_getExt($scope.files.polls[0].type);
		}
        
        // delete deleted photos
        if($scope.deletedphotos.length>0){
            var url = "/configs/delfiles"
            callAction(url, "post", $scope.deletedphotos).then(function(res){
                $scope.deletedphotos=[]
            })
        }
           
        if($scope.examId!=undefined){
            obj.language_id = $scope.langId;
            obj.exam_id = $scope.examId;
        }
        // save poll 
		callAction('/admin/polls/save/'+obj.id, "post", obj).then(function(res){
            
			if(res.data.status == "SUCCESS"){
                if(obj.id == -1){
                    _setCvrBtn(formTarget+'_cvr', 0);
                    $scope.getRec('/admin/exams/view/'+obj.exam_id, 'exam');
                    showPNote('<?=__('note-message')?>', '<?=__('poll').' '.__('save-success')?>', 'success');
                    return;
                }
				var pollid = res.data.data.id
                var polltype = res.data.data.poll_type
				/// LOOP INTO OPTIONS
				angular.forEach(obj.options, function(option, k){
					option.poll_id = pollid;
					option.poll_type = polltype;
					// UPLOAD OPTION PHOTO
					if(typeof funcScope.optionsFiles[k] != 'undefined'){
						var filename = new Date().getTime()+k;
						_uploadFile ( funcScope.optionsFiles[k][0], filename, option.seo_image, 'options').then(function(upRes){
                            if(upRes.status != "SUCCESS"){
                                option.option_photo = null;
                                callAction('/admin/options/save/'+option.id, "post", option)
                                showPNote('<?=__('note-message')?>', '<?=__('photo_upload').' '.__('upload-fail')?>', 'error');
                            }
                        });
                        option.option_photo = filename+'.'+_getExt(funcScope.optionsFiles[k][0].type);
					}
                    
                    // save option
                    option.option_configs = JSON.stringify(option.option_configs);
					callAction('/admin/options/save/'+option.id, "post", option).then(function(optRec){
                        if(optRec.data.status == "SUCCESS"){
                            showPNote('<?=__('note-message')?>', '<?=__('option').' '.__('save-success')?>', 'success')
                        }else{
                            _getErrors(optRec.data.data, "option_form_"+k);
                            showPNote('<?=__('note-message')?>', '<?=__('option').' '.__('save-fail')?>', 'error')
                        }
                        optRec={}
					})
				})
				setTimeout(function() {
                    $scope.getRec('/admin/exams/view/'+$scope.examId, 'exam');
					showPNote('<?=__('note-message')?>', '<?=__('poll').' '.__('save-success')?>', 'success')
					_setCvrBtn(formTarget+'_cvr', 0);
                    $scope.filesInfo = {}
				}, 1000);
			}else{
				showPNote('<?=__('note-message')?>', '<?=__('save-fail')?>', 'error');
                _getErrors(res.data.data, formTarget);
                _setCvrBtn(formTarget+'_cvr', 0);
			}
		})
		$scope.files={"polls":[], "options":[]}
	}
    
    $scope.saveOptions = function(obj, formTarget){
		var funcScope = this;
		funcScope.optionsFiles = $scope.files.options;
		_setCvrBtn(formTarget+'_cvr', 1);
        console.log(obj.options);
        /// LOOP INTO OPTIONS
        angular.forEach(obj.options, function(option, k){

            // UPLOAD OPTION PHOTO
            if(typeof funcScope.optionsFiles[k] != 'undefined'){
                var filename = new Date().getTime()+k;
                _uploadFile ( funcScope.optionsFiles[k][0], filename, option.seo_image, 'options');
                option.option_photo = filename+'.'+_getExt(funcScope.optionsFiles[k][0].type);
            }

            // SAVE OPTION
            option.option_configs = JSON.stringify(option.option_configs);
            callAction('/admin/options/save/'+option.id, "post", option).then(function(optRec){
                if(optRec.data.status == "SUCCESS"){
                    showPNote('<?=__('note-message')?>', '<?=__('option').' '.__('save-success')?>', 'success');
                }else{
                    _getErrors(optRec.data.data, "option_form_"+k);
                    showPNote('<?=__('note-message')?>', '<?=__('option').' '.__('save-fail')?>', 'error')
                }
                optRec={}
            })
        })
        setTimeout(function() {
            _getUpdate(formTarget)
            _setCvrBtn(formTarget+'_cvr', 0);
        }, 1000);
		$scope.files={"polls":[], "options":[]}
	}
    
	$scope.getRec = function(url, obj){
		callAction(url, "get", obj).then(function(res){
			$scope.rec[obj] = (res.data)
            $scope.rec[obj].poll_type = $scope.rec[obj].poll_type+''
		})
	}
    
	$scope.doSave = function(url, obj, formName, doUpdate){
        
		_setCvrBtn(formName+'_cvr', 1)
		var currTable = formName.split("_");
		var filename = new Date().getTime();
		if(currTable[0] == 'poll'){
			if($scope.files.polls.length>0){
				_uploadFile ( $scope.files.polls[0], filename, obj.seo_image, 'polls');
				obj.seo_image = filename+'.'+_getExt($scope.files.polls[0].type);
			}
		}else{
			if($scope.files.options.length>0){
				_uploadFile ( $scope.files.options[0], filename, obj.option_photo, 'options');
				obj.option_photo = filename+'.'+_getExt($scope.files.options[0].type);
			}
		}
		$scope.files={"polls":[], "options":[]}
        
		callAction(url, "post", obj).then(function(res){
			_setCvrBtn(formName+'_cvr', 0)
			if(res.data.status == "SUCCESS"){
				showPNote('<?=__('note-message')?>', '<?=__('save-success')?>', 'success');
				if(doUpdate){
                    if(doUpdate.length > 10){
                        window.location.href = doUpdate+"/"+res.data.data.id;
                        return ;
                    }
					_getUpdate( doUpdate )
				}
			}else{
				showPNote('<?=__('note-message')?>', '<?=__('save-fail')?>', 'error')
			}
			if(formName){
				_getErrors (res.data.data, formName)
			}
		})
	}
    
	$scope.doDelete = function(url, doUpdate){
        if(confirm("<?=__('delete_confirm')?>")){
            callAction(url, "post").then(function(res){
                if(doUpdate){ _getUpdate(doUpdate) }
            })
        }
	}
    
	var showPNote = function(_title, _msg, _type, _isHide){
        
		!_title ? _title="Sticky Message" : _title; 
		!_msg ? _msg="Empty Message" : _msg;
		!_type ? _type="danger" : _type;
		!_isHide ? _isHide=true : _isHide;
        const stack = {dir1: 'up', dir2: '<?=$currlang=='ar' ? 'right' : 'left'?>', firstpos1: 25, firstpos2: 25, push: 'top', context: $(document.body)}
		return new PNotify({
						title: _title,
						text : _msg,
						type : _type,
						hide : _isHide,
						styling: 'bootstrap3',
                        stack: stack
						// addclass: 'dark'
					});
	}
    
	$scope.goTo = function(path, ext=null){
		if(ext == 'param'){return window.location.href = window.location.pathname+path }
		if(ext){return window.open($scope.dmn+$scope.app_folder+path)}
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
    
	$scope.searchTags = function (val){
        if(val.length>1){
            callAction('/ar/admin/tags/search/'+val).then(function(res){
                $scope.searchRes = res.data
            })
        }else{
            $scope.searchRes=[]
        }
    }
    
    $scope.add_tag = function(tar, tag){
        if($scope.tags.length>=3){
            showPNote('<?=__('note-message')?>', '<?=__('tags_only_three')?>', 'error');
            return;
        }
        if($scope.tags.join().indexOf(tag)>-1){ 
            showPNote('<?=__('note-message')?>', '<?=__('tag_already_exist')?>', 'error');
            return; }
        $scope.tags.push(tag)
        $(tar).val($scope.tags)
    }
    $scope.remove_tag = function(tar, ind){
        $scope.tags.splice(ind, 1);
        $(tar).val($scope.tags)
    }

    /////////// Upload Photo ///////////////
	var _uploadFile = function( file, fileName, deleteFile, pth){
		!fileName ? fileName=new Date().getTime() : fileName;
		!deleteFile ? deleteFile='' : deleteFile;
		!pth ? pth='polls' : pth;
		var url = $scope.app_folder+"/"+$scope.currlang+"/configs/upld?fname="+fileName+"&del="+deleteFile+"&pth="+pth
        return uploadFile_service.uploadFileToUrl(file, url, fileName)
	}
	// $scope.uploadFile = function( file, fileName, deleteFile, pth){
    //     return _uploadFile(file, fileName, deleteFile, pth);
    // }
	/////////// End Upload Photo ///////////////



	/////////// Real Time Server Sent Event ///////////////
            // var source=false;
            // function getNotification (stat) {
            //     if(stat==1){
            //         source = new EventSource('<?=$app_folder?>/configs/notifications');;
            //         // source = new EventSource('../_snippets/server-sent-events/server.php');
            //         source.onopen = function() {
            //             console.log('connection to stream has been opened');
            //         };
            //         source.onerror = function (error) {
            //             console.log('An error has occurred while receiving stream', error);
            //         };
            //         source.onmessage = function (stream) {
            //             $scope.notifications = JSON.parse( stream.data )
            //             console.log('Message delivered', $scope.notifications);
            //             $scope.$apply()
            //         }; 
            //     }else{
            //         if(typeof source == 'object'){source.close();} 
            //     }
            // }
            // if(!source){
            //     getNotification(1); console.log('init');
            // }
            // $window.onfocus = function() {
            //     getNotification(1); console.log('in');
            // }; 
            
            // $window.onblur = function() {
            //     getNotification(0); console.log('out');
            // };
	/////////// Real Time Server Sent Event END ///////////////
});


// DIRECTIVE //////////////////////////////////////////////////////
app.directive('setFixed', ['$window', function ($window) {
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


app.directive('setPercentage', function () {
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {
            var inf = JSON.parse( attrs.setPercentage )
			$(element).attr( 'style', 'width: '+ getPercentage( inf[0], inf[1] ) +'%; background: '+clrs[ inf[2] ] )
		}
	};
});
app.directive("showPassword", ['$timeout', function ($timeout) {
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
app.directive('chk', function () {
    return {
        scope: {chk: '@'},
        link: function (scope, element, attrs, ctrl) {
			element.bind('blur', onBlur);
			function onBlur(ctrl){
				if(attrs.type == 'checkbox' || attrs.type == 'radio'){
					var newid = attrs.id.substr(0, attrs.id.length-1);
					var elms = document.querySelectorAll('[id^='+newid+']');
					for(var i in elms){
						if(elms[i].checked == true){
							return _setError(element[0] , '', true);
						}else{
							_setError(element[0] ,errorMsg[scope.chk]);
						}
					}
				}else{
					if ( ptrn[scope.chk].test(element[0].value) ) {
						_setError(element[0] , '', true);
					} else {
						_setError(element[0] ,errorMsg[scope.chk]);
					}
				}
				scope.$apply();
			}
        }
    };
});
app.filter('urlcrypt', function() {
    return window.decodeURIComponent;
});
//app.directive('tooltip', function(){
//    return {
//        restrict: 'A',
//        link: function(scope, element, attrs){
//            element.hover(function(){
//                // on mouseenter
//                element.tooltip('show');
//            }, function(){
//                // on mouseleave
//                element.tooltip('hide');
//            });
//        }
//    };
//});
app.directive('closeAccordions', function(){
    return {
        restrict: 'A',
        link: function(scope, element, attrs){
            element.bind('click', function(){
				$(".panel .panel-collapse").removeClass("show")
            });
        }
    };
});
app.directive('delError', function(){
    return {
        restrict: 'A',
        link: function(scope, element, attrs){
            element.focus(function(){
                var errorElm = $(element).parent();
                $(".error-message", errorElm).html('')
            });
        }
    };
});

app.directive('datePicker', function( ){
    return {
      restrict: "A",
      scope: false,
      link: function($scope, $element, $attr){

        $($element).daterangepicker({
            // singleDatePicker:true,
            // showOn: "button",
            cancelText: 'Clear',
            autoUpdateInput: false,
            locale: {
                format: "YYYY-MM-DD",
            },
            // timePicker: true,
            // startDate: moment().subtract('days', 1),
            // endDate: new Date(),          
            // buttonClasses: ['btn-primary'],
        }, function(start, end) {
            window.location.href = window.location.href.split('?')[0]+'?from='+_setDate(start._d, false, 'onlydate')+'&to='+_setDate(end._d, false, 'onlydate')
            // console.log( _setDate(start._d, 'onlydate'),  _setDate(end._d));
            // $scope.date = {from: from, to: to};
            // $scope.$apply(); // I need apply() here to use the two-way-databinding
        });
        $($element).on('cancel.daterangepicker', function(ev, picker) {
            window.location.href = window.location.href.split('?')[0]
        });
      }
    }
});

app.directive('setChart', function ($timeout) {

return {
    restrict: 'A',
    link: function(scope, elem, attr, ctrl) {
        
        var addSeperator = function(n){
            return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") || '' 
        }
        var chart, ctx;
        scope.$watch('statistics', function (old, newVal) {

            var type = !attr.setChart ? 'pie' : attr.setChart;
            var dt = scope.statistics[attr.dt];
            var unit = !attr.unit ? '<?=__('piece')?>' : attr.unit;
            var islegend = !attr.islegend ? false : true;
        
            var dtSet = [];
            var allLabels = [];
            var vals = [];
            
            var height = document.body.clientHeight;
            var width = document.body.clientWidth;

            if(!dt){  return false; }
                
            if('bar,line'.indexOf(type) > -1){
                if(typeof dt.items[0].labels === 'undefined'){
                    dtSet.push( {
                        data: Object.values( dt.values ),
                        borderColor: type == 'line' ? clrs[0] : clrs,
                        backgroundColor: type == 'line' ? false : clrs
                    } );
                    allLabels = dt.labels
                }else{
                    for(var i=0; i<dt.items.length; i++){
                        for(var j=0; j<dt.items[i].labels.length; j++){
                            if( allLabels.indexOf(dt.items[i].labels[j]) == -1 ){ allLabels.push( dt.items[i].labels[j] ); }
                        }
                        dtSet.push( {
                            label: dt.items[i].label,
                            data: dt.items[i].values,
                            borderColor: clrs[i],//type == 'line' ? false : clrs,,
                            backgroundColor: type == 'line' ? false : clrs[i]
                        } )
                    }
                }
            }else{
                allLabels = dt.labels
                dtSet = [ {
                    label: dt.label,
                    data: dt.values,
                    backgroundColor: clrs
                } ]
            }
            var options = {
                type: type,//bar,pie,doughnut,polarArea,bubble,scatter,radar
                data: {
                    labels: allLabels,
                    backgroundColor: '#fff',
                    datasets: dtSet
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    responsive: true,
                    legend: {
                        display: (width<1200 || islegend) ? false : true,
                        position: 'bottom',
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItems, data) {
                                if('bar,line'.indexOf(type) === -1){
                                    var content = [
                                        data.labels[tooltipItems.index] || '',
                                        addSeperator( data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index] )+' '+unit,
                                    ]
                                    return content;
                                }else{
                                    var content = [
                                        data.datasets[tooltipItems.datasetIndex].label || '',
                                        addSeperator( data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index] )+' '+unit,
                                    ]
                                    return content;
                                }
                            }
                        }
                    },
                }
            }

            if (chart) {
                chart.destroy();
            }
            ctx = document.getElementById( elem[0].id ).getContext('2d');
            chart = new Chart(ctx, options);
            
            if(JSON.stringify(old) !== JSON.stringify(newVal)){
                chart.update()
            }
            
        });
    }
}
});
app.directive('fileModel', ['$parse', function ($parse) {
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
                    //console.log(changeEvent.target.files)
                    modelSetter($scope, [ element[0].files[0] ]);
                });
            });
        }
    };
}]);
app.service('uploadFile_service', ['$http', function ($http) {
	return {
		uploadFileToUrl : function(file, uploadUrl, name){
            console.log("file--", file, uploadUrl, name);
			var fd = new FormData();
			fd.append('file', file);
			fd.append('name', name);
			console.log("fd--", fd);
			return $http.post(uploadUrl, fd, {
				 transformRequest: angular.identity,
				 headers: {
					 'Content-Type': undefined,
					 'Process-Data': false,
					 'X-CSRF-Token' : '<?=$this->request->getCookie('csrfToken')?>'
					 }
			}).then(function(res){
				 return res.data
			});
		}
	}
}]);
app.directive('clickOutside', function ($document) {
    return {
        restrict: 'A',
        link: function(scope, elem, attr, ctrl) {
            elem.bind('click', function(e) {
                e.stopPropagation();
            });
            $document.bind('click', function() {
                scope.$apply(attr.clickOutside);
            })
        }
    }
});
    
})()
</script>
</body>
</html>
