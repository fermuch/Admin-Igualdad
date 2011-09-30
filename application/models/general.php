<?php
class General extends Model{
  /* constructor */
        function General(){
                parent::Model();
        }
        
        function list_usuario($limit = null, $index = null){
          $return = null;
          $query = $this->db->get('usuario',$index, $limit);
          foreach($query->result() as $row){
            $return[] = $row;
          }
          return $return;
        }
        
        function ultima_net($limit = null, $index = null){
          $return = null;
          // estado 4 = Lista
          $query = $this->db->query('SELECT alumno FROM estado WHERE estado = 4 ORDER BY id DESC LIMIT 1;');
          foreach($query->result() as $row){
            $alumno = $row->alumno;
          }
          $query = null; $row = null;
          $query = $this->db->query('SELECT nombre,apellido FROM usuario WHERE id = ?;',$alumno);
          foreach($query->result() as $row){
            $return = $row->nombre.' '.$row->apellido;
          }
          return $return;
        }
        
        function list_estado($limit = 30, $index = null, $date_format = 'd/m/Y'){
          $return = null;
          $query = $this->db->query('SELECT * FROM estado ORDER BY fecha ASC');
          foreach($query->result_array() as $row){
          
              /* obtener nombre entero del alumno */
              $alumno_id = $row['alumno'];
              $query2 = $this->db->query('SELECT nombre,apellido FROM usuario WHERE id='.$alumno_id);
              $row['alumno'] = null;
              foreach($query2->result_array() as $row2){
                $row['alumno'] = $row2['nombre'].' '.$row2['apellido'];
              }
              
              /* obtener fecha */
              $row['fecha'] = date($date_format ,$row['fecha']);
              
              /* obtener estado */
              $estado_id = $row['estado'];
              $query3 = $this->db->query('SELECT nombre FROM estados WHERE id='.$estado_id);
              $row['estado'] = null;
              foreach($query3->result_array() as $row3){
                $row['estado'] = $row3['nombre'];
              }
              
              $row['id'] = '<a href="'.base_url().'listado/id/'.$row['id'].'">'.$row['id'].'</a>';
              
              $return[] = $row;
          }
          return $return;
        }
        
        /*
        * Función reconstruida
        * TODO: buscar todos los usuarios 
        */
        function list_estado_admin($limit = null, $index = null, $date_format = 'd/m/Y'){
          $return = null;
          $query = $this->db->query('SELECT * FROM usuario ORDER BY id');
          $i = 0;
          # ENCONTRAR ESTADO
          foreach($query->result_array() as $row){
            $return[] = $row;
            $estado = $this->db->query('SELECT * FROM estado WHERE alumno = \''.$row['id'].'\' ORDER BY fecha DESC LIMIT 1');
            foreach($estado->result_array() as $key){
              if($key['id']):
                $estados = $this->db->query('SELECT nombre FROM estados WHERE id = \''.$key['estado'].'\' LIMIT 1');
                foreach($estados->result_array() as $estadito){
                  $return[$i]['estado'] = $estadito['nombre'];
                }
              endif;
              
              if($key['motivo']):
              $return[$i]['motivo'] = $key['motivo'];
            else:
              $return[$i]['motivo'] = "";
              endif;
              
        if($key['nota']):
              $return[$i]['nota'] = $key['nota'];
            else:
              $return[$i]['nota'] = "";
              endif;
            }
          $i++;
          } # END ENCONTRAR ESTADO
          
          
          # FIX TEMPORAL
          $i = 0;
          foreach($return as $no_encontrado){
            if(!isset($no_encontrado['estado'])):
              $return[$i]['estado'] = 'No hay información';
            endif;
            $i++;
          }
          return $return;
        }
        
        function list_estado_single($id, $date_format = 'd/m/Y'){
          $return = null;
          $query = $this->db->get_where('estado', array('alumno' => (int)$id));
          foreach($query->result_array() as $row){
          
              /* obtener nombre entero del alumno */
              $alumno_id = $id;
              $query2 = $this->db->query('SELECT * FROM usuario WHERE id='.$alumno_id);
              foreach($query2->result_array() as $row2){
                //$row['alumno'] = $row2['nombre'].' '.$row2['apellido'];
                $row['nombre'] = $row2['nombre'];
                $row['apellido'] = $row2['apellido'];
                $row['cuil'] = $row2['cuil'];
                $row['serie'] = $row2['serie'];
                
              }
              
              /* obtener fecha */
              $row['fecha'] = date($date_format ,$row['fecha']);
              unset($row['fecha']);
              unset($row['alumno']);
              $row['id'] = $id;
              
              /* obtener estado */
              $estado_id = $row['estado'];
              $query3 = $this->db->query('SELECT nombre FROM estados WHERE id='.$estado_id);
              $row['estado'] = null;
              foreach($query3->result_array() as $row3){
                $row['estado'] = $row3['nombre'];
              }
              
              $return = $row;
          }
          return $return;
        }
        
        function list_estados($limit = null, $index = null){
          $return = null;
          $query = $this->db->get('estados',$index, $limit);
          foreach($query->result_array() as $row){
            $return[] = $row;
          }
          return $return;
        }
        
        function list_history($id){
          $return = null;
          $query = $this->db->where('alumno',$id)
                            ->get('estado');
          foreach($query->result_array() as $row){
            $return[] = $row;
          }
          return $return;
        }
        
