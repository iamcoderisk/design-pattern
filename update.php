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
          'name'=>array(
            'required'=>true,
            'min'=>2,
            'max'=>50
          )
      ));
        if($validation->passed())
        {


            try{

              $user->update('users',array(
                'name'=>Add::get('name')
              ));

            throw new RuntimeException();
            }catch(LogicException $e)
            {
              die($e->getMessage());
            }finally{
              Session::flash('home','update sucessful!');
              Redirect::to('index');//don't pass the extension alongside with the page name
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

  <label for="name">
    <input type="text" name="name" value="<?php echo$user->data()->name;?>">
  </label>

  <input type="submit" name="submit" />
  <input type="hidden" name="token" value="<?php echo Token::generate();?>">
</form>
