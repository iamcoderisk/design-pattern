<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Update Password</title>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/passwordStrength.js"></script>
    <link rel="stylesheet" href="public/app.css"/>
  </head>
  <body>
    <?php

        require_once 'core/boot.php';
        $user = new User();
        if(!$user->isLoggedIn())
        {
          Redirect::to('index');
        }
        if(Add::exists())
        {
          if(Token::check(Add::get('token')))
          {

            $validate = new Validate();
            $validation = $validate->check($_POST,array(
              'current_password'=>array(
                'required'=>true,
                'min'=>6
              ),
              'new_password'=>array(
                'required'=>true,
                'min'=>6
              ),
              'new_password_again'=>array(
                'required'=>true,
                'min'=>6,
                'matches'=>'new_password'
              )

            ));
            if($validation->passed())
            {
                  if(Hash::make(Add::get('current_password'),$user->data()->salt) !==$user->data()->password)
                  {
                    echo'your current password is wrong';
                  }
                  else{

                    try{
                      $salt = Hash::salt(32);
                      $user->update('users',array(
                        'password'=>Hash::make(Add::get('new_password'),$salt),
                        'salt'=>$salt

                      ));
                    throw new RuntimeException();
                    }catch(LogicException $e)
                    {
                      die($e->getMessage());
                    }finally{
                      Session::flash('home','your password has been changed');
                      Redirect::to('index');
                    }


                  }


            }else {
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
         <label for="current_password">Current Password</label>
         <input type="password" name="current_password" id="current_password" />
       </div>

       <div class="form-field">
         <label for="new_password">New Password</label>
         <input type="password"  name="new_password" id="new_password" />
       </div>

       <div class="form-field">
         <label for="new_password_again">Confirm New Password</label>
         <input type="password"  name="new_password_again" id="new_password_again" />
       </div>
       <div class="form-field">
         <button type="submit" name="change">Change</button>
         <input type="hidden" name="token" value="<?php echo Token::generate();?>">
       </div>
     </form>
  </body>
</html>