        function search_alumno($query){
          $return = null;
          $query = str_replace(' ','%',$query);
          #FIX by Turl
          $query = $this->db->query('SELECT * FROM usuario WHERE (nombre || " " || apellido) LIKE \'%'.$query.'%\' OR serie LIKE \'%'.$query.'%\' OR cuil LIKE \'%'.$query.'%\'');
          foreach($query->result_array() as $row){
            //TODO: Si no se encuentra a nadie, no se debe continuar.
            $return[] = $row;
          }
          $query = null;
          $row = null;
          $i = 0;
          
          if($return):
          
          # OBTENER ESTADO
          foreach($return as $id){
            $estado[$i] = null;
            $fecha[$i]  = null;
            $query = $this->db->query('SELECT estado,fecha FROM estado WHERE alumno = '.$id['id'].' ORDER BY fecha DESC LIMIT 1');
            foreach($query->result_array() as $row){
                $estado[$i] = $row['estado'];
                $return[$i]['fecha'] = date('d/m/Y', $row['fecha']);
            }

            $query = null;
            $row = null;
            if($estado[$i] !== null):
              $query = $this->db->query('SELECT nombre FROM estados WHERE id = '.$estado[$i]);
              foreach($query->result_array() as $row){
                $return[$i]['estado'] = $row['nombre'];
              }
            else:
              $return[$i]['estado'] = 'No hay información';#TODO: que el texto no esté hardcodeado
            endif;
            $i++;
          }# END OBTENER ESTADO
          
          endif;
      
          return $return;
        }
        
        #DEPRECATED
        function search_admin($query){
          $return = null;
          $query = $this->db->query('SELECT * FROM usuario WHERE apellido LIKE \'%'.$query.'%\' OR nombre LIKE \'%'.$query.'%\' OR serie LIKE \'%'.$query.'%\'');
          foreach($query->result_array() as $row){
            $return[] = $row;
          }
          $query = null;
          $row = null;
          $i = 0;
          
          
          # OBTENER ESTADO
          foreach($return as $id){
            $estado[$i] = null;
            $query = $this->db->query('SELECT * FROM estado WHERE alumno = '.$id['id'].' ORDER BY fecha DESC LIMIT 1');
            foreach($query->result_array() as $row){
                $estado[$i] = $row['estado'];
                #print_r($row);
                $return[$i]['fecha'] = date('d/m/Y', $row['fecha']);
                $return[$i]['motivo'] = $row['motivo'];
                $return[$i]['nota'] = $row['nota'];
            }

            $query = null;
            $row = null;
      if($estado[$i] !== null):
              $query = $this->db->query('SELECT nombre FROM estados WHERE id = '.$estado[$i]);
              foreach($query->result_array() as $row){
                $return[$i]['estado'] = $row['nombre'];
              }
            else:
              $return[$i]['estado'] = 'No hay información';#TODO: que el texto no esté hardcodeado
            endif;
            $i++;
    }# END OBTENER ESTADO

          return $return;
        }
        
        /* BEGIN CRUD */
        function add_alumno($data){
          $estado_original = $data->estado;
          $sql = "SELECT id FROM estados WHERE nombre = ? LIMIT 1";
          $query = $this->db->query($sql, array($data->estado));
          foreach($query->result() as $row){
            $data->estado = $row->id;
          }
          
          $data2 = array(
            "nombre" => $data->nombre,
            "apellido"=>$data->apellido,
            "cuil"=>(string)$data->cuil,
            "serie"=>(string)$data->serie
          );
          
          // insertar el usuario en la base de datos
          $this->db->insert('usuario',$data2);
          
          // recuperar el id del usuario
          $sql = "SELECT id FROM usuario WHERE nombre = ? AND apellido = ? AND cuil = ? AND serie = ?";
          $query = $this->db->get_where('usuario',$data2);
          foreach($query->result() as $row){
            $id = $row->id;
          }
          
          // insertar el estado en la base de datos
          $data_insert = array(
            'alumno' => $id,
            'fecha' => time(),
            'motivo' => $data->motivo,
            'nota' => $data->nota,
            'estado' => $data->estado
          );
          //echo $id."\n".$data_insert['estado'];
          $this->db->insert('estado',$data_insert);
          
          return (array($id,$estado_original));
        }
        
        /* END CRUD */
        
        function stats($what = null){
        /*
        * TODO:
        *  por ahora, busca *todos* los estados. Se tienen que listar sólo
        *  los estados que están en vigencia.
        */
          switch($what){
            case "ingresada":
              $sql = "SELECT COUNT(*) FROM estado WHERE estado = 1;";
            break;
            case "revision":
              $sql = "SELECT COUNT(*) FROM estado WHERE estado = 2;";
            break;
            case "st":
              $sql = "SELECT COUNT(*) FROM estado WHERE estado = 3;";
            break;
            case "lista":
              $sql = "SELECT COUNT(*) FROM estado WHERE estado = 4;";
            break;
            case "retirada":
              $sql = "SELECT COUNT(*) FROM estado WHERE estado = 5;";
            break;
            default:
              $sql = "SELECT COUNT(*) FROM estado;";
            break;
        }
        $query = $this->db->query($sql);
        return($query->data[0]["COUNT(*)"]);
      }
}
