<?php $this->load->view('header_view'); ?>

<?php 
if(isset($data)){
	$this->load->view($body_content, $data);	
}
else{
	$this->load->view($body_content);
}
 ?>

<?php $this->load->view('footer_view'); ?>
