<a href="javascript:void(0);" class="dropdown-toggle">
    <?=strtoupper($currlang)?>
</a>
<div class="dropdown-menu">
    <?php
    foreach ( $this->Do->get( 'langs' ) as $lang ) {
        if ( $currlang !== $lang ) {
            ?>
        <a class="dropdown-item" href="<?=$path.'/'.$lang?>">
            <?=__($lang)?>
        </a>
    <?php
        }
    }
    ?>
</div>