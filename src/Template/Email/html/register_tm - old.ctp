<style>
@import url(//fonts.googleapis.com/earlyaccess/notokufiarabic.css); 
@import url(//fonts.googleapis.com/css2?family=Nothing+You+Could+Do&display=swap); 
.msg_tm{
    font-family: 'Noto Kufi Arabic', sans-serif; 
    direction: rtl;
    text-align:center;
    max-width:1000px;
    margin:auto;
    padding:20px;
    border: 1px solid #28B293;
}
.msg_tm header{
   background:#28B293; 
   margin: 0; 
   padding:20px;
   min-height:70px;
   border-bottom:1px solid #ccc; 
}
.msg_tm .logo{
    width:50%; 
    text-align:left; 
    float:left;
}
.msg_tm .logo img{
    max-width:100%; 
    padding:10px 0;
}
.msg_tm .btn{
    color:#28B293;
    border:1px solid #28B293;
    border-radius:50px; 
    font-size:30px; 
    padding:2px 36px;
    text-decoration:none;
}
.msg_tm footer{
    text-align:left;
    border-top:1px solid #ccc; 
    background:#28B293; 
    padding:20px;
}
.msg_tm .signature{
    font-family: 'Nothing You Could Do', cursive;
    font-style:italic;
    -ms-transform: rotate(-10deg); /* IE 9 */
    transform: rotate(-10deg);
}
</style>



<div class="msg_tm">
    <header >
        <div class="logo">
            <img src='<?=$_SERVER['HTTP_HOST'].$content['app_folder']?>/theme1/img/logo.svg'>
            <?=$this->Html->image("/img/logo.svg", ["_full"=>true]);?>
        </div>
        <h1><?=__('welcome').' '.$content['user_fullname']?></h1>
    </header>
    
    <div>
            <br>
        <div><?=__('register_email_msg')?></div>
            <br>
        <div >
            <div><?=__('click_here_activiate')?></div>
            <br>
            <div>
            <?=$this->Html->link( __('register_activition_link') ,[
                        '_full' => true,
                        "controller"=>"Users", "action"=>"activate", $content['user_token'] ], ['escape'=>false, "class"=>"btn"])?>
            </div>
            <br>
        </div>
        <br>
    </div>
    
    <footer>
        
        <div class="signature"><?=__('email_signature')?></div>
        <br>
        <div style="text-align: left;">
            POLL 2 KNOW © 2019 <br>
            QASSAR.TECH DEVELOPEMENT AND WEB SERVICES <br>
            Turkey - Istanbul 
        </div>
        <div>
            <?=$this->Html->link(__('why_See_msg'),[
                    '_full' => true,
                    "controller"=>"Pages", "action"=>"display",  "terms-conditions"])?> 
            | 
            <?=$this->Html->link(__('unsubscribe'),[
                    '_full' => true,
                    "controller"=>"Users", "action"=>"unsubscribe",  $content["user_token"] ])?>
        </div>
    </footer>
</div>