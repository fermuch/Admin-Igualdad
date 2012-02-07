<?$this->load->view('admin/head',$title);?>
<script type="text/javascript">
$(document).ready(function(){
  $('#feedbacks tr:even').addClass('bg');
});
</script>
<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>Feedback</h1>
			<p class="msg info">Los alumnos, al entrar al sistema, ven un botón que dice <strong>Feedback</strong>. Al escribir una sugerencia, ésta es depositada aquí, permitiendo saber cómo mejorar el sistema.</p>
			<p class="msg warning">Los registros más nuevos se ordenan al principio, para poder leer antes los nuevos.</p>
			<table style="width: 100%" id="feedbacks">
				<tr>
				    <th width="5%">ID</th>
				    <th width="30%">Alumno</th>
				    <th width="65%">Sugerencia</th>
				</tr>
				<?foreach($data as $key):?>
				<tr>
				    <td><?=$key['id']?></td>
				    <td><?=$key['title']?></td>
				    <td><?=$key['text']?></td>
				</tr>
				<?endforeach;?>
			</table>

		</div> <!-- /content -->

	</div> <!-- /cols -->
<?$this->load->view('admin/foot');?>
