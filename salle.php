<div id="chat_message_error" style="width:100%;height:20px;color:#FF0000;display:none;"></div>
<div class="vertical-center2" id="chat_message" style="width:100%;height:100%;overflow-y:scroll;overflow-x:hide;"></div>

<div class="container">
	<div class="col-sm-10 col-xs-12">
		<textarea class="form-control" id="message" style="width:100%;height:100%;" onkeypress="oldfocus=((new Date()).getTime());if ((event.keyCode==13) && !(event.shiftKey)) {if (event.preventDefault) event.preventDefault();send_msg();return false;}"  rows='' cols='' ></textarea>
	</div>
	<div class="col-sm-2 col-xs-12">
		<input class="btn btn-default" type="button" onclick="send_msg();return false;" value="<?php echo $lng['Send']; ?>"/>
		<input class="btn btn-default" type="button" onclick="send_reset();return false;" value="<?php echo $lng['Erase']; ?>"/>
		<input class="btn btn-default" type="button" value="Options" onclick="show_options();" />
	</div>
</div>
<br>
<br>
<div class="container">
	<div class="col-md-6 col-sm-6 col-xs-12 form-group form-group-sm">
		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
			<?php echo $lng['Room']; ?>&nbsp;:
		</div>
		<div class="col-lg-8 col-md-7 col-sm-6 col-xs-10">
			<span style="font-size:smaller ;"><input class="form-control" id="clef" style="background-color:#E0E0FF;width:100%;height:20px;font-size:10px;" type="text" value="<?php echo $room; ?>" onkeyup="if ((event.keyCode==13) && !(event.shiftKey)) window.location.href='<?php echo $url_base.'?';?>'+this.value; return false;"/></span>
		</div>
		<div class="col-sm-2 col-xs-2">
			<input class="btn btn-default" type="button" value="Go" onclick="window.location.href='<?php echo $url_base.'?';?>'+$('#clef').val();" style="height:20px;font-size:10px;padding-top:3px;" />
		</div>
		
		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
			<?php echo str_replace(' ','&nbsp;',$lng['Private key']); ?>&nbsp;:
		</div>
		<div class="col-lg-8 col-md-7 col-sm-6 col-xs-10">
			<span style="font-size:smaller ;"><input placeholder="<?php echo $lng['Private key']; ?>" class="form-control" id="pclef" style="background-color:#E0E0FF;width:100%;height:20px;font-size:10px;" type="password" value="" onkeyup="if ((event.keyCode==13) && !(event.shiftKey)) refresh_chat(false,1);return false;" /></span>
		</div>
		<div class="col-sm-2 col-xs-2">
			<input class="btn btn-default" type="button" value="Go" onclick="refresh_chat(false,1);" style="height:20px;font-size:10px;padding-top:3px;" />
		</div>
		
		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
			<?php  echo str_replace(' ','&nbsp;',$lng['Direct Link']); ?>&nbsp;:
		</div>
		<div class="col-lg-10 col-md-9 col-sm-8 col-xs-10">
			<span style="font-size:smaller ;"><input class="form-control" readonly="readonly" style="background-color:#E0E0FF;font-size:8px;width:100%;height:20px;" type="text" value="<?php echo $url_base.'?'.$room; ?>"/></span>
		</div>
			 
	</div>
	<div class="col-md-3 col-sm-3 col-xs-12">
		<?php echo $lng['You are']; ?> : <span style="font-size:smaller ;"><?php echo $_SESSION['login']; ?></span>
			<input class="btn btn-default" type="button" value="<?php echo $lng['Change']; ?>" onclick="window.location.href='<?php echo $url_base.'?'.$room.'&amp;reset=1&amp;clean=1&amp;lang='.$_SESSION['lang']; ?>'" />
	</div>
	<div class="col-md-3 col-sm-3 col-xs-12">
		<a href="#" onclick="refresh_iplist();return false;">Login / IP list :</a><div id="login_list" style="font-size:10px;width:200px;height:100px;overflow-y:scroll;overflow-x:auto;">
	</div>
