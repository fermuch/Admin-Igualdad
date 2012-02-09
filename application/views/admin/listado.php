<? $this->load->view('admin/head',$title); ?>
<style>
label, input { display:block; }
input, select, textarea { margin-bottom:12px; width:95%; padding: .4em; }
fieldset { padding:0; border:0; margin-top:25px; }
</style>
<script type="text/javascript">
$(function() {
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
  

  
  
  $( "#dialog-form" ).dialog({
	autoOpen: false,
	height: 400,
	width: 350,
	modal: true,
	buttons: {
	  "Cancelar": function() {
		$(this).dialog("close");
	  },
	  "Añadir/Modificar": function() {
		// comprobaciones y esas mierdas
	  }
	},
	close: function() {
	  //allFields.val( "" ).removeClass( "ui-state-error" );
	}
  });

  $("#boton-dialog").button().click(function() {
	$( "#dialog-form" ).dialog( "open" );
  });
}); //END document.ready
</script>
<!-- Content (Right Column) -->
<div id="content" class="box">
	<h1>Listado de Alumnos</h1>
	<p class="msg warning">Este sistema aún se encuentra en <strong>beta</strong>.</p>
	<!-- Table -->
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
	<center><input style="margin-top:30px;height:45px;width:150px;" id="boton-dialog" type="button" value="Añadir Alumno"/></center>


<div id="dialog-form" title="Añadir/Modificar Alumno">
	<p class="msg info">Todos los campos son requeridos.</p>
	<form>
	<fieldset>
		<label for="apellido">Apellido</label>
		<input type="text" name="apellido" id="apellido" class="text ui-widget-content ui-corner-all" />
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" id="nombre" value="" class="text ui-widget-content ui-corner-all" />
		<label for="cuil">CUIL</label>
		<input type="text" name="cuil" id="cuil" value="" class="text ui-widget-content ui-corner-all" />
		<label for="serie">Serie</label>
		<input type="text" name="serie" id="serie" value="" class="text ui-widget-content ui-corner-all" />
		<label for="estado">Estado</label>
		<select name="estado">
		  <option value="1">Ingresada</option>
		  <option value="2">Revisión</option>
		  <option value="3">Servicio Técnico</option>
		  <option value="4">Lista</option>
		  <option value="5">Retirada</option>
		</select>
		<label for="motivo">Motivo</label>
		<input type="text" name="motivo" id="motivo" value="" class="text ui-widget-content ui-corner-all" />
		<label for="nota">Nota</label>
		<textarea name="nota" id="nota" value="" class="text ui-widget-content ui-corner-all"></textarea>
	</fieldset>
	</form>
</div>

</div> <!-- /content -->
<? $this->load->view('admin/foot'); ?>
