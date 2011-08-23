Ext.onReady(function(){
  var form = Ext.widget('form', {
    url: Ext.get('feedback_url').dom.innerHTML,
    layout: {
        type: 'vbox',
        align: 'stretch'
    },
    border: false,
    bodyPadding: 10,

    fieldDefaults: {
        labelAlign: 'top',
        labelWidth: 100,
        labelStyle: 'font-weight:bold'
    },
    defaults: {
        margins: '0 0 10 0'
    },
    items: [{
        xtype: 'component',
        html: '¿Pensás que al sistema le falta algo?<br/>' +
              'Si me enviás un feedback, podré ver qué es lo que deseás que se añada, ¡y lo puedo llegar a añadir! :)',
        style: 'margin-bottom: 20px;'
    },{
        xtype: 'textfield',
        fieldLabel: '¿Cuál es tu nombre?',
        name: 'title',
        allowBlank: false
    }, {
        xtype: 'textareafield',
        fieldLabel: '¿Qué función deseás que sea añadida al sistema?',
        name: 'body',
        labelAlign: 'top',
        flex: 1,
        margins: '0',
        allowBlank: false
    }],

    buttons: [{
        text: 'Cancelar',
        handler: function() {
            this.up('form').getForm().reset();
            this.up('window').hide();
        }
    }, {
        text: 'Enviar',
        handler: function() {
            if (this.up('form').getForm().isValid()) {
                // In a real application, this would submit the form to the configured url
                this.up('form').getForm().submit({
                  method: 'post',
                  waitMsg: 'Enviando feedback...',
                  success: function(){
                    form.getForm().reset();
                    win.hide();
                    Ext.MessageBox.alert('¡Gracias!', 'Prometo revisar tu petición lo antes posible :)'); 
                  },
                  failure: function(){
                    Ext.MessageBox.alert('¡Error!', 'Ocurrió un error reportando el feedback =S');
                  }
                });
            }
        }
    }]
  });

  win = Ext.widget('window', {
    title: 'Solicitar añadir una función',
    closeAction: 'hide',
    width: 400,
    height: 400,
    minHeight: 400,
    layout: 'fit',
    resizable: true,
    modal: true,
    items: form
  });

  var feedbackBtn = Ext.get('feedback');
  feedbackBtn.on('click',function(){
    win.show();
  });
});