</div>


<script type="text/javascript">
<!--

var makeCRCTable = function(){
    var c;
    var crcTable = [];
    for(var n =0; n < 256; n++){
        c = n;
        for(var k =0; k < 8; k++){
            c = ((c&1) ? (0xEDB88320 ^ (c >>> 1)) : (c >>> 1));
        }
        crcTable[n] = c;
    }
    return crcTable;
}

var crc32 = function(str) {
    var crcTable = window.crcTable || (window.crcTable = makeCRCTable());
    var crc = 0 ^ (-1);

    for (var i = 0; i < str.length; i++ ) {
        crc = (crc >>> 8) ^ crcTable[(crc ^ str.charCodeAt(i)) & 0xFF];
    }
    return (crc ^ (-1)) >>> 0;
};

function str_to_color(str)
{
	var crc=parseInt(crc32(str));
	var r,g,b,a,add;
	r=crc%256;
	crc=Math.ceil(crc/256);
	g=crc%256;
	crc=Math.ceil(crc/256);
	b=crc%256;
	crc=Math.ceil(crc/256);
	a=crc%256;
	add=150;
	if (r+g+b>600)
	{
		if (a<85)
			r=(r-add)%256;
		if (a>=85 && a<170)
			g=(g-add)%256;
		if (a<=170)
			b=(b-add)%256;
	}
	if (r+g+b<100)
	{
		if (a<85)
			r=(r+add)%256;
		if (a>=85 && a<170)
			g=(g+add)%256;
		if (a<=170)
			b=(b+add)%256;
	}
	r=r.toString(16);
	g=g.toString(16);
	b=b.toString(16);
	if (r.length==1)
		r='0'+r;
	if (g.length==1)
		g='0'+g;
	if (b.length==1)
		b='0'+b;
	return '#'+r+g+b;
	// return '#'+crc32(str).toString(16).substr(0,6);
}

function adapt_color(r)
{
	if (r<50)
		r=r+50;
	if (r>200)
		r=r-50;
	return r;
}

var haut=(window.innerHeight)-300;
// var haut=(document.body.clientHeight)-400;

$(function() {
	// $('#chat').dialog();
	// refresh_chat();
	resize_div();
});


function refresh_iplist()
{
	$.ajax({
		type: "POST",
		url: "ajax_chat.php",
		data: "get=2&room=<?php echo $room;?>",
		async: true,
		success: function(data)
		{
			html=data.replace(/\n/g,"<br />");  
			$('#login_list').html(html);
		}
	 });
}

function encrypt(msg)
{
	// var password = 'L0ck it up saf3';
  // var plaintext = 'pssst ... don’t tell anyøne!';
  // var ciphertext = Aes.Ctr.encrypt(plaintext, password, 256);
  // var origtext = Aes.Ctr.decrypt(ciphertext, password, 256);
  
	// msg=encodeURI(hexEncode(rc4Encrypt('<?php echo $room;?>',encodeURI(msg))));
	// msg=encodeURI(hexEncode(Aes.Ctr.encrypt(encodeURI(msg),'<?php echo $room;?>',256)));
	// msg=encodeURI(hexEncode(Aes.Ctr.encrypt((msg),'<?php echo $room;?>',256)));
	// return msg;
	if (msg=='' || msg==' ')
		return msg;
	msg=encodeURIComponent(GibberishAES.enc(msg,'fe|)OF`E,M2{H#@8J>6UARJut6BBe)E%~k>ipGxGwg ,\vU#pv<?php echo sel_room($room).$room.sel_room($room,1);?>'+$('#pclef').val()+'7(~>><J3^$fDr;FC)dzZ)Kq&KGv7G6?gOee`w^V2N~-_j%SvO!'));
	return msg;
}

function decrypt(msg)
{
	
	// msg=decodeURI(rc4Decrypt('<?php echo $room;?>',hexDecode(msg)));
	// msg=decodeURI(Aes.Ctr.decrypt(hexDecode(msg),'<?php echo $room;?>',256));
	// msg=(Aes.Ctr.decrypt(hexDecode(msg),'<?php echo $room;?>',256));
	// return msg;
	if (msg=='' || msg==' ')
		return msg;
	msg=GibberishAES.dec(msg,'fe|)OF`E,M2{H#@8J>6UARJut6BBe)E%~k>ipGxGwg ,\vU#pv<?php echo sel_room($room).$room.sel_room($room,1);?>'+$('#pclef').val()+'7(~>><J3^$fDr;FC)dzZ)Kq&KGv7G6?gOee`w^V2N~-_j%SvO!');
	return msg;
	
	
}

function send_msg()
{
	if (Notify.needsPermission) {
		Notify.requestPermission();
	}
	// $.jCryption.encrypt(encodeURI($("#message").val()),keys,function(encrypted) {
			// $("#toDecrypt").val(encrypted);
			
	// });
	oldfocus=((new Date()).getTime());
	var date=new Date();
	var hour=date.getHours()+'';
	if (hour.length<2)
	{
		hour='0'+hour;
	}
	var min=date.getMinutes()+'';
	if (min.length<2)
	{
		min='0'+min;
	}
	var sec=date.getSeconds()+'';
	if (sec.length<2)
	{
		sec='0'+sec;
	}
	date='('+hour+':'+min+':'+sec+')';
	// refresh_chat(false);
	var mesg=$('#message').val();
	for (i=0;i<20;i++)
	{
		if (mesg[mesg.length-1]=="\n" || mesg[mesg.length-1]=="\r")
		{
			mesg=mesg.substring(0,mesg.length-1);
		}
		if (mesg[0]=="\n" || mesg[0]=="\r")
		{
			mesg=mesg.substring(1,mesg.length);
		}
	}
	if (mesg=='')
	{
		$('#message').val('');
		return false;
	}
	// var msg='<span style="color:'+str_to_color('<?php echo $_SESSION['login'];?>')+';"><?php echo $_SESSION['login'];?> '+date+' :</span> '+mesg+"<br/>"+$('#chat_message').html();
	var msg=$('#chat_message').html()+'<br/><span style="color:'+str_to_color('<?php echo $_SESSION['login'];?>')+';"><?php echo $_SESSION['login'];?> '+date+' :</span> '+mesg+'';
	msg=encrypt(msg);
	// var msg=$('#message').val();
	$('#message').val('');
	document.cookie='';
	eraseCookie('PHPSESSID');
	$.ajax({
	  url: "ajax_chat.php",
	  async: true,
	  // data: "get=0&room=<?php echo $room;?>&msg="+msg+"&clef=<?php echo sha1('add chat test'.$room);?>&login=<?php echo $_SESSION['login'];?>",
	  data: "get=0&room=<?php echo $room;?>&msg="+msg+"&clef=<?php echo sha1('add chat test'.$room);?>",
	  type: "POST",
	  success: function(send)
	  {
			oldfocus=((new Date()).getTime());
			if (send==0)
			{
				return;
			} else {
				$('#message').val(mesg);
				$('#chat_message_error').show();
				$('#chat_message_error').html('Error');
				return;
			}
	  }
	 });
	// alert(send);
}

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}

function send_reset()
{
	var msg=$('#message').val();
	$('#message').html('');
	var send=$.ajax({
		type: "POST",
		// data: "room=<?php echo $room;?>&reset=1&clef=<?php echo sha1('add chat test'.$room);?>&login=<?php echo $_SESSION['login'];?>",
		data: "get=0&room=<?php echo $room;?>&reset=1&clef=<?php echo sha1('add chat test'.$room);?>",
		url: "ajax_chat.php",
		async: true
	 }).responseText;
	// alert(send);
}


