
<?php echo $this->Html->css('style_tm', [null, 'fullBase' => true]);?>

<div class="msg_tm"
style="
  @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);
  font-family: 'Droid Arabic Kufi', serif;
  direction: rtl;
  text-align:center;
  max-width:1000px;
  margin:auto;
  padding:20px;
  border: 1px solid #ccc;"
>
	<img src='http://qassar-tech.com/turkeyde/images/logo.png' style="max-width:100%; width:250px;">
	<br />
	<div><?=__('contact_from').' '.$content['contact_name']?></div>
	<br />
	<div><?=$content['contact_message']?></div>
	<br />
	<div><?=__('email_signature')?></div>
</div>