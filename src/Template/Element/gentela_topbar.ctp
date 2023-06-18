
<?php
   $from = !isset($_GET['from']) ? date('Y-m-d' ,strtotime('first day of this month')) : $_GET['from'];
   $to = !isset($_GET['to']) ? date('Y-m-d', strtotime("+1 day")) : $_GET['to'];
   ?>

<!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <nav class="nav navbar-nav">
            <ul class=" navbar-right">
            <li class="nav-item dropdown open">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <?=$this->Html->image('/img/user.png', ["class"=>"img-circle ", "alt"=>"..."])?> <span class="hideMob"><?=$authUser["user_fullname"]?></span>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <?php 
                        foreach($userConfigMenu as $itm){
                            echo $this->Html->link("<i class='fa fa-".$itm["icon"]."'></i> ".__($itm["name"]), $itm["url"], ["class"=>"dropdown-item", "escape"=>false]);
                        } 
                    ?>
<!--
                <a class="dropdown-item"  href="javascript:;"> Profile</a>
                    <a class="dropdown-item"  href="javascript:;">
                    <span class="badge bg-red pull-right">50%</span>
                    <span>Settings</span>
                    </a>
                <a class="dropdown-item"  href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
-->
                </div>
            </li>

            <li role="presentation" class="nav-item dropdown">
                
                <a href="javascript:void(0);" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false"
                   ng-click="
                    getStatistics(false, false, '<?=$from?>', '<?=$to?>');
                    getNotifications();
                    ">
                    <i class="fa fa-bell"></i>
                    <span class="{{notifications.total>0 ? 'badgeNote' : ''}}" >{{notifications.total}}</span>
                </a>
                <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    
                    <li class="nav-item" 
                        ng-repeat="(k, itm) in notifications track by $index" 
                        ng-if="k.indexOf('new_')>-1">
                        <a href="javascript:void(0);">
                            <span>{{k.substr(4)}}:</span> <span style="{{itm>0? 'color:red' : ''}}">{{itm}}</span>
                        </a>
                    </li>
                </ul>
            </li>
                
            <li role="presentation" class="nav-item">
                <?php 
                    $url = $protocol."://".str_replace('/'.$currlang.'/', ($currlang == 'ar' ? '/en/' : '/ar/'), $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
                ?>
                <a href="<?=$url?>"><i class="fa fa-globe"></i> <?=$currlang == 'ar' ? 'En' : 'عَ';?></a>
            </li>
            </ul>
        </nav>
        </div>
    </div>
    <!-- /top navigation -->