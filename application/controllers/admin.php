<?php

class Admin extends Controller {

        function Admin()
        {
                parent::Controller();
                $this->load->library('table');
                $this->load->helper('html');
                if (!$this->session->userdata('logged_in')):
                  redirect('/auth/');
                endif;
        }
        
        function index()
        {
          //TODO: poner algo en el índice.
          redirect('/admin/alumnos');
                /*$config['username'] = $this->session->userdata('username');
                $config['title'] = 'Panel de Administración';
                
                $this->load->view('admin/inicio',$config);*/
        }
        
        function alumnos(){
          $data = $this->general->list_estado_admin();
          $estados = $this->general->list_estados();
                
          $config = array(
            'title'=>'Listado',
            'data'=>$data
          );
          
          $this->load->view('admin/listado',$config);
        }
        
        function ajax_alumnos($operation, $id = null){
          switch($operation):
            case "list":
              $data = $this->general->list_estado_admin();
              $data = json_encode(array('alumnos'=>$data));
              echo $data;
            break;
            
            case "create":
              $httpContent = fopen('php://input', 'r');
              $raw  = '';
              while ($kb = fread($httpContent, 1024)) {
                  $raw .= $kb;
              }
              fclose($httpContent);
              $data = json_decode($raw);
              
              $return = $this->general->add_alumno($data);
              $data->id = $return[0];
              $data->estado = $return[1];
              $return = array('success'=>true,'alumnos'=>$data);
              echo json_encode($return);
        
            break;
            
            case "update":
            $httpContent = fopen('php://input', 'r');
              $raw  = '';
        while ($kb = fread($httpContent, 1024)) {
            $raw .= $kb;
        }
        fclose($httpContent);
        $data = json_decode($raw, true);
        
        if (!$id):
                $id = $data['id'];
              endif;
              
              $data1 = array(
                'nombre'=>$data['nombre'],
                'apellido'=>$data['apellido'],
                'cuil'=>$data['cuil'],
                'serie'=>$data['serie']
              );
              
              // modificaciones a usuario
              $this->db->where('id',$id)->update('usuario',$data1);
              
              // insertar en estado
              $sql = "SELECT id FROM estados WHERE nombre = ? LIMIT 1";
        $query = $this->db->query($sql, array($data['estado']));
        foreach($query->result() as $row){
          $data['estado'] = $row->id;
        }
              
              $data_insert = array(
                'alumno' => $id,
                'fecha' => time(),
                'nota' => $data['nota'],
                'motivo' => $data['motivo'],
                'estado' => $data['estado']
              );
              
              //TODO: Comprobar si es un error o no.
              /*if($data['estado']=="No hay información"){
                $data_insert['estado'] = 1;
              }else{
                $data_insert['estado'] = $data['estado'];
              }*/
              
              $this->db->insert('estado',$data_insert);
              
              
              // Obtener ese id desde la base de datos y mostrar los resultados
              
              
              //echo json_encode(array('success'=>true,'alumnos'=>$this->general->list_estado_admin()));
              $data = $this->general->list_estado_single($id);
              echo json_encode(array(
                      'alumnos'=>$this->general->list_estado_admin()
                )
              );
            break;
            
            case "destroy":
              $httpContent = fopen('php://input', 'r');
              $raw  = '';
        while ($kb = fread($httpContent, 1024)) {
            $raw .= $kb;
        }
        fclose($httpContent);
        $data = json_decode($raw);
        
        if (!$id):
                $id = $data['id'];
              endif;
        $this->db->where('id',$id)->delete('usuario',$data1);
        echo json_encode(array('success'=>true));
            break;
          endswitch;
        }
        
        //NOTE: necesario?
        /*function buscar(){
        
         
          $search = $this->input->post('search');
          //print $search;
          $data = $this->general->search_admin($search);
          
          $tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" id="table_listado"' );
    $this->table->set_template($tmpl);
                $this->table->set_heading('id','nombre','apellido','cuil','Nº de serie','fecha','motivo','nota','estado');
                $table = $this->table->generate($data);
                
                $config = array(
                  'title'=>'Buscar',
                  'table'=>$table
                );
                
                $this->load->view('admin/listado',$config);
        }*/
        
        //TODO: Función para administrar usuarios del sistema
        function usuarios(){
          redirect('/admin/');
        }
        
        
        /*
         TODO: crear un grid con ExtJS para mostrar los datos.
        */
        function list_history(){
          $id = $this->input->post('id');
          $return = $this->general->list_history($id);
          $print = array();
          $estados = $this->general->list_estados();
          foreach($return as $row):
            $row['fecha'] = date('d/m/Y', $row['fecha']);
            $row['estado'] = $estados[$row['estado']-1]['nombre'];
            if (!$row['motivo']){
              $row['motivo'] = "Nada insertado";
            }
            if (!$row['nota']){
              $row['nota'] = "Nada insertado";
            }
            
            $print[] = array(
              'fecha'=>$row['fecha'],
              'estado'=>$row['estado'],
              'motivo'=>$row['motivo'],
              'nota'=>$row['nota']
            );
          endforeach;
          
          $config = array('data'=>$print);
          $this->load->view('admin/grid_historial',$config);
        }
    
    function feedback(){
      $db = $this->db->query('SELECT * FROM `feedback` ORDER BY id DESC');
      $tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" id="table_listado">' );
      $this->table->set_template($tmpl);
      $this->table->set_heading('id','Nombre','Sugerencia');
      $table = $this->table->generate($db->result_array());

      $data = array(
        'title'=>'Feedback',
        'table'=>$table
      );
      $this->load->view('admin/feedback',$data);
    }
    
    function stats(){
       $stats['total']     = $this->general->stats();
       $stats['ingresada'] = $this->general->stats("ingresada");
       $stats['revision']  = $this->general->stats("revision");
       $stats['st']        = $this->general->stats("st");
       $stats['lista']     = $this->general->stats("lista");
       $stats['retirada']  = $this->general->stats("retirada");
       
       $data = array(
          'title'=>'Estadísticas',
          'data' =>$stats
        );
        $this->load->view('admin/estadisticas',$data);
      }
      
      function ajax_motivos($search = ""){
        //$this->output->enable_profiler(TRUE);
        
        // TODO: pasar SQL a General
        
        $start = $this->input->post('start');
        $limit = $this->input->post('limit');
        $query = $this->input->post('query');
        $query = str_replace(' ','%',$query);
        
        $db = $this->db->query("SELECT COUNT(motivo) FROM estado WHERE motivo LIKE '%".$query."%';");
        $result = $db->result_array();
        
        $total = $result[0]['COUNT(motivo)'];
        $db = null; $result = null;
        $motivos = array();
        $db = $this->db->query("SELECT motivo FROM estado WHERE motivo LIKE '%".$query."%' LIMIT ".$start.",".$limit.";");
        foreach($db->result_array() as $result):
          $motivos[]["text"] = $result["motivo"];
        endforeach;
        
        echo json_encode(
          array(
            "total"=>$total,
            "motivos"=>$motivos
          )
        );
      }
}
