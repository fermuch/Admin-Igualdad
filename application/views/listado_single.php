<? $this->load->view('head',$title); ?>
  <?php
  
    foreach ($datos as $row){
      echo $row."<br />";
    }
  
  ?>
<? $this->load->view('foot'); ?>
