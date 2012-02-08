<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="es" />
	<meta name="robots" content="noindex,nofollow" />
	<link rel="icon" type="image/x-icon" href="<?=base_url();?>assets/favicon.ico">
	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/ui-lightness/jquery-ui-1.8.17.custom.css" /> <!-- JQUERY UI -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/reset.css" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/main.css" /> <!-- MAIN STYLE SHEET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/2col.css" title="2col" /> <!-- DEFAULT: 2 COLUMNS -->
	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/1col.css" title="1col" /> <!-- ALTERNATE: 1 COLUMN -->
	<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/main-ie6.css" /><![endif]--> <!-- MSIE6 -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/style.css" /> <!-- GRAPHIC THEME -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/jquery.dataTables.css" /> <!-- DataTable CSS -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/mystyle.css" /> <!-- WRITE YOUR CSS CODE HERE -->
	<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/switcher.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/toggle.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.dataTables.js"></script>
	<title><?=$title?></title>
</head>

<body>
<div id="main">

	<!-- Tray -->
	<div id="tray" class="box">
		<p class="f-right">Usuario: <strong><a href="#">Administrator</a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="<?=base_url()?>login/logout" id="logout">Salir</a></strong></p>
	</div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">

		<!-- Aside (Left Column) -->
		<div id="aside" class="box">

			<div class="padding box">

				<!-- Logo (Max. width = 200px) -->
				<p id="logo"><a href="#"><img src="<?=base_url();?>assets/img/nyancat.png" alt="Sistema Verde" title="Sistema Verde" /></a></p>

				<!-- Search -->
				<!--<form action="#" method="get" id="search">
					<fieldset>
						<legend>Search</legend>

						<p><input type="text" size="17" name="" class="input-text" />&nbsp;<input type="submit" value="OK" class="input-submit-02" /><br />
						<a href="javascript:toggle('search-options');" class="ico-drop">Advanced search</a></p>

					</fieldset>
				</form>-->

			</div>

			<ul class="box"> <!-- menu -->
				<li <?if($menu == 1):?>id="submenu-active"<?else:?>id="submenu"<?endif;?>><a href="<?=base_url()?>admin/alumnos">Listado de Alumnos</a></li>
				<li <?if($menu == 2):?>id="submenu-active"<?else:?>id="submenu"<?endif;?>><a href="<?=base_url()?>admin/users">Control de Usuarios</a></li>
				<li <?if($menu == 3):?>id="submenu-active"<?else:?>id="submenu"<?endif;?>><a href="<?=base_url()?>admin/feedback">Feedback</a></li>
				<li <?if($menu == 4):?>id="submenu-active"<?else:?>id="submenu"<?endif;?>><a href="<?=base_url()?>admin/stats">Estadísticas</a></li>
			</ul>
		</div>

		<hr class="noscreen" />