<!DOCTYPE html>
<html>
<html>
  <title>Escuela Verde - <?=$title?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <link rel="icon" type="image/x-icon" href="<?=base_url();?>assets/favicon.ico">
  <link rel="stylesheet" href="<?=base_url();?>assets/css/tables.css" type="text/css" media="screen" charset="utf-8" />
  <link rel="stylesheet" href="<?=base_url();?>assets/css/admin_head.css" type="text/css" media="screen" charset="utf-8" />
  
  <!-- ExtJS -->
  <link rel="stylesheet" href="<?=base_url();?>assets/js/ext-4.0.1/resources/css/ext-all.css" type="text/css" media="screen" charset="utf-8" />
  <script type="text/javascript" src="<?=base_url();?>assets/js/ext-4.0.1/ext-all-debug-w-comments.js"></script>
  <script type="text/javascript" src="<?=base_url();?>assets/js/ext-4.0.1/locale/ext-lang-es.js"></script>
  <link rel="stylesheet" href="<?=base_url();?>assets/css/extjs_icons.css" type="text/css" media="screen" charset="utf-8" />

</head>
<body>
<header><h1><?=$title?></h1></header>
<div id="admin_panel">
<!--  <a href="<?=base_url()?>admin/">Panel de administración</a> / -->
  <a href="<?=base_url()?>admin/alumnos">Listado de alumnos</a> /
  <a href="<?=base_url()?>admin/feedback">Feedback</a> /
  <a href="<?=base_url()?>admin/stats">Estadísticas</a> /
  <a href="<?=base_url()?>login/logout">Cerrar sesión</a>
</div>
