<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>Register for Lerne!</title>
  </head>
  <body>
    <script type="text/javascript" src="<?php echo asset_url(); ?>js/pwdwidget.js"></script>
    <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
    <?php echo validation_errors(); ?>
    <?php echo form_open('verifyregister'); ?>
      <input type="text" size="20" id="firstname" name="firstname" value = "<?php echo set_value('firstname'); ?>" placeholder="First Name"/>
      <br/>
      <input type="text" size="20" id="lastname" name="lastname" value = "<?php echo set_value('lastname'); ?>" placeholder="Last Name"/>
      <br/>
      <input type="text" size="20" id="email" name="email" value = "<?php echo set_value('email'); ?>" placeholder="Email"/>
      <br/>
      <input type="password" size="20" id="password" name="password" placeholder="Password"/>
      <br/>
      <input type="password" size="20" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password"/>
      <br/>
      <input type="submit" value="Register"/>
    <?php echo form_close(); ?>
  </body>
</html>

<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('thepwddiv','password');
    pwdwidget.MakePWDWidget();
    
    var frmvalidator  = new Validator("register");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("firstname","req","Please provide your first name");

    frmvalidator.addValidation("lastname","req","Please provide your last name");

    frmvalidator.addValidation("email","req","Please provide your email address");

    frmvalidator.addValidation("email","email","Please provide a valid email address");
    
    frmvalidator.addValidation("password","req","Please provide a password");

// ]]>
</script>
