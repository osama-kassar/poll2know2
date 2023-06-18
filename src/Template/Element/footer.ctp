<!-- Footer Mobile -->

<?php
shuffle($c_list);
$links = [
    "sections" => ["Exams", "Polls", "Categories"],
    "pages" => ["about-us", "privacy-policy", "terms-of-use"],
    "categories" => $c_list,
    "followus" => [
        "whatsapp" => "https://bit.ly/2SNA5gV",
        "facebook" => "https://www.facebook.com/poll2know",
        "linkedin" => "https://www.linkedin.com/company/poll2know",
        "twitter" => "https://www.twitter.com/poll2know"
    ]
];

?>



<footer id="footerMobile" class="footer-area footer-mobile d-lg-none d-xl-none">

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="single-footer">

                    <div class="pro-about">
                        <a href="" data-toggle="collapse" data-target="#collapseFooter" aria-expanded="false" aria-controls="collapseFooter"><?= __('who_us') ?></a>
                        <div class="collapse show" id="collapseFooter">
                            <div class="card card-body">
                                <ul class="pl-0 mb-0">
                                    <li class="text-center">
                                        <?= $this->Html->link(
                                            $this->Html->image("/img/logo_negative2.svg", ["alt" => "POLL2KNOW"]),
                                            ["controller" => "Pages", "action" => "display", "home"],
                                            ["escape" => false]
                                        )
                                        ?>
                                    </li>
                                    <li>
                                        <span><?= __('site_address') ?></span>
                                    </li>
                                    <li>
                                        <span>
                                            <a href="mailto:<?= __('site_email') ?>"><?= __('site_email') ?></a>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-2">

                <div class="single-footer">
                    <a href="" data-toggle="collapse" data-target="#collapseFooterOne" aria-expanded="false" aria-controls="collapseFooterOne"><?= __('sections') ?></a>
                    <div class="collapse" id="collapseFooterOne">
                        <div class="card card-body">
                            <ul class="pl-0 mb-0">
                                <?php foreach ($links['sections'] as $link) { ?>
                                    <li>
                                        <?= $this->Html->link(
                                            __($link),
                                            ["controller" => $link, "action" => "index"]
                                        ) ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-lg-2">
                <div class="single-footer">
                    <a href="" data-toggle="collapse" data-target="#collapseFooterTwo" aria-expanded="false" aria-controls="collapseFooterTwo"><?= __('pages') ?></a>
                    <div class="collapse" id="collapseFooterTwo">
                        <div class="card card-body">
                            <ul class="pl-0 mb-0">
                                <?php foreach ($links['pages'] as $link) { ?>
                                    <li>
                                        <?= $this->Html->link(
                                            __($link),
                                            ["controller" => "Pages", "action" => "display", $link]
                                        ) ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-2">
                <div class="single-footer">
                    <a href="" data-toggle="collapse" data-target="#collapseFooterThree" aria-expanded="false" aria-controls="collapseFooterThree"><?= __("categories") ?></a>
                    <div class="collapse" id="collapseFooterThree">
                        <div class="card card-body">
                            <ul class="pl-0 mb-0">
                                <?php foreach ($links['categories'] as $k => $link) {
                                    if ($k > 3) {
                                        break;
                                    }
                                ?>
                                    <li>
                                        <?= $this->Html->link(
                                            __($link->category_name),
                                            ["controller" => "Categories", "action" => "index", $link->id, __($link->category_name)]
                                        ) ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="single-footer">
                    <div class="pro-newsletter">
                        <h5><?= __('emailus') ?></h5>
                        <?= $this->element('emailus', ["id" => "1"]) ?>
                    </div>

                    <div class="pro-socials">
                        <h5><?= __('followus') ?></h5>
                        <ul>
                            <?php foreach ($links['followus'] as $k => $link) { ?>
                                <li>
                                    <a href="<?= $link ?>" target="_blank">
                                        <i class="fab fa-<?= $k ?>"></i>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- bottom footer -->
    <div class="container-fluid p-0">
        <div class="copyright-content">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-12 col-sm-12">
                        <div class="footer-info">
                            <?= '2019-' . date("Y") ?> <?= __('sitename') ?> <?= __('copyrights') ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>


<!-- //footer style three -->
<footer id="footerThree" class="footer-area footer-three footer-desktop d-none d-lg-block d-xl-block">
    <div class="container">
        <div class="footer-top-content">
            <div class="row align-items-center">
                <div class="col-12 col-lg-7">
                    <h4><?= __('send_us_your_feedback') ?></h4>
                    <p>
                        <?= __('send_us_your_feedback_msg') ?>
                    </p>

                </div>
                <div class="col-12 col-lg-5">
                    <?= $this->element('emailus', ["id" => "2"]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="single-footer">
                    <div class="pro-about">
                        <ul class="pl-0 mb-0">
                            <li>
                                <?= $this->Html->link(
                                    $this->Html->image("/img/logo_negative2.svg", ["alt" => "POLL2KNOW"]),
                                    ["controller" => "Pages", "action" => "display", "home"],
                                    ["escape" => false, "class" => "logo", "data-toggle" => "tooltip", "data-placement" => "bottom", "title" => __("sitename")]
                                )
                                ?>
                            </li>
                            <li>
                                <span><?= __('site_address') ?></span>
                            </li>
                            <li>
                                <span>
                                    <a href="mailto:<?= __('site_email') ?>"><?= __('site_email') ?></a>
                                </span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-2">
                <div class="single-footer">
                    <h5><?= __('sections') ?></h5>
                    <ul class="pl-0 mb-0">
                        <?php foreach ($links['sections'] as $link) { ?>
                            <li>
                                <?= $this->Html->link(
                                    __($link),
                                    ["controller" => $link, "action" => "index"]
                                ) ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-2">
                <div class="single-footer">
                    <h5><?= __('pages') ?></h5>

                    <ul class="pl-0 mb-0">
                        <?php foreach ($links['pages'] as $link) { ?>
                            <li>
                                <?= $this->Html->link(
                                    __($link),
                                    ["controller" => "Pages", "action" => "display", $link]
                                ) ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-2">
                <div class="single-footer">
                    <h5><?= __('categories') ?></h5>

                    <ul class="pl-0 mb-0">
                        <?php foreach ($links['categories'] as $k => $link) {
                            if ($k > 3) {
                                break;
                            }
                        ?>
                            <li>
                                <?= $this->Html->link(
                                    __($link->category_name),
                                    ["controller" => "Categories", "action" => "index", $link->id, __($link->category_name)]
                                ) ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-2">
                <div class="single-footer">
                    <h5><?= __('followus') ?></h5>
                    <ul class="pl-0 mb-0 socialmedia">
                        <?php foreach ($links['followus'] as $k => $link) { ?>
                            <li>
                                <a href="<?= $link ?>" target="_blank">
                                    <i class="fab fa-<?= $k ?>"></i> <?= __($k) ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="copyright-content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-sm-12">
                        <div class="footer-info">
                            <?= '2019-' . date("Y") ?> <?= __('sitename') ?> <?= __('copyrights') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<div class="mobile-overlay"></div>