<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <? if( $mobile == TRUE ) ?>
  <meta name="viewport" content="user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
  <? endif ?>
  <title>Login - nekop.kr</title>
</head>
<style>
body {
  background-color:black;
}
#c {
  opacity:.8;
}
canvas {
  position:absolute;
  top:0; left:0;
}

#panel {
  position: absolute;
  z-index: 1000;
  width: 300px;
  height: 400px;
}

#usr_icon {
  margin: 15px;
  width: 241px;
  height: 221px;
  background-image: url("/static/cat.png");
  border-radius: 50%;
}

#username #user {
  border: 0px;
  border-radius: 3px; 
  padding: 10px 10px;
}

#password #pass {
  border: 0px;
  border-radius: 3px;
  padding: 10px 10px;
  margin-top: 10px;
}

#login {
  border: 0px;
  border-radius: 3px;
  padding: 10px 35px;
  margin-top: 15px;
  cursor: pointer;
  background: #898E8C;
  color: #fff;
}

#login:hover {
  background: #707573;
}

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
function onKeyDown(){
     if(event.keyCode == 13){
	$("#login").click();
     }
}

$(function(){
	var width = $(window).width();
	$("#c").attr("width", $(window).width());
	$("#bg").attr("width", $(window).width());
        $("#c").attr("height", $(window).height());
        $("#bg").attr("height", $(window).height());

        $("#c").css("width", $(window).width());
        $("#bg").css("width", $(window).width());
        $("#c").css("height", $(window).height());
        $("#bg").css("height", $(window).height());

	$("#usr_icon").css("margin-left", ($("#panel").width() - $("#usr_icon").width()) / 2);
	$("#panel").css("left", ($(window).width() - $("#panel").width()) / 2);
	$("#user").css("margin-left", ($("#panel").width() - $("#user").width()) / 2 - 10);
        $("#pass").css("margin-left", ($("#panel").width() - $("#pass").width()) / 2 - 10);
	$("#login").css("margin-left", ($("#panel").width() - $("#login").width()) / 2 - 35);
	$(window).resize(function(){
		var width = $(window).width();
		$("#panel").css("left", ($(window).width() - $("#panel").width()) / 2);
		$("#user").css("margin-left", ($("#panel").width() - $("#user").width()) / 2 - 10);
	        $("#pass").css("margin-left", ($("#panel").width() - $("#pass").width()) / 2 - 10);
		$("#login").css("margin-left", ($("#panel").width() - $("#login").width()) / 2 - 35);
		$("#c").attr("width", $(window).width());
	        $("#bg").attr("width", $(window).width());
	        $("#c").attr("height", $(window).height());
	        $("#bg").attr("height", $(window).height());

                $("#c").css("width", $(window).width());
                $("#bg").css("width", $(window).width());
                $("#c").css("height", $(window).height());
                $("#bg").css("height", $(window).height());

		window.cancelAnimationFrame(loop);

		w = $(window).width();
		h = $(window).height();
		ctx = c.getContext("2d");

		//parameters
		total = w,
		accelleration = .05,

		//afterinitial calculations
		size = w/total,
		occupation = w/total,
		repaintColor = 'rgba(0, 0, 0, .04)'
		colors = [],
		dots = [],
		dotsVel = [],
		loop = "";

		//setting the colors' hue
		//and y level for all dots
		var portion = 360/total;
		for(var i = 0; i < total; ++i){
			colors[i] = portion * i;
			dots[i] = h;
			dotsVel[i] = 10;
		}
		anim();
	});

	$("#login").click(function(){
		var form = $("<form></form>");
		form.attr("action", "/user/login_action");
		form.attr("method", "POST");
		form.appendTo("body");
		
		var username = $("#user")[0].value;
		var password = $("#pass")[0].value;
		
		var user = $("<input type='hidden' name='username' value='" + username + "'>");
		var pass = $("<input type='hidden' name='password' value='" + password + "'>");
		form.append(user).append(pass).submit();
	});
});
</script>
<body>
  <canvas id="c"></canvas>
  <canvas id="bg"></canvas>
  <div id="panel">
    <div id="usr_icon"></div>
    <div id="username">
      <input type="text" id="user" placeholder="KuroNeko">
    </div>
    <div id="password">
      <input type="password" id="pass" onKeyDown="onKeyDown();" placeholder="Password">
    </div>
    <div id="submit">
      <button id="login">Login</button>
    </div>
  </div>
</body>
<script>
      //initial
var w = c.width = $(window).width(),
    h = c.height = $(window).height(),
    ctx = c.getContext('2d'),
    
    //parameters
    total = w,
    accelleration = .05,
    
    //afterinitial calculations
    size = w/total,
    occupation = w/total,
    repaintColor = 'rgba(0, 0, 0, .04)'
    colors = [],
    dots = [],
    dotsVel = [],
    loop = "";

//setting the colors' hue
//and y level for all dots
var portion = 360/total;
for(var i = 0; i < total; ++i){
  colors[i] = portion * i;
  
  dots[i] = h;
  dotsVel[i] = 10;
}

function anim(){
  loop = window.requestAnimationFrame(anim);
  
  ctx.fillStyle = repaintColor;
  ctx.fillRect(0, 0, w, h);
  
  for(var i = 0; i < total; ++i){
    var currentY = dots[i] - 1;
    dots[i] += dotsVel[i] += accelleration;
    
    ctx.fillStyle = 'hsl('+ colors[i] + ', 80%, 50%)';
    ctx.fillRect(occupation * i, currentY, size, dotsVel[i] + 1);
    
    if(dots[i] > h && Math.random() < .01){
      dots[i] = dotsVel[i] = 0;
    }
  }
}

anim();

</script>
</html>
