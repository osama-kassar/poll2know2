<?php
$act = $this->request->getParam('action');
$ctrl = $this->request->getParam('controller');
if(strpos($_SERVER['REQUEST_URI'], '/game')){
    $ctrl = 'Games';
}
$action = false;

// set record title
if(in_array($act, ['view', 'game'])){ 
    if(!empty(@$exam)){ $action=@$exam->exam_title; }
    if(!empty(@$poll)){ $action=@$poll->poll_title; }
    if(!empty(@$score)){ $action=@$score->user_name; }
    if(!empty(@$game)){ $action=@$game->exam_title; }
    if(!empty(@$match)){ $action=$match->score1->user_name.' - '. (empty($match->score2->user_name) ? __('you') : $match->score2->user_name); }
    if(!empty(@$competition)){ $action=@$competition->competition_title; }
}

if($act == 'display'){ 
    $action=__($this->request->getParam('pass')[0]);
}

if(in_array($ctrl, ["Exams", "Polls", "Games"])){
    $ctrlLink = $this->Html->link(__(strtolower($ctrl)), 
        ["controller"=>strtolower($ctrl)]
    );
}
if(in_array($ctrl, ["Matches", "Scores"])){
    $ctrlLink = $this->Html->link(__(strtolower($ctrl)), 
        ["controller"=>$ctrl == "Scores" ? "exams" : "games"]
    );
}
if(in_array($ctrl, ["Categories"])){
    $ctrlLink = __(strtolower($ctrl));
    $action = $this->request->getParam('pass')[0];
}
?>

<div class="container-fuild">
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <?=$this->Html->link('<i class="fas fa-home"></i>', 
                         ["controller"=>"Pages", "action"=>"display", "home"], 
                         ["escape"=>false])?>
                </li>
                
                <li class="breadcrumb-item">
                    <?=$ctrlLink?>
                </li>
                
                <?php if($action){?>
                <li class="breadcrumb-item">
                    <?=$action?>
                </li>
                <?php }?>
            </ol>
        </div>
    </nav>
</div>