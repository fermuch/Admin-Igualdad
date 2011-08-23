<?php
class Feedback extends Controller {

	function Feedback()
	{
		parent::Controller();
  }
  
  function add(){
    $title = $this->input->post('title');
    $body  = $this->input->post('body');
    $insert = array(
      'title'=>$title,
      'text'=>$body
    );
    $result = $this->db->insert('feedback',$insert);
    echo json_encode(array('success'=>$result));
  }
}
