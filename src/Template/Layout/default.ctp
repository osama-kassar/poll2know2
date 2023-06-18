<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->charset() ?>
    
    <title>
        <?= __('sitename') ?> - <?= __($this->fetch('title')) ?> 
    </title>
    
    <!-- Meta Tags -->
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="Cache-control" content="public">
    <meta http-equiv="Cache-control" content="max-age=31557600">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow" />

    <!-- Meta SEO -->
    <meta name="generator" content="<?=__('sitename')?> <?=__( $metaDt['_title'] )?>" />
    <meta name="keywords" content="<?=__( $metaDt['_keywords' ] )?>" />
    <meta name="description" content="<?=__( $metaDt['_description'] )?>" />
    <meta name="author" content="QASSAR.TECH" />
    <meta name="date" content="Jul. 10, 2019" />

    <!-- Meta Open Graph -->
    <meta property="og:title" content="<?=__( $mainDt['site_main_title'] )?> <?=__( $metaDt['_title'] )?>" />
    <meta property="og:url" content="<?=$mainDt["server_url"].urldecode( $mainDt['current_url'] )?>" />
    <meta property="og:description" content="<?=__( $metaDt['_description'] )?>" />
    <meta property="og:type" content="Article" />
    <meta property="og:image" content="<?=$mainDt['server_url']?><?=$metaDt['_photo']?>" />
    
    
    
    
    <!-- Style files -->
    <?php echo $this->Html->css('style'); ?>
    <?php echo $this->Html->css('yellow'); ?>
    	
    <!-- Java Script files -->
    <?php echo $this->Html->script('jquery-1.12.3.min') ?>
    <?php echo $this->Html->script('jquery.grid-a-licious.min') ?>
    <?php echo $this->Html->script('/plugins/bootstrap-3.3.6-dist/js/bootstrap.min'); ?>
    <?php echo $this->Html->script('myfunc');?>
    
    
</head>
<body>
    <?= $this->Flash->render() ?>
    
    <div class="container">
        <div>
            <?=$this->element('topmenu');?>
        </div>
        
        <div>
            <?=$this->element('mmenu');?>
        </div>
        
        
        <div>
            <?= $this->fetch('content');?>
            <?= $this->element('modal');?>
        </div>
    </div>
    
    <footer>
    	<?=$this->element('footer');?>
    </footer>
</body>
</html>
