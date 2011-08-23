<? $this->load->view('head',$title); ?>
<center>
<h1>Listado</h1>
<!-- SEARCH -->
<form method="post" action="<?=base_url()?>listado/buscar" id="buscador">
<input type="text" value="<?=$search?>" name="search" />
<input type="submit" value="Buscar" />
</form>
<!-- END SEARCH -->
  <?=$table?>
<!--<a href="<?=base_url()?>">Regresar al índice</a>-->
</center>
<? $this->load->view('foot'); ?>
