<?$this->load->view('admin/head',$title);?>
<script src="<?=base_url();?>assets/js/jquery-1.5.1.min.js" type="text/javascript"></script>

<script type="text/javascript">
Ext.require([
  'Ext.form.*',
  'Ext.window.*'
]);

Ext.onReady(function (){
  var form = Ext.widget('form', {
    frame: true,
    fieldDefaults: {
      labelAlign: 'left',
      msgTarget: 'none',
      invalidCls: ''
    },
    defaults: {
      anchor: '100%'
    },
    items: [{
      xtype: 'textfield',
      name: 'password',
      inputType: 'password',
      fieldLabel: 'Nueva Contraseña',
      allowBlank: false,
      minLength: 4
    }]
  });
  
  var win;
  win = Ext.create('widget.window', {
    title: 'Modificar Contraseña',
    width: 350,
    height: 'auto',
    closable: true,
    items: [form]
  });
  
  $('.clickable').click(function (){
    win.show();
  });
});
</script>

<center>
<?php 
 foreach ($table as $key):
  echo "<a href=\"#\" class=\"clickable\" id=\"user_".$key['id']."\">".$key['username']."</a>";
 endforeach;
?>
</center>

<?$this->load->view('admin/foot');?>
