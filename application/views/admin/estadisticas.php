<? $this->load->view('admin/head',$title); ?>

<script type="text/javascript">
Ext.Loader.setConfig({
    enabled: true
});
Ext.Loader.setPath('Ext.ux', '<?=base_url();?>assets/js/ext-4.0.1/ux');

Ext.require([
  'Ext.data.*',
  'Ext.util.*',
  'Ext.state.*',
//'Ext.form.*',
  'Ext.chart.*',
  'Ext.layout.container.Fit',
//'Ext.tip.QuickTipManager',
//'Ext.layout.container.Border',
]);

Ext.onReady(function(){
  //Ext.QuickTips.init();
  
Ext.define('Chart', {
  extend: 'Ext.data.Model',
  fields: ['name', 'value']
});

var store = Ext.create('Ext.data.Store', {
  model: 'Chart',
  data: [
      { name: 'Ingresada',        value: <?=$data['ingresada']?> },
      { name: 'Revisión',         value: <?=$data['revision']?> },
      { name: 'Servicio Técnico', value: <?=$data['st']?> },
      { name: 'Lista',            value: <?=$data['lista']?> },
      { name: 'Retirada',         value: <?=$data['retirada']?> },
  ]
});
  
panel1 = Ext.create('widget.panel', {
      width: 800,
      height: 550,
      resizable: true,
      title: 'Estadísticas',
      renderTo: Ext.get('chart'),
      layout: 'fit',
      frame: true,
      tbar: [{
        xtype: 'label',
        text: 'Total de ingresos: <?=$data['total'];?>'
      },'->',{
        xtype: 'label',
        text: 'Exportar:'
      },{
        xtype: 'button',
        text: 'Ingresadas',
        id: 'expt_ingresadas'
      },{
        xtype: 'button',
        text: 'Revisión',
        id: 'expt_revision'
      },{
        xtype: 'button',
        text: 'Servicio Técnico',
        id: 'expt_st'
      },{
        xtype: 'button',
        text: 'Listas',
        id: 'expt_listas'
      },{
        xtype: 'button',
        text: 'Retiradas',
        id: 'expt_retiradas'
      }],
      items: {
          xtype: 'chart',
          id: 'chartCmp',
          animate: true,
          store: store,
          shadow: true,
          donut: false,
          legend: {
              position: 'right'
          },
          insetPadding: 60,
          theme: 'Base:gradients',
          series: [{
              type: 'pie',
              field: 'value',
              showInLegend: true,
              tips: {
                trackMouse: true,
                width: 190,
                height: 28,
                renderer: function(storeItem, item) {
                //porcentaje
                  var total = 0;
                  store.each(function(rec) {
                      total += rec.get('value');
                  });
                  this.setTitle(storeItem.get('name') + ': ' + Math.round(storeItem.get('value') / total * 100) + '%');
                }
              },
              highlight: {
                segment: {
                  margin: 20
                }
              },
              label: {
                  field: 'name',
                  display: 'rotate',
                  contrast: true,
                  font: '18px Arial'
              }
          }]
      }
  });
});
</script>

<center>
<div id="chart"></div>
</center>
<? $this->load->view('admin/foot'); ?>
