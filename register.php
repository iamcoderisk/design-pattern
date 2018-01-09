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
          $validate = $validate->check($_POST, array(
            'username'=>array(
                'required'=>true,
                 'min'=>2,
                 'max'=>20,
                 'unique'=>'users'
            ),
            'password'=>array(
                'required'=>true,
                'min'=>6

            ),
            'confirm_password'=>array(
                'required'=>true,
                'matches'=>'password'
            ),
            'name'=>array(
              'required'=>true,
               'min'=>2,
               'max'=>50
            )
          ));
            if($validate->passed())
            {
            // Session::flash('success','you are registered successfully!');//remember to assign two parameter to this
            //   header("Location:index.php");
            //instantiate the user class
            $user = new User;
            //call the hash class and salt method
            $salt = Hash::salt(150);
              try{
                $user->create('users',array(
                    'username'=> Add::get('username'),
                    'password'=> Hash::make(Add::get('password'),$salt),
                    'salt'=>$salt,
                    'name'=>Add::get('name'),
                    'joined'=> Date::now(),
                    'group'=>1
                ));
              throw new RuntimeException();
              }catch(LogicException $e)
              {
                die($e->getMessage());
              }finally{
                Session::flash('home','registration successful!');
                Redirect::to('index');//don't pass the extension alongside with the page name
                // var_dump($user);

              }//no exception cought woooow!
                }else{
                  foreach($validate->errors() as $error)
                  {
                    echo $error.'<br />';
                  }

            }

        }

    }
     ?>
    <form method="post" action="">
      <div class="form-field">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo escape(Add::get('username')); ?>"placeholder="Username" autocomplete="off"/>
      </div>
      <div class="form-field">
        <label>Password</label>
        <input type="password" id="password"name="password" placeholder="******" autocomplete="off"/>
      </div>
      <div class="form-field strength">
            <div class="pass-info">
        <b id="strength">Strength:</b>
        <div class="figure" id="strength_human"></div>
        <div class="figure" id="strength_score"></div>
          </div>

      </div>
      <div class="form-field">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="******" autocomplete="off"/>
      </div>
      <div class="form-field">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo escape(Add::get('name')); ?>"placeholder="Name" autocomplete="off"/>
        </div>
        <div class="form-field">
          <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
          <button type="Submit" name="submit">Submit</button>
          </div>
    </form>
  </body>
</html>
