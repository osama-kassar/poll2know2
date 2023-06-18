<?php
$ctrl = $this->request->getParam("controller");
$actn = $this->request->getParam("action");
$currUrl = $ctrl . '/' . $actn;
?>

<!-- Start Mini Nav For Small Screens  -->
<!-- End Header For Large Screens -->
<!-- Start Header For Small Screens -->
<!-- End Mini Nav For Small Screens  -->

<!-- Start Header For large Screens -->
<!-- MAIN MENU -->
<!-- Start Sidebar -->
<!-- End Header For Small Screens -->

<!-- End Sidebar -->
<!--  WEB HEADER  -->
<div class="mini-nav d-none d-lg-flex">

    <div class="container">
        <div class="content d-flex justify-content-between align-items-center">
            <div class="dropdown-group d-flex">
                <?= $this->element('langList') ?>

                <a class="nav-link dropdown-toggle text-light" href="javascript:void(0);" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <?= __("categories") ?>
                </a>
                <ul class="dropdown-menu text-dark">
                    <?php
              foreach ($c_list as $itm) {
                  if ($itm->total_related > 0) {
                      echo $this->Html->link(__($itm->category_name) . " (" . $itm->total_related . ")", ["controller" => "Categories", "action" => "index", __($itm->category_name), $itm->id], ["class" => "dropdown-item"]);
                  }
              }
              ?>
                </ul>
            </div>
            <div class="welcomeX text-light">
                <?php if ($authUser) { ?>
                <div class="dropdown"> <a class="pro-avatar"><?= __('welcome') ?> <?= $authUser['user_fullname'] ?></a>
                </div>
                <div class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle"><?= __('my_account') ?></a>
                    <div class="dropdown-menu">
                        <?= $this->Html->link(__('my_polls'), ["controller" => "Polls", "action" => "me"], ["class" => "dropdown-item"]) ?>
                        <?= $this->Html->link(__('my_exams'), ["controller" => "Exams", "action" => "me"], ["class" => "dropdown-item"]) ?>
                        <?= $this->Html->link(__('poll_i_did'), ["controller" => "Polls", "action" => "done"], ["class" => "dropdown-item"]) ?>
                        <?= $this->Html->link(__('exams_i_did'), ["controller" => "Exams", "action" => "done"], ["class" => "dropdown-item"]) ?>
                        <?= $this->Html->link(__('total_points'), ["controller" => "Users", "action" => "points"], ["class" => "dropdown-item"]) ?>
                        <?= $this->Html->link(__('logout'), ["controller" => "Users", "action" => "logout"], ["class" => "dropdown-item"]) ?>
                    </div>
                </div>
                <?php } else { ?>
                <div class="white-link">
                    <span><?= __('welcome') ?></span>,
                    <span><?= $this->Html->link(
                                            __('register_login') . ' <i class="fas fa-sign-in-alt"></i> ',
                                            ["controller" => "Users", "action" => "login"],
                                            ["escape" => false, "data-toggle" => "modal", "id" => "login_mdl_btn", "data-target" => "#login_mdl"]
                                        ) ?></span>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="mini-nav d-flex d-lg-none">
    <div class="container">
        <div class="content d-flex justify-content-center align-items-center">
            <div class="dropdown-group d-flex">
                <?= $this->element('langList') ?>
                <div class="menu-item <?= $currUrl == 'Polls/index' ? 'active' : '' ?>">
                    <?= $this->Html->link('<i class="fas fa-question-circle"></i> ' . __("polls"), [
                    "controller" => "Polls",
                    "action" => "index",
                ], ["escape" => false]) ?>
                </div>
                <div class="menu-item <?= $currUrl == 'Exams/games' ? 'active' : '' ?>">
                    <?= $this->Html->link('<i class="icon-grin-alt"></i> ' . __("games"), [
                    "controller" => "Exams",
                    "action" => "games",
                ], ["escape" => false]) ?>
                </div>
                <div class="menu-item <?= $currUrl == 'Exams/index' ? 'active' : '' ?>">
                    <?= $this->Html->link('<i class="fas fa-graduation-cap"></i> ' . __("exams"), [
                    "controller" => "Exams",
                    "action" => "index",
                ], ["escape" => false]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<header class="d-none d-lg-block">
    <div class="container">
        <div class="content d-flex justify-content-between align-items-center">
            <div class="logo">
                <?= $this->Html->link(
                        $this->Html->image('/img/logo.svg', ["alt" => "poll2know-logo"]),
                        "/" . $currlang,
                        ["escape" => false, "data-toggle" => "tooltip", "data-placement" => "bottom", "title" => __('sitename'), "class" => "logo"]
                    ) ?>
            </div>
            <?= $this->element('generalSearch') ?>

            <div class="icons d-flex gap-3">
                <div class='dropdown' data-toggle="tooltip" data-placement="top" title="<?= __('rss') ?>">
                    <button class="btn points" class="btn dropdown-toggle" type="button" id="headerOneCartButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-rss"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right fade" style='min-width:0;padding:0 !important;'>
                        <?= $this->element('followus') ?>
                    </div>
                </div>

                <div class='dropdown' data-toggle="tooltip" data-placement="top" title="<?= __('scores') ?>">

                    <button class="btn score" type="button" id="headerOneCartButton" data-toggle="dropdown"
                        ng-click="callAction('/configs/getscores', 'latestScores', 'GET', '', 'star')">
                        <i class="far fa-star"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right fade" aria-labelledby="headerOneCartButton"
                        style='min-width:0 ;padding:0 !important;'>
                        <?= $this->element('latestScores') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<header class="d-block d-lg-none small">
    <div class="container">
        <div class="content d-flex justify-content-between align-items-center">

            <div class="navigation-mobile-container menu-toggler"> <a href="javascript:void(0)"
                    class="navigation-mobile-toggler"> <i class="fas fa-bars"></i> </a>
            </div>

            <div class="logo">
                <?= $this->Html->link(
                        $this->Html->image('/img/logo.svg', ["alt" => "poll2know-logo"]),
                        "/" . $currlang,
                        ["escape" => false, "data-toggle" => "tooltip", "data-placement" => "bottom", "title" => __('sitename'), "class" => ""]
                    ) ?>
            </div>
            <div class="icons d-flex gap-2">
                <div class='dropdown' data-toggle="tooltip" data-placement="top" title="<?= __('rss') ?>">
                    <button class="btn points" type="button" id="headerOneCartButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-rss"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right fade" style='min-width:0;padding:0 !important;'>
                        <?= $this->element('followus') ?>
                    </div>
                </div>
                <div class='dropdown' data-toggle="tooltip" data-placement="top" title="<?= __('scores') ?>">

                    <button class="btn score" type="button" id="headerOneCartButton" data-toggle="dropdown"
                        ng-click="callAction('/configs/getscores', 'latestScores', 'GET', '', 'star')">
                        <i class="fas fa-star"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right fade" aria-labelledby="headerOneCartButton"
                        style='min-width:0;padding:0 !important;'>
                        <?= $this->element('latestScores') ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>

<div class="sidebar" id="navigation-mobile">
    <?php if ($authUser) { ?>
    <div class="welcome"><?= __('welcome') ?> <?= $authUser['user_fullname'] ?></div>
    <div class="logout">
        <?= $this->Html->link(__('logout'), ["controller" => "Users", "action" => "logout"]) ?>
    </div>
    <?php } else { ?>
    <div class="welcome">
        <?= __('welcome') ?>,
        <?= $this->Html->link(
                                            __('register_login') . ' <i class="fas fa-sign-in-alt"></i>',
                                            ["controller" => "Users", "action" => "login"],
                                            ["escape" => false, "data-toggle" => "modal", "data-target" => "#modal_tmplt"]
                                        ) ?>
    </div>
    <?php } ?>
    <?php echo $this->Html->link(
                                '<i class="fas fa-home"></i> ' . __('homepage'),
                                "/" . $currlang,
                                ["class" => "main-manu", "escape" => false]
                            ) ?>

    <?php echo $this->Html->link(
                                '<i class="fas fa-question-circle"></i> ' . __('exams'),
                                ["controller" => "Exams"],
                                ["class" => "main-manu", "escape" => false]
                            ) ?>

    <?php echo $this->Html->link(
                                '<i class="fas fa-graduation-cap"></i> ' . __('polls'),
                                ["controller" => "Polls"],
                                ["class" => "main-manu", "escape" => false]
                            ) ?>

    <?php echo $this->Html->link(
                                '<i class="fas fa-grin-alt"></i> ' . __('games'),
                                ["controller" => "Exams", "action" => "games"],
                                ["class" => "main-manu", "escape" => false]
                            ) ?>
    <a class="main-manu" data-toggle="collapse" data-target="#homepages" role="button" aria-expanded="false"
        aria-controls="shoppages"> <i class="fas fa-stream"></i> <?= __('categories') ?> </a>
    <div class="sub-manu collapse show multi-collapse" id="homepages">
        <ul class="list-unstyled m-0">
            <li class="">
                <?php foreach ($c_list as $itm) {
                     if ($itm->total_related > 0) {
                        echo $this->Html->link(
                            __($itm->category_name) . " ($itm->total_related)",
                            ["controller" => "Categories", "action" => "index", __($itm->category_name), $itm->id],
                            ["class" => "main-manu"]
                         );
                    }
                } ?>
            </li>
        </ul>
    </div>
</div>

<div class="search-mobile d-lg-none">
    <div class="container">
        <?= $this->element('generalSearch') ?>

    </div>
</div>

<div class="main-menu d-none d-lg-block">
    <div class="container text-center d-flex justify-content-center">
        <div class="menu-item <?= $currUrl == 'Polls/index' ? 'active' : '' ?>">
            <?= $this->Html->link('<i class="fas fa-question-circle"></i> ' . __("polls"), [
                    "controller" => "Polls",
                    "action" => "index",
                ], ["escape" => false]) ?>
        </div>
        <div class="menu-item <?= $currUrl == 'Exams/games' ? 'active' : '' ?>">
            <?= $this->Html->link('<i class="fas fa-grin-alt"></i> ' . __("games"), [
                    "controller" => "Exams",
                    "action" => "games",
                ], ["escape" => false]) ?>
        </div>
        <div class="menu-item <?= $currUrl == 'Exams/index' ? 'active' : '' ?>">
            <?= $this->Html->link('<i class="fas fa-graduation-cap"></i> ' . __("exams"), [
                    "controller" => "Exams",
                    "action" => "index",
                ], ["escape" => false]) ?>
        </div>
    </div>
</div>