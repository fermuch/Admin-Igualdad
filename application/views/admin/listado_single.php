<? $this->load->view('admin/head',$title); ?>
  <?php
  
    foreach ($datos as $row){
      echo $row."<br />";
    }
  
  ?>
<? $this->load->view('admin/foot'); ?>
