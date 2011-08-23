<?php
/*
  TODO: Crear un grid con ExtJS para mostrar los resultados
*/
?>
<?foreach($data as $row):?>
<div style="font-family: 'Ubuntu';padding:10px;height:100%;">
  <h1><?=$row['fecha']?> - <?=$row['estado']?></h1>
  <ul>
    <li><pre style="font-weight:bold;">Motivo:</pre> <?=$row['motivo']?></li>
    <li><pre style="font-weight:bold;">Nota:</pre> <?=$row['nota']?></li>
  </ul>
<br />
</div>
<?endforeach;?>
