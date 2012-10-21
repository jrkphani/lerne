<h1>Home</h1>
<div id="lr_content" class="content">
        <form action="setup/complete" method="POST">
			<legend>We need some info</legend>
			<input type="text" id="lr_setup_firstname" name="lr_setup_firstname" placeholder="Firstname"/>
			<div></div>
			<input type="text" id="lr_setup_lastname" name="lr_setup_lastname" placeholder="Lastname"/>
			<div></div>
			<input type="text" id="lr_setup_adminusername" name="lr_setup_adminusername" placeholder="Username"/>
			<div></div>
			<input type="password" id="lr_setup_adminpassword" name="lr_setup_adminpassword" placeholder="Password"/>
			<div></div>
			<input type="text" id="lr_setup_domain" name="lr_setup_domain" placeholder="Domain"/>
			<div></div>
			<input type="submit" id="lr_setup_submit" value="Add Domain" class="btn" />
        </form>
</div>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
});
</script>
