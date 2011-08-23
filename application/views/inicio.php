<? $this->load->view('head',$title); ?>
<center>
<h1>¡Bienvenido!</h1>
<p>Para buscar el estado de tu netbook, ingresá tu nombre y/o apellido en el recuadro siguiente:</p>
<!-- SEARCH -->
<form method="post" action="<?=base_url()?>listado/buscar" id="buscador">
<input type="text" name="search" />
<input type="submit" value="Buscar" />
</form>
<!-- END SEARCH -->
</center>
<? $this->load->view('foot'); ?>
