<script type="text/javascript">
Ext.Loader.setConfig({
  enabled: true
});
Ext.Loader.setPath('Ext.ux', '<?=base_url();?>assets/js/ext-4.0.1/ux');

Ext.require([
  'Ext.data.*',
  'Ext.util.*',
  'Ext.form.*',
  'Ext.tip.QuickTipManager',
  'Ext.tip.*',
  'Ext.window.*'
]);

Ext.onReady(function(){

  Ext.QuickTips.init();

  var login = Ext.create('Ext.form.FormPanel', {
    padding: '20 0 0 0',
    url: '<?=base_url()?>login/entrar',
    frame: true,
    title: false,
    defaultType:'textfield',
    monitorValid:true,
    items: [{
      fieldLabel: 'Usuario',
      name: 'login_username',
      emptyText: 'usuario',
      allowBlank: false,
      labelStyle: 'text-align:right;font-weight:bold;'
    },{
      fieldLabel: 'Contraseña',
      name: 'login_password',
      inputType: 'password',
      emptyText: 'contraseña',
      allowBlank: false,
      labelStyle: 'text-align:right;font-weight:bold;'
    }],
    buttons: [{
      text: 'Entrar',
      formBind: true,
      margin: '0 5 5 0',
      handler: function(){
        login.submit({
          method: 'post',
          waitTitle: 'Conectándose',
          waitMsg: 'Enviando información...',
          success: function(){
            var redirect = '<?=base_url()?>admin';
            window.location = redirect;
          },
          failure: function(){
            Ext.MessageBox.show({
              title: '<font color="red">Error</font>',
              msg: 'Datos incorrectos',
              buttons: Ext.MessageBox.OK
            });
          }
        }); // END submit
      }// END handler
    }]
  }); //END Ext.form.FormPanel


  var win = Ext.create('widget.window',{
    layout: 'fit',
    width: 300,
    height: 120,
    y: 100,
    modal: true,
    frame: true,
    closable: false,
    resizable: false,
    draggable: false,
    plain: true,
    border: false,
    //title: 'Por favor, ingresa',
    items:[login]
  });

  win.show();
}); //END Ext.onReady
</script>
