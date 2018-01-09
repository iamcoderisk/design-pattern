<?php
/**
 *Author: Prince E. Darlington
 */
define('DS','/');
define('ROOT',dirname(__FILE__));
$url = isset($_SERVER['PATH_INFO']) ? explode('/',ltrim($_SERVER['PATH_INFO'],'/')): [];
require_once(ROOT.DS.'core'.DS.'boot.php');
  //using query in codefii
  // $users = DB::getInstance()->query("SELECT * FROM users");
  // foreach($users->results() as $user)
  //   {
  //     echo"<br  />";
  //     echo $user->username;
  //   }
//using get
// $users = DB::getInstance()->get('users',array('username','=','george'));
// if(!$users->count())
// {
//   echo"no user found";
// }
// else{
//     foreach($users->results() as $user)
//       {
//         echo $user->username;
//       }
// }
// $user = DB::getInstance()->update('users',2,array(
//   'username'=>'ukwe',
//   'password'=>'092020'
// ));
// $user = DB::getInstance()->insert('users',array(
//   'username'=>'george',
//   'password'=>'3958205205',
//   'salt'=>'salt',
//   'name'=>'otemure george',
//   'joined'=>'today',
//   'group'=>'Z'
// ));
// if(!$user->error()){
//   echo"added";
// }
// else{
//   echo"failed";
// }
// $user = new User;
//

// $user->create('users',array(
//     'username'=>'george',
//     'password'=>'3958205205',
//     'salt'=>'salt',
//     'name'=>'otemure george',
//     'joined'=>'today',
//     'group'=>'Z'
// ));
// if(Session::exists('home'))
// {
//   echo Greetings::welcome(Session::flash('home'));
// }
// echo Session::get(Config::get('session/session_name'));


// $user->data()->joined;//you can use this to get users information from the database
// echo $user->data()->joined;
$user = new User();
if($user->isLoggedIn())
{
?>
<p>
  Hello <a href="profile.php/user=<?php echo $user->data()->id;?>"><?php echo $user->data()->username; ?></a>!
</p>
<ul>

  <li>
    <a href="logout.php">Logout</a>
  </li>
  <li>    <a href="update.php">update info</a></li>

    <li><a href="updatepassword.php">Change Password</a></li>
</ul>
<?php
}else{
  echo'you need to <a href="login.php">login</a> or <a href="register.php">Register</a>';
}
