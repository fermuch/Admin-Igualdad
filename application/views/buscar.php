<? $this->load->view('head',$title); ?>
<center>
<h1>Búsqueda</h1>
<!-- SEARCH -->
<form method="post" action="<?=base_url()?>listado/buscar">
<input type="text" name="search" />
<input type="submit" value="¡Buscar!" />
</form>
<!-- END SEARCH -->
  <?=$table?>
</center>
<? $this->load->view('foot'); ?>
