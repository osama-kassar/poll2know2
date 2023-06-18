

function setCaptcha(salt ,obj, type, chars){
	var schema=new Array();
	schema['alphaNumeric'] = Array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v', 'w','x','y','z','0','1', '2','3','4','5','6','7','8','9');
	schema['alpha']=Array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p', 'q','r','s','t','u','v','w','x','y','z');
	schema['numeric']=Array('0','1','2','3','4','5','6','7','8','9');
	var canvas_w = chars * 20;
	var secret = '';
	
	
	for(var i=0; i<chars; i++){
		var rand = Math.floor((Math.random() * schema[type].length));
		secret += schema[type][rand];
	}
	
	var pointer=Math.floor(Math.random() * chars);
	var enc_secret = secret.substr(0,pointer)+ salt.substr(0,21) + secret.substr(pointer) + salt.substr(21);
	
    var inputTarget = document.getElementById('CaptchaCode'+obj)
    inputTarget.setAttribute("dt-src", enc_secret);
    
	var c=document.getElementById('can'+obj);
	var ctx=c.getContext('2d');
//	var capholder = document.getElementById('inp'+obj);
//	
//	capholder.innerHTML='<input type="text" id="CaptchaCodeSource'+obj+'" name="CaptchaCodeSource'+obj+'" value="'+enc_secret+'" ng-model="CaptchaCodeSource'+obj+'">';
		
	ctx.clearRect(0, 0, c.width, c.height);
	
	ctx.font='30px Impact';
	var gradient=ctx.createLinearGradient(0,0,c.width,0);
	gradient.addColorStop('0','#f00');
	gradient.addColorStop('0.1','blue');
	gradient.addColorStop('0.2','#f00');
	gradient.addColorStop('0.3','blue');
	gradient.addColorStop('0.4','#f00');
	gradient.addColorStop('0.5','blue');
	gradient.addColorStop('0.6','#f00');
	gradient.addColorStop('0.7','blue');
	gradient.addColorStop('0.8','#f00');
	gradient.addColorStop('0.9','blue');
	gradient.addColorStop('1.0','#f00');
	ctx.strokeStyle=gradient;
	ctx.textAlign = 'center';
	
	ctx.strokeText(secret,(canvas_w/2), 26);
}

function toElmJs (tar) {
    var elmTarget2 = $('#'+tar);
    if(elmTarget2.length>0){
        $("html, body").animate({
            scrollTop: elmTarget2.offset().top + " "
        }, 1000);
    }
}