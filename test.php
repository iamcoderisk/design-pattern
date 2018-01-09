<?php
/**
 *Author: Prince E. Darlington
 */
define('DS','/');
define('ROOT',dirname(__FILE__));
$url = isset($_SERVER['PATH_INFO']) ? explode('/',ltrim($_SERVER['PATH_INFO'],'/')): [];
require_once(ROOT.DS.'core'.DS.'boot.php');
  //using query in codefii

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

$users = DB::getInstance()->query("SELECT * FROM users");
?>


<?php

foreach($users->results() as $user)
  {
    echo"<br />";
?>

  <a href="view?user=<?php echo $user->id; ?>"><?php
    echo $user->username;?>  </a>
<?php

  }

?>
