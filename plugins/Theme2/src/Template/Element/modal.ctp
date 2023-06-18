
<?php 
$action = $this->request->getParam('action');
$ctrl = $this->request->getParam('controller');
?>

<button class="hideIt" data-toggle="modal" id="start_exam_game_mdl_btn" data-target="#start_exam_game_mdl"></button>

<?php // Register 
?>
<div class="modal fade" id="register_mdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="ctrl as ctrl">
	<div class="listing-modal-1 modal-dialog modal-lg">
		<div class="modal-content">
			<div class="cvr" id="modal_cvr"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
			<!-- <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title" id="myModalLabel2">
					<?= __('registration') ?>
				</h2>
			</div> -->
			<div class="modal-header">
				
				<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				<h2 class="modal-title" id="myModalLabel0">
					<?= __('registration') ?>
				</h2>
				<button type="button" class="btn-close" class="close" data-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body" style='padding:31px 0'>
				<?= $this->element('register') ?>
			</div>
		</div>
	</div>
</div>

<?php // Login 
?>
<div class="modal fade" id="login_mdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true" ng-controller="ctrl as ctrl">
	<div class="listing-modal-1 modal-dialog modal-lg">
		<div class="modal-content">
			<div class="cvr" id="modal_cvr"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
			<div class="modal-header">
				
				<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				<h2 class="modal-title" id="myModalLabel0">
					<?= __('login') ?>
				</h2>
				<button type="button" class="btn-close" class="close" data-dismiss="modal" aria-hidden="true"></button>
			</div>
			<!-- <div class="modal-header">
        <h5 class="modal-title"><?= __('login') ?></h5>
        <button type="button" class="btn-close" class="close" data-dismiss="modal" aria-hidden="true"></button>
      </div> -->
			<div class="modal-body" style='padding:31px 0'>
				<?= $this->element('login') ?>
			</div>
		</div>
	</div>
</div>

<?php // Get Password 
?>
<div class="modal fade" id="getpassword_mdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true" ng-controller="ctrl as ctrl">
	<div class="listing-modal-1 modal-dialog modal-md">
		<div class="modal-content">
			<div class="cvr" id="modal_cvr"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title" id="myModalLabel4">
					<?= __('getpassword') ?>
				</h2>
			</div>
			<div class="modal-body">
				<?= $this->element('getpassword') ?>
			</div>
		</div>
	</div>
</div>


<?php
// Share
if (in_array($action, ['view', 'readylink']) && in_array($ctrl, ["Polls", "Scores", "Competitions", "Matches"])) { ?>

	<div class="modal fade" id="share_mdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-hidden="true" ng-controller="ctrl as ctrl">
		<div class="listing-modal-1 modal-dialog modal-md">
			<div class="modal-content">
				<div class="cvr" id="modal_cvr"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="myModalLabel6">
						<?= __('share_the_link') ?>
					</h2>
				</div>
				<div class="modal-body">
					<div class="text-center">
						<?= $action == 'view' ? $this->element('like_btns') : '' ?>
						<?php
						$ctrl = $this->request->getParam("controller");
						$obj = [];
						$img = '';
						$onlyIcons = false;
						if ($ctrl == "Scores") {
							$obj = $score;
							$img = "/img/scores_photos/" . $score->score_photo;
						}
						if ($ctrl == "Exams") {
							$obj = $exam;
						}
						if ($ctrl == "Polls") {
							$obj = $poll;
						}
						if ($ctrl == "Competitions") {
							$obj = $competition;
						}
						if ($ctrl == "Matches") {
							$obj = $match;
							$link = $protocol.':'.$path.'/'.$currlang.'/game/'.$obj->exam->slug.'?matchid='.$obj->id;
							$onlyIcons = true;
						}
						?>
						<?php if($action == 'readylink'){?>
							<b><?=__('send_invitation_to_your_friends')?></b>
							<button class="btn btn-secondary swipe-to-top" ng-click="copyToClipBoard('#inv_link')">
								<i class="fa fa-link"></i> <?=__('copy_the_link')?>
							</button>
							<div> <a href ng-click="copyToClipBoard('#inv_link')"><i id="inv_link"> <?=$link?> </i></a> </div> 
						<?php }?>

						<?= $this->element("share", ["obj" => $obj, "mdl" => $ctrl, "img" => $img, "onlyIcons"=>$onlyIcons, "link"=>$link]) ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } ?>



<?php
// Enter name to start exam/game
/*if (in_array($action, ['game', 'view']) && in_array($ctrl, ["Exams"])) { ?>

	<div class="modal fade" id="start_exam_game_mdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-hidden="true">
		<div class="listing-modal-1 modal-dialog modal-md">
			<div class="modal-content">

				<div class="cvr" id="modal_cvr"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="myModalLabel6">
						<?= __('start_the_'.($action == 'game' ? 'game' : 'exam')) ?>
					</h2>
				</div>

				<div class="modal-body">
					
					<!-- User info -->
					<form class="row mb-5" 
							action="<?=$path.'/'.$currlang?>/exam/<?=$exam->slug?>?p=0" 
							method="POST">

						<?php if(!$authUser){?>
						<div class=" col col-12">
							<label><?=__('enter_your_name')?></label>
							<input type="text" name="name" class="form-control" ng-model="userdt.user_name">
						</div>
						<?php }?>
						
						<div class="col-12 mt-3 text-center">
							<button class="btn btn-secondary swipe-to-top"
									id="start_btn"
									ng-disabled="userdt.user_name.length<2 "> 
								<i class="fas fa-graduation-cap"></i> <?=__('start_the_'.($action == 'game' ? 'game' : 'exam') )?>
							</button>
						</div>
					</form>
				
				</div>
			</div>
		</div>
	</div>

	<script>
		setTimeout(()=>{
			$("#start_exam_game_mdl_btn")[0].click();
		}, 5000);
	</script>
<?php }*/ ?>