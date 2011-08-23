<?php

class Listado extends Controller {

        function Listado()
        {
                parent::Controller();
                $this->load->library('table');
                $this->load->helper('html');
        }
        
        function index()
        {
                /*
                * Página para buscar en el listado
                */
                $config = array(
                  'title'=>'Inicio'
                );
                $config['ultima_net'] = $this->general->ultima_net();
                $this->load->view('inicio',$config);
        }
        
        function id($id){
          $data = $this->general->list_estado_single($id);
          
          $config = array(
            'title'=>'Información',
            'datos'=>$data
          );
          
          $this->load->view('listado_single',$config);
        }
        
        function buscar(){
          $search = $this->input->post('search');
          //print $search;
          $data = $this->general->search_alumno($search);
          
          if($data):
            $tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" id="table_listado">' );
            $this->table->set_template($tmpl);
            $this->table->set_heading('id','Nombre','Apellido','CUIL','Nº de serie','Estado');
            $table = $this->table->generate($data);
          
            $config = array(
              'title'=>'Buscar',
              'table'=>$table,
              'search'=>$search
            );
          else:
            $config = array(
              'title'=>'Buscar',
              'table'=>'<h2>No se encontraron resultados</h2>',
              'search'=>$search
            );
          endif;
          
          $config['ultima_net'] = $this->general->ultima_net();
          $this->load->view('listado',$config);
        }
}
