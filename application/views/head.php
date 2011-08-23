<!DOCTYPE html>
<html>
<head>
  <title>Escuela Verde - <?=$title?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <link rel="icon" type="image/x-icon" href="<?=base_url();?>assets/favicon.ico">
  <link rel="stylesheet" href="<?=base_url();?>assets/css/tables.css" type="text/css" media="screen" charset="utf-8" />
<!--  <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'> -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/main.css" type="text/css" media="screen" charset="utf-8" />
  
  <!-- ExtJS -->
  <link rel="stylesheet" href="<?=base_url();?>assets/js/ext-4.0.1/resources/css/ext-all.css" type="text/css" media="screen" charset="utf-8" />
  <script type="text/javascript" src="<?=base_url();?>assets/js/ext-4.0.1/ext-all.js"></script>
  <script type="text/javascript" src="<?=base_url();?>assets/js/ext-4.0.1/locale/ext-lang-es.js"></script>
  <link rel="stylesheet" href="<?=base_url();?>assets/css/extjs_icons.css" type="text/css" media="screen" charset="utf-8" />
  
  <!-- FEEDBACK -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/feedback.css" type="text/css" media="screen" charset="utf-8" />
  <script src="<?=base_url()?>assets/js/feedback/main.js"></script>
</head>
<body>

<!-- easter -->
<script src="<?=base_url();?>assets/js/jquery-1.5.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
(function($) {

	$.fn.konami = function(callback, code) {
		if(code == undefined) code = "38,38,40,40,37,39,37,39,66,65";
		
		return this.each(function() {
			var kkeys = [];
			$(this).keydown(function(e){
				kkeys.push( e.keyCode );
				while (kkeys.length > code.split(',').length) {
          kkeys.shift();
        }
				if ( kkeys.toString().indexOf( code ) >= 0 ){
					$(this).unbind('keydown', arguments.callee);
					callback(e);
				}
			}, true);
		});
	}
})(jQuery);
</script>
<style type="text/css">
#canvas {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  z-index: -100;
}
#nyan {
  position: absolute;
  left:-150px;
  bottom:0;
  overflow: hidden;
}
</style>
<canvas height="600" width="600" id="canvas"></canvas>
<img src="<?=base_url();?>assets/img/nyancat.png" alt="NyanCat!" id="nyan"></img>
<script>
$(window).konami(function(){

var canvas = document.getElementsByTagName('canvas')[0],
    ctx = null,
    grad = null,
    body = document.getElementsByTagName('body')[0],
    color = 255;
    

if (canvas.getContext('2d')) {
  ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, 600, 600);
  ctx.save();
  // Create radial gradient
  grad = ctx.createRadialGradient(0,0,0,0,0,600); 
  grad.addColorStop(0, '#FFF');
  grad.addColorStop(1, 'rgb(' + color + ', ' + color + ', ' + color + ')');

  // assign gradients to fill
  ctx.fillStyle = grad;

  // draw 600x600 fill
  ctx.fillRect(0,0,600,600);
  ctx.save();
  
  body.onmousemove = function (event) {
    var width = window.innerWidth, 
        height = window.innerHeight, 
        x = event.clientX, 
        y = event.clientY,
        rx = 600 * x / width,
        ry = 600 * y / width;
        
    var xc = ~~(256 * x / width);
    var yc = ~~(256 * y / height);

    grad = ctx.createRadialGradient(rx, ry, 0, rx, ry, 600); 
    grad.addColorStop(0, '#FFF');
    grad.addColorStop(1, ['rgb(', xc, ', ', (255 - xc), ', ', yc, ')'].join(''));
    // ctx.restore();
    ctx.fillStyle = grad;
    ctx.fillRect(0,0,600,600);
    // ctx.save();
  };
}

$('#nyan').animate({
    left: '+=800',
    opacity: '0'
  }, 7000,function(){$('#nyan').hide();});

}); // end konami
</script>

<!-- end easteregg -->
