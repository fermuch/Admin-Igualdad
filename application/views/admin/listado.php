<? $this->load->view('admin/head',$title); ?>

<script type="text/javascript">
Ext.Loader.setConfig({
    enabled: true
});
Ext.Loader.setPath('Ext.ux', '<?=base_url();?>assets/js/ext-4.0.1/ux');

Ext.require([
    'Ext.data.*',
    'Ext.grid.*',
    'Ext.util.*',
    'Ext.state.*',
    'Ext.form.*',
    'Ext.tip.QuickTipManager',
    'Ext.layout.container.Border'
]);

Ext.onReady(function(){
    Ext.QuickTips.init();
    
    // Prepare the combobox
    Ext.define("Motivo", {
        extend: 'Ext.data.Model',
        proxy: {
            type: 'ajax',
            url : 'ajax_motivos',
            reader: {
                type: 'json',
                root: 'motivos',
                totalProperty: 'total'
            },
            actionMethods: {
               'read': 'POST',
               'create': 'POST',
               'update': 'POST',
               'destroy': 'POST',
            }
        },
        fields: [
          {name: 'text'}
        ]
    });
    
    var MotivoStore = Ext.create('Ext.data.Store',{
      pageSize: 10,
      model: "Motivo"
    });
    
    
    Ext.define('Alumnos',{
        extend: 'Ext.data.Model',
        fields: [
            {name: 'id', type: 'int'},
            'nombre','apellido',
            {name: 'cuil'},
            {name: 'serie'},
            'estado',
            'motivo',
            'nota'
        ]
    });

    // create the Data Store
    var store = Ext.create('Ext.data.Store', {
        model: 'Alumnos',
        /*autoLoad: true,
        autoSync: false,*/
        proxy: {
            // load using HTTP
            type: 'rest',
            method: 'POST',
            //url: 'ajax_alumnos',
            api: {
                read: 'ajax_alumnos/list',
                create: 'ajax_alumnos/create',
                update: 'ajax_alumnos/update',
                destroy: 'ajax_alumnos/destroy'
            },
            reader: {
                type: 'json',
                root: 'alumnos'
            },
            writer: {
                type: 'json'
            }
        },
        listeners: {
            exception: function(proxy, response, operation){
                Ext.MessageBox.show({
                    title: 'ERROR',
                    msg: operation.getError(),
                    icon: Ext.MessageBox.ERROR,
                    buttons: Ext.Msg.OK
                });
            }
        }
    });
    
    // create the editor
    var rowEditing = Ext.create('Ext.grid.plugin.RowEditing', {
        clicksToMoveEditor: 1,
        autoCancel: false
    });

    // create the grid
    var grid = Ext.create('Ext.grid.Panel', {
        /*height: 250,*/
        height: 500,
        region: 'center',
        frame: false,
        plugins: [rowEditing],
        store: store,
        columns: [
            /*{
              xtype: 'rownumberer',
              width: 25,
              sortable: false
            },*/
            {text: "Apellido", flex: 1, dataIndex: 'apellido', sortable: true, editor: { allowBlank: false } },
            {text: "Nombre", flex: 1, dataIndex: 'nombre', sortable: true, editor: { allowBlank: false } },
            {text: "CUIL", flex: 1, dataIndex: 'cuil', sortable: true, editor: { allowBlank: false } },
            {text: "Serie", flex: 1, dataIndex: 'serie', sortable: true, editor: { allowBlank: false } },
            {
              text: "Estado",
              flex: 1,
              dataIndex: 'estado',
              sortable: true,
              editor: { xtype:'combo', 
                        store: new Ext.data.ArrayStore({
                          fields: ['action'],
                          data : [                                         
                                   ['Ingresada'],
                                   ['Revisión'],
                                   ['Servicio Técnico'],
                                   ['Lista'],
                                   ['Retirada']
                                  ]
                          }),
                          displayField:'action',
                          valueField: 'action',
                          mode: 'local',
                          //typeAhead: true,
                          triggerAction: 'all',
                          autoShow: true,
                          autoSelect: true,
                          editable: false,
                          emptyText: 'Selecciona un estado',
                          listeners : {
                            added: function(){ this.value = null; }
                          }
                      }
            },
            //{text: "Motivo", width: 180, dataIndex: 'motivo', sortable: true, editor: { allowBlank: true } },
            {
              text: "Motivo",
              dataIndex: 'motivo',
              flex: 1,
              sortable: true,
              editor: {
                xtype: 'combo',
                store: MotivoStore,
                displayField: 'text',
                emptyText:'Escribe un motivo',
                editable: true,
                hideLabel: true,
                hideTrigger:true,
                autoShow: true,
                autoSelect: true,
                //anchor: '100%'
                listConfig: {
                  loadingText: 'Buscando...',
                  emptyText: 'No hay ningún motivo que coincida.'
                },
                //pageSize: 10
              }
            },
            {text: "Nota", flex: 2, dataIndex: 'nota', sortable: true, editor: { allowBlank: true } }
        ],
        tbar: [{
            text: 'Añadir Usuario',
            iconCls: 'add',
            handler : function() {
                rowEditing.cancelEdit();

                // Create a record instance through the ModelManager
                var r = Ext.ModelManager.create({
                    nombre:'Alumno',
                    apellido:'Nuevo',
                    cuil:'123456789',
                    serie:'123456789'
                }, 'Alumnos');

                //rowEditing.cancelEdit();
                store.insert(0, r);
                rowEditing.startEdit(0, 0);
            }
        }, {
            itemId: 'removeAlumno',
            text: 'Eliminar Usuario',
            iconCls: 'rem',
            handler: function() {
                var selection = grid.getView().getSelectionModel().getSelection()[0];
                if (selection) {
                    store.remove(selection);
                    store.sync();
                }
            },
            disabled: false
        },'->',{
            xtype: 'button',
            name: 'ver_historial',
            id: 'ver_historial',
            text: 'Ver historial',
            iconCls: 'magnifier'
       },'-',{ 
            xtype: 'textfield',
            name: 'filtro',
            id:'filtro',
            emptyText: 'Filtrar...',
            enableKeyEvents: true,
            allowBlank: false  // requires a non-empty value
       },{
            xtype: 'button',
            name: 'filtrar',
            id: 'filtrar',
            text: 'Filtrar',
            iconCls: 'search'
       },{
            xtype: 'button',
            name: 'quitar_filtro',
            id: 'quitar_filtro',
            text: 'Quitar Filtro',
            iconCls: 'cancel'
       }],
        
    });
    
    grid.on('edit', onEdit, this);

    function onEdit(e) {
        // execute an XHR to send/commit data to the server, in callback do (if successful):
        store.sync();
        //console.log('Sincronizado');
     };
     
     // filters for the grid
     var filtrar = Ext.getCmp('filtrar');
     filtrar.on('click', Filter, this);
     
     function Filter(e){
        var filtro = Ext.getCmp('filtro');
        busqueda = filtro.getValue();
        if (busqueda == ""){
          Ext.Msg.alert('Error', 'No pusiste ningún parámetro de filtro.');
        }else{
          store.filterBy(function(r, id){
            //console.log("Un nuevo record! Texto a filtrar: "+busqueda);
            var nombre   = r.get('nombre'),
                apellido = r.get('apellido'),
                cuil     = r.get('cuil'),
                serie    = r.get('serie'),
                estado   = r.get('estado');
             //console.log("Nombre: "+nombre+". Apellido: "+apellido);
             
             snombre   = RegExp(busqueda, "i").test(nombre);
             sapellido = RegExp(busqueda, "i").test(apellido);
             scuil     = RegExp(busqueda, "i").test(cuil);
             sserie    = RegExp(busqueda, "i").test(serie);
             sestado   = RegExp(busqueda, "i").test(estado);
             
             if (snombre == true || sapellido == true || scuil == true || sserie == true || sestado == true){
                return(true);
             }else{
                return(false);
             }
          }, this);
        }
     }
     
     var quitar_filtro = Ext.getCmp('quitar_filtro');
     quitar_filtro.on('click', QFiltro, this);
     
     function QFiltro(){
      store.clearFilter();
     }
     
     
    var AlumnoTplMarkup = [
        '<p><font size="3em">{nombre} {apellido}</font></p><br>',
        '<p><pre style="font-weight:bold;">Nota:</pre> {nota}</p>',
        '<p><pre style="font-weight:bold;">Motivo:</pre> {motivo}</p>',
    ];
    var AlumnoTpl = Ext.create('Ext.Template', AlumnoTplMarkup);
    
    Ext.create('Ext.Panel', {
        renderTo:'table-alumnos',
        width: '95%',
        height: 550,
        frame: true,
        title: 'Listado de Alumnos',
        layout: 'border',
        bodyStyle: "background: #ffffff;text-align:left;font-family: 'Ubuntu';",
        items: [
            grid,
            {
                id: 'detailPanel',
                region: 'south',
                bodyPadding: 7,
                bodyStyle: "background: #ffffff;text-align:left;font-family: 'Ubuntu';",
                html: 'Seleccioná un alumno para ver sus detalles.',
                height: 150
        }]
    }); //END: Ext.Panel
    
    var selected_row = null;
    
    /* grid.onselectionchange */
    grid.getSelectionModel().on('selectionchange', function(sm, selectedRecord) {
        if (selectedRecord.length) {
            var detailPanel = Ext.getCmp('detailPanel');
            AlumnoTpl.overwrite(detailPanel.body, selectedRecord[0].data);
            selected_row = selectedRecord[0].data.id;
        }
    });
    
    var ver_historial = Ext.getCmp('ver_historial');
    ver_historial.on('click', VerHistorial, this);
     
    function VerHistorial(){
       if(selected_row == null){
        Ext.Msg.alert('Error', 'No seleccionaste ninguna fila.');
       }else{
        Ext.create('Ext.window.Window', {
            title: 'Historial',
            height: 300,
            width: 640,
            maximizable: true,
            autoScroll: true,
            bodyStyle: 'overflow:auto;background-color:#fff;',
            items: {
                loader: {
                    url: 'list_history',
                    contentType: 'html',
                    autoLoad: true,
                    params: {
                      id: selected_row
                    }
                }
            }
        }).show();
       }
    }//END: VerHistorial
    
        
    // load the data
    store.load();
    
});
</script>

<center>
<!-- SEARCH
<form method="post" action="<?=base_url()?>admin/buscar">
<input type="text" name="search" />
<input type="submit" value="¡Buscar!" />
</form>
 END SEARCH -->
<!-- table -->
<div id="table-alumnos"></div>
<!-- end table --> 
</center>
<? $this->load->view('admin/foot'); ?>
