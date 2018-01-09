<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Codefi || Register</title>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/passwordStrength.js"></script>
    <link rel="stylesheet" href="public/app.css"/>
  </head>

  <body>
    <?php
    require_once 'core/boot.php';
    if(Add::exists())//don't modify this
    {
        if(Token::check(Add::get('token')))//don't modify this
        {
          $validate  = new Validate();
          $validation = $validate->check($_POST, array(
            'username'=>array('required'=>true),
            'password'=>array('required'=>true)
          ));
            if($validation->passed())
            {
              $user = new User();
              //create a variable for remember
              $remember = (Add::get('remember') =='on') ? true : false;
              $login = $user->login(Add::get('username'),Add::get('password'), $remember);

              if($login)
              {
                Redirect::to('index');
                echo $hash;
              }else{
                echo"<p>
                  login failed
                </p>";
              }

            }else{


              foreach($validation->errors() as $error)
              {
                echo $error,'<br />';
              }

            }

        }

    }

     ?>
    <form method="post" action="">
      <div class="form-field">
        <label>Username</label>
        <input type="text" name="username" value=""placeholder="Username" autocomplete="off"/>
      </div>
      <div class="form-field">
        <label>Password</label>
        <input type="password" id="password"name="password" placeholder="******" autocomplete="off"/>
      </div>
        <div class="form-field">
          <label for="remember">
            <input type="checkbox" name="remember" id="remember" />Remember me
          </label>
        </div>

        <div class="form-field">
          <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
          <button type="Submit" name="submit">Submit</button>
          <p>
            Could not login?
            <a href="resetpassword.php">Reset password</a>
          </p>


          </div>
    </form>
  </body>
</html>
