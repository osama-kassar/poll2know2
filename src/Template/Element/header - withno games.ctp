<?php 
    $ctrl = $this->request->getParam("controller");
    $actn = $this->request->getParam("action");
    $currUrl = $ctrl.'/'.$actn;
?>


<!--  WEB HEADER  -->
<header id="stickyHeader" class="header-area header-one header-desktop">
    
    <!-- // Top bar  -->
    <div class="header-mini bg-top-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-5">
                    <div class="navbar-lang">
                        <div class="dropdown"> 
                            <?=$this->element('langList')?>
                        </div>
                        <div class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle">
                            <?=__("categories")?>
                            </a>
                            <div class="dropdown-menu">
                                
                                <?php 
                                    foreach($c_list as $itm){
                                        if($itm->total_related > 0){
                                            echo $this->Html->link(__($itm->category_name)." (".$itm->total_related.")", ["controller"=>"Categories", "action"=>"index", __($itm->category_name), $itm->id], ["class"=>"dropdown-item"]);
                                        }
                                    }
                                ?>
                                
                                
                                <?php /*?>
                                <?=$this->Html->link('<i class="fas fa-question-circle"></i> '.__("polls"), ["controller"=>"Polls", "action"=>"index"], ["class"=>"dropdown-item", "escape"=>false])?>
                                <?=$this->Html->link('<i class="fas fa-graduation-cap"></i> '.__("exams"), ["controller"=>"Exams", "action"=>"index"], ["class"=>"dropdown-item", "escape"=>false])?>
                                <?php */?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="pro-header-options">
                        <?php if($authUser){?>
                        <div class="dropdown"> <a class="pro-avatar"><?=__('welcome')?> <?=$authUser['user_fullname']?></a> </div>
                        <div class="dropdown"> 
                            <a href="javascript:void(0);" class="dropdown-toggle"><?=__('my_account')?></a>
                            <div class="dropdown-menu"> 
                                <?=$this->Html->link(__('my_polls'), ["controller"=>"Polls", "action"=>"me"], ["class"=>"dropdown-item"])?>
                                <?=$this->Html->link(__('my_exams'), ["controller"=>"Exams", "action"=>"me"], ["class"=>"dropdown-item"])?>
                                <?=$this->Html->link(__('poll_i_did'), ["controller"=>"Polls", "action"=>"done"], ["class"=>"dropdown-item"])?>
                                <?=$this->Html->link(__('exams_i_did'), ["controller"=>"Exams", "action"=>"done"], ["class"=>"dropdown-item"])?>
                                <?=$this->Html->link(__('total_points'), ["controller"=>"Users", "action"=>"points"], ["class"=>"dropdown-item"])?>
                                <?=$this->Html->link(__('logout'), ["controller"=>"Users", "action"=>"logout"], ["class"=>"dropdown-item"])?>
                            </div>
                        </div>
                        <?php }else{?>
                        <div class="white-link"> 
                            <span><?=__('welcome')?></span>,
                            <span><?=$this->Html->link(__('register_login').' <i class="fas fa-sign-in-alt"></i> ', 
                                ["controller"=>"Users", "action"=>"login"], 
                                ["escape"=>false, "data-toggle"=>"modal", "id"=>"login_mdl_btn", "data-target"=>"#login_mdl"])?></span> 
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
<!--    Search , logo and badges bar  -->
    <div class="header-maxi bg-header-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-12 col-lg-2">
                    <?=$this->Html->link( 
                        $this->Html->image('/img/logo.svg', ["alt"=>"poll2know-logo"]),
                        "/".$currlang, ["escape"=>false, "data-toggle"=>"tooltip", "data-placement"=>"bottom", "title"=>__('sitename'), "class"=>"logo"])?>
                </div>
                <div class="col-12 col-sm-8">
                    <?=$this->element('generalSearch')?>
                </div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-2">
                    <ul class="pro-header-right-options">
                        
                        <!-- favorite menu -->
                        <li class="dropdown" data-toggle="tooltip" data-placement="top" title="<?=__('rss')?>">
                            <button class="btn dropdown-toggle" type="button" id="headerOneCartButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                                <i class="fas fa-rss"></i> 
<!--                                <span class="badge badge-secondary">2</span> -->
                            </button>
                            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="headerOneCartButton">
                                <?=$this->element('followus')?>
                            </div>
                        </li>
                        
                        <li class="dropdown" data-toggle="tooltip" data-placement="top" title="<?=__('scores')?>" >
                            <button class="btn dropdown-toggle" type="button" id="headerOneCartButton" data-toggle="dropdown"
                                    ng-click="callAction('/configs/getscores', 'latestScores', 'GET', '', 'star')"> 
                                <span><i class="far fa-star"></i></span> <!--<span class="badge badge-secondary">10</span> -->
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="headerOneCartButton">
                                <?=$this->element('latestScores')?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<!--    MAIN MENU -->
    <div class="header-navbar bg-menu-bar">
        <div class="container">
          <nav id="headerOneNavbar" class="navbar navbar-expand-lg bg-nav-bar">
            
            <div class="navbar-collapse">
              <ul class="navbar-nav">
                  <li class="nav-item <?=$currUrl == 'Exams/index' ? 'active' : ''?>">
                      <?=$this->Html->link('<i class="fas fa-graduation-cap"></i> '. __("exams"), [
                            "controller"=>"Exams",
                            "action"=>"index",
                        ], ["escape"=>false])?>
                  </li>
                  <li class="nav-item <?=$currUrl == 'Polls/index' ? 'active' : ''?>">
                      <?=$this->Html->link('<i class="fas fa-question-circle"></i> '. __("polls"), [
                            "controller"=>"Polls",
                            "action"=>"index",
                        ], ["escape"=>false])?>
                  </li>
                  <li class="nav-item <?=$currUrl == 'Exams/games' ? 'active' : ''?>">
                      <?=$this->Html->link('<i class="fas fa-grin-alt"></i> '. __("games"), [
                            "controller"=>"Exams",
                            "action"=>"games",
                        ], ["escape"=>false])?>
                  </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
</header>
































<!-- //Mobile Header -->
<header id="headerMobile" class="header-area header-mobile">
    <div class="header-mini bg-top-bar">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-12">
                    <div class="navbar-lang">
                        
                        <div class="dropdown"> 
                            <?=$this->element('langList')?>
                        </div>
                        <div class="dropdown top_center"> 
<!--
                            <a href="javascript:void(0);" class="dropdown-toggle">
                            <?=__("main_menu")?>
                            </a>
-->
                            
                            <?=$this->Html->link('<i class="fas fa-graduation-cap"></i> '.__("exams"), ["controller"=>"Exams", "action"=>"index"], ["class"=> ($currUrl == 'Exams/index' ? ' active' : ''), "escape"=>false])?> 
                            
                            <?=$this->Html->link('<i class="fas fa-question-circle"></i> '.__("polls"), ["controller"=>"Polls", "action"=>"index"], ["class"=> ($currUrl == 'Polls/index' ? ' active' : ''), "escape"=>false])?> 
                            
                            <?=$this->Html->link('<i class="fas fa-grin-alt"></i> '.__("games"), ["controller"=>"Exams", "action"=>"games"], ["class"=> ($currUrl == 'Exams/games' ? ' active' : ''), "escape"=>false])?> 
                            
<?php /*?>
                            <div class="dropdown-menu">
                                <?=$this->Html->link('<i class="fas fa-question-circle"></i> '.__("polls"), ["controller"=>"Polls", "action"=>"index"], ["class"=>"dropdown-item". ($currUrl == 'Polls/index' ? ' active' : ''), "escape"=>false])?>
                                <?=$this->Html->link('<i class="fas fa-graduation-cap"></i> '.__("exams"), ["controller"=>"Exams", "action"=>"index"], ["class"=>"dropdown-item". ($currUrl == 'Exams/index' ? ' active' : ''), "escape"=>false])?>
                            </div>
<?php */?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- Sidemenu -->
    <div class="header-maxi bg-header-bar ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-4 pr-0">
                    <div class="navigation-mobile-container"> <a href="javascript:void(0)" class="navigation-mobile-toggler"> <span class="fas fa-bars"></span> </a>
                        <nav id="navigation-mobile">                           
                            <div class="logout-main">
                                <?php if($authUser){?>
                                <div class="welcome"><?=__('welcome')?> <?=$authUser['user_fullname']?></div>
                                <div class="logout">
                                    <?=$this->Html->link(__('logout'), ["controller"=>"Users", "action"=>"logout"])?>
                                </div>
                                <?php }else{?>
                                <div class="welcome"> 
                                    <?=__('welcome')?>, 
                                    <?=$this->Html->link(__('register_login').' <i class="fas fa-sign-in-alt"></i>', 
                                        ["controller"=>"Users", "action"=>"login"], 
                                        ["escape"=>false, "data-toggle"=>"modal", "data-target"=>"#modal_tmplt"])?> 
                                </div>
                                <?php }?>
                            </div>
                            
                            
                            <?php echo $this->Html->link(
                                    '<i class="fas fa-home"></i> '.__('homepage'), 
                                    "/".$currlang, 
                                    ["class"=>"main-manu btn", "escape"=>false])?>
                            
                            <?php echo $this->Html->link(
                                    '<i class="fas fa-question-circle"></i> '.__('exams'), 
                                    ["controller"=>"Exams"], 
                                    ["class"=>"main-manu btn", "escape"=>false])?> 
                            
                            <?php echo $this->Html->link(
                                    '<i class="fas fa-graduation-cap"></i> '.__('polls'), 
                                    ["controller"=>"Polls"], 
                                    ["class"=>"main-manu btn", "escape"=>false])?> 
                            
                            <?php echo $this->Html->link(
                                    '<i class="fas fa-grin-alt"></i> '.__('games'), 
                                    ["controller"=>"Exams", "action"=>"games"], 
                                    ["class"=>"main-manu btn", "escape"=>false])?> 
                            
                            <a class="main-manu btn" data-toggle="collapse" data-target="#homepages" role="button" aria-expanded="false" aria-controls="shoppages"> <i class="fas fa-stream"></i> <?=__('categories')?> </a>
                            <div class="sub-manu collapse show multi-collapse" id="homepages">
                                <ul class="unorder-list">
                                    <li class="">
                                        <?php foreach($c_list as $itm){
                                            if($itm->total_related > 0){
                                            echo $this->Html->link(__($itm->category_name)." ($itm->total_related)", 
                                                ["controller"=>"Categories", "action"=>"index", __($itm->category_name), $itm->id], 
                                                ["class"=>"main-manu btn"]); 
                                            }
                                        }?>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-4">                
                    <?=$this->Html->link( 
                        $this->Html->image('/img/logo.svg', ["alt"=>"poll2know-logo", "class"=>"img-fluid"]),
                        "/".$currlang, ["escape"=>false, "data-toggle"=>"tooltip", "data-placement"=>"bottom", "title"=>__('sitename'), "class"=>"logo"])?>
                </div>
                <div class="col-4 pl-0">
                    <div class="cart-dropdown dropdown"> 
                        <a class="cart-dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    ng-click="callAction('/configs/getscores', 'latestScores', 'GET', '', 'star')"> 
                            <span><i class="fas fa-star" ></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="headerOneCartButton">
                            <?=$this->element('latestScores')?>
                        </div>
                    </div>
                    <div class="cart-dropdown dropdown"> 
                        <a class="cart-dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <i class="fas fa-rss" ></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="headerOneCartButton">
                            <?=$this->element('followus')?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
<!--     MOBILE SEARCH AND BADGES -->
    <div class="header-navbar bg-menu-bar">
        <div class="container">
            <?=$this->element('generalSearch')?>
        </div>
    </div>
</header>

<script>
    
$(document).ready(function(){
    $(document).ready(function() {
        $('.easySelect').easySelect({

              // placeholder text
               placeholder: '<?=__('select_category')?>',
              // color of selected options
              // selectColor: '#414c52',
              // color of placeholder text
              // placeholderColor: '#838383',
              // title of selected options
              // itemTitle: 'Selected items',
              // shows values
              // showEachItem: false,
              // width
              // width: '100%',
              // max height
              dropdownMaxHeight: "100px"

        });
    });
});
</script>

<!--


<div class="dropdown-menu " role="combobox" style="max-height: 731.233px; overflow: hidden; min-height: 107px;">
    
<div class="dropdown-menu show" role="combobox" style="max-height: 734.967px; overflow: hidden; min-height: 107px; position: absolute; transform: translate3d(0px, 44px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="bottom-start">
-->
        
        
        
        
        