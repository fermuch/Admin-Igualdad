<? $this->load->view('admin/head',$title); ?>
<script type="text/javascript">
$(document).ready(function(){
  $('#alumnos').dataTable({
	"oLanguage": {
	  "sProcessing":   "Procesando...",
	  "sLengthMenu":   "Mostrar _MENU_ registros",
	  "sZeroRecords":  "No se encontraron resultados",
	  "sInfo":         "Mostrando _START_/_END_ (_TOTAL_ en total)",
	  "sInfoEmpty":    "No se está mostrando nada.",
	  "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
	  "sInfoPostFix":  "",
	  "sSearch":       "Buscar:",
	  "sUrl":          "",
	  "oPaginate": {
		  "sFirst":    "Primero",
		  "sPrevious": "Anterior",
		  "sNext":     "Siguiente",
		  "sLast":     "Último"
	  }
	}
  });
});
</script>

<!-- Content (Right Column) -->
<div id="content" class="box">
	<h1>Listado de Alumnos</h1>
	<p class="msg info">Puede que ocurran errores inesperados. Esta página aún se encuentra en <strong>beta</strong>.</p>
	<!-- Table -->
	<h3 class="tit">Listado de Alumnos</h3>
	<table class="nostyle" id="alumnos">
		<thead>
		  <tr>
			  <th>ID</th>
			  <th>Apellido</th>
			  <th>Nombre</th>
			  <th>CUIL</th>
			  <th>Serie</th>
			  <th>Estado</th>
			  <th>Motivo</th>
			  <th>Nota</th>
		  </tr>
		</thead>
		<tbody>
		  <?foreach($data as $key):?>
		  <tr>
			  <td><?=$key['id']?></td>
			  <td><?=$key['apellido']?></td>
			  <td><?=$key['nombre']?></td>
			  <td><?=$key['cuil']?></td>
			  <td><?=$key['serie']?></td>
			  <td><?=$key['estado']?></td>
			  <td><?=$key['motivo']?></td>
			  <td><?=$key['nota']?></td>
		  </tr>
		  <?endforeach;?>
		</tbody>
	</table>
</div> <!-- /content -->
<? $this->load->view('admin/foot'); ?>
