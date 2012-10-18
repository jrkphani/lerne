<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Welcome to Lerne!</title>
  </head>
  <body>
    
    <?php echo validation_errors(); ?>
    <?php echo form_open('verifylogin'); ?>
      <input type="text" size="20" id="email" name="email" placeholder="Email"/>
      <br/>
      <input type="password" size="20" id="passowrd" name="password" placeholder="Password"/>
      <br/>
      <input type="submit" value="Login"/>
    </form>
  </body>
</html>