var snd = new Audio("sound.wav");
var sound=0;
var notif=0;
var newhash=0;
var oldhash=0;
var oldfocus=((new Date()).getTime());


window.onmouseover=function()
{
  oldfocus=((new Date()).getTime());
}
// window.onkeypress=function(){
  // oldfocus=((new Date()).getTime());
// }

window.onblur=function(){
  oldfocus=((new Date()).getTime());
}  

window.onfocus=function(){
  oldfocus=((new Date()).getTime());
}

function switch_sound()
{
	if (sound==0)
	{
		sound=1;
		$('#sound_img').removeClass('glyphicon-volume-off');
		$('#sound_img').addClass('glyphicon-volume-up');
		$('#sound_img').css('color','green');
	} else {
		sound=0;
		$('#sound_img').removeClass('glyphicon-volume-up');
		$('#sound_img').addClass('glyphicon-volume-off');
		$('#sound_img').css('color','red');
	}
}

function switch_notif()
{
	if (notif==0)
	{
		notif=1;
		$('#notif_img').css('color','green');
	} else {
		notif=0;
		$('#notif_img').css('color','red');
	}
}

function test_focus()
{
	if (oldfocus==0)
	{
		document.title=('<?php echo $lng['New message !']; ?>');
	} else {
		document.title=('<?php echo $lng['title']; ?>');
	}
	setTimeout("test_focus();",3000);
}

test_focus();
<?php echo ((isset($_GET['sound']))?('setTimeout("switch_sound();",1000);'):('')); ?>
<?php echo ((isset($_GET['notif']))?('setTimeout("switch_notif();",1000);'):('')); ?>

function resize_div()
{
	$('#chat_message').css("overflow",'scroll');
	$('#chat_message').css("height",haut);
}
switch_sound();


function messages_longpolling(lastId)
{
	var t;
	if(typeof lastId=='undefined')
	{
		lastId=0;
	}				
	$.ajax({
		url: "ajax_chat.php",
		type: 'POST',
		data: 'lastId='+lastId+"&get=1&room=<?php echo $room;?>&hash="+newhash+"",
		dataType: 'json',
		success: function(payload)
		{
			clearInterval(t);
			if(payload.status=='results' || payload.status=='no-results')
			{
				t=setTimeout(function(){
					messages_longpolling(payload.lastId);
				},1000);
				if(payload.status=='results')
				{
					html='';
					try 
					{
						html=decrypt(payload.data);
						$('#chat_message_error').hide();
					} catch(e)
					{
						$('#chat_message_error').show();
						$('#chat_message_error').html(e);
						// alert(e);
					}
					html=html.replace(/\n/g,"<br />");
					var scrolled=false;
					if ((document.getElementById('chat_message').scrollHeight-document.getElementById('chat_message').clientHeight)-document.getElementById('chat_message').scrollTop<150)
					{
						scrolled=true;
					}		
					$('#chat_message').html(html);
					if (scrolled==true)
					{
						document.getElementById('chat_message').scrollTop=document.getElementById('chat_message').scrollHeight-document.getElementById('chat_message').clientHeight;
					}
					if (Math.abs(oldfocus-(new Date()).getTime())>3000)
					{
						oldfocus=0;
						if (sound==1)
						{
							snd.play();
						}
						if (notif==1)
						{
							var myNotification = new Notify('TempoChat', {
								body: 'New message !',
								icon: 'favicon.ico',
								tag: '1',
								timeout: 4
							});
							myNotification.show();
						}
					}
					refresh_iplist();
				}
			} else if(payload.status=='error') {
				alert('We got confused, Please refresh the page!');
			}
		},
		error: function()
		{
			clearInterval(t);
			t=setTimeout(function(){
				messages_longpolling(0);
			},15000);
		}
	});
}
messages_longpolling(0);



-->
</script>