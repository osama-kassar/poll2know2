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

    <!-- Start Footer For lg Screens -->
    <footer class="lg d-lg-block d-none">
      <section class="contact">
        <div class="container">
          <div class="row">
            <div
              class="col-12 col-lg-7 d-flex flex-column justify-content-center"
            >
              <h3>
              <?= __('send_us_your_feedback') ?>
              </h3>
              <p>
              <?= __('send_us_your_feedback_msg') ?>
              </p>
            </div>
            <div class="col-12 col-lg-5 pt-sm-0 pt-2">
            <?= $this->element('emailus', ["id" => "2"]) ?>
            </div>
          </div>
        </div>
      </section>
      <section class="footer-lg">
        <div class="container">
          <div class="row">
            <div class="col-4">
              <a href="#">
                <div class="image">
                <?= $this->Html->link(
                                    $this->Html->image("/img/logo_negative2.svg", ["alt" => "POLL2KNOW"]),
                                    ["controller" => "Pages", "action" => "display", "home"],
                                    ["escape" => false, "class" => "logo", "data-toggle" => "tooltip", "data-placement" => "bottom", "title" => __("sitename")]
                                )
                                ?>
                </div>
              </a>
              <p>
              <?= __('site_address') ?>
              </p>
              <span>
              <a class='hover' href="mailto:<?= __('site_email') ?>"><?= __('site_email') ?></a>
              </span>
            </div>
            <div class="col-2">
            
              <h3><?= __('sections') ?></h3>
              <ul class="list-unstyled">
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
            <div class="col-2">
              <h3><?= __('pages') ?></h3>
              <ul class="list-unstyled">
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
            <div class="col-2">
              <h3><?= __('categories') ?></h3>
              <ul class="list-unstyled">
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
            <div class="col-2">
              <h3><?= __('followus') ?></h3>
              <ul class="list-unstyled">
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
      </section>

      <div class="copyrights">
      <?= '2019-' . date("Y") ?> <?= __('sitename') ?> <?= __('copyrights') ?>
      </div>
    </footer>
    <!-- Start Footer For Small Screans -->
    <footer class="sm d-lg-none">
      <!-- Start Footer Section -->
      <div class="footer accordion accordion-flush" id="accordionFlushExample">
        <div class="container">
          <div class="accordion-item border-0">
            <h2 class="accordion-header" id="flush-headingOne">
              <button
                class="accordion-button bg-transparent"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne"
                aria-expanded="false"
                aria-controls="flush-collapseOne"
              >
                who us
              </button>
            </h2>
            <div
              id="flush-collapseOne"
              class="accordion-collapse"
              aria-labelledby="flush-headingOne"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                <div class="image">
                <?= $this->Html->link(
                                            $this->Html->image("/img/logo_negative2.svg", ["alt" => "POLL2KNOW"]),
                                            ["controller" => "Pages", "action" => "display", "home"],
                                            ["escape" => false]
                                        )
                                        ?>
                </div>
                <p>
                <?= __('site_address') ?>
                </p>
                <span>
                  <a href="mailto:<?= __('site_email') ?>"><?= __('site_email') ?></a>
                </span>
              </div>
            </div>
          </div>
          <div class="accordion-item border-0">
            <h2 class="accordion-header" id="flush-headingTwo">
              <button
                class="accordion-button collapsed bg-transparent"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseTwo"
                aria-expanded="false"
                aria-controls="flush-collapseTwo"
              >
              <?= __('sections') ?>
              </button>
            </h2>
            <div
              id="flush-collapseTwo"
              class="accordion-collapse collapse"
              aria-labelledby="flush-headingTwo"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                <ul class="list-unstyled">
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
          <div class="accordion-item border-0">
            <h2 class="accordion-header" id="flush-headingThree">
              <button
                class="accordion-button collapsed bg-transparent"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseThree"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
              <?= __('pages') ?>
              </button>
            </h2>
            <div
              id="flush-collapseThree"
              class="accordion-collapse collapse"
              aria-labelledby="flush-headingThree"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                <ul class="list-unstyled">
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
          <div class="accordion-item border-0">
            <h2 class="accordion-header" id="flush-headingFour">
              <button
                class="accordion-button collapsed bg-transparent"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseFour"
                aria-expanded="false"
                aria-controls="flush-collapseFour"
              >
              <?= __("categories") ?>
              </button>
            </h2>
            <div
              id="flush-collapseFour"
              class="accordion-collapse collapse"
              aria-labelledby="flush-headingFour"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                <ul class="list-unstyled">
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
      </div>
      <!-- Start Footer Section -->
      <section class="contact">
        <div class="container">
          <h3 class="m-0"><?= __('emailus') ?></h3>
          <div class="row">
            <div class="col-12 col-lg-5 pt-sm-0">
              <?= $this->element('emailus', ["id" => "1"]) ?>
            </div>
          </div>
        </div>
      </section>

      <!-- Start Social -->
      <div class="social-sm">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-sm-8 col-6">
              <h3><?= __('followus') ?></h3>
            </div>
            <div class="col-sm-4 col-5 m-auto d-flex justify-content-between">
            <?php foreach ($links['followus'] as $k => $link) { ?>
                                    <a href="<?= $link ?>" target="_blank">
                                        <i class="fab fa-<?= $k ?>"></i>
                                    </a>
                            <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <!-- End Social -->
      <!-- Start Copyright -->
      <div class="copyrights">
        <?= '2019-' . date("Y") ?> <?= __('sitename') ?> <?= __('copyrights') ?>

      </div>
      <!-- End Copyright -->
    </footer>
    <!-- End Footer For Small Screans -->
    <div class="mobile-overlay"></div>
