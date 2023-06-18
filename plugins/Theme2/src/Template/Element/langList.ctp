<a
              class="nav-link dropdown-toggle text-light"
              href="javascript:void(0);"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <?=strtoupper($currlang)?>
            </a>
            <!--  -->
<!-- <a href="javascript:void(0);" class="dropdown-toggle">
    <?=strtoupper($currlang)?>
</a> -->
<div class="dropdown-menu">
    <li>
        <?php
    foreach ( $this->Do->get( 'langs' ) as $lang ) {
        if ( $currlang !== $lang ) {
            ?>
            <a  class="dropdown-item" href="<?=$path.'/'.$lang?>">
                <?=__($lang)?>
            </a>
        <!-- <a class="dropdown-item" href="<?=$path.'/'.$lang?>">
            <?=__($lang)?>
        </a> -->
        <?php
        }
    }
    ?>
    </li>
</div>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">TURKEY</a></li>
            </ul>