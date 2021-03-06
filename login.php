<?php
include("banner.php");
 function verifyUsers () {

    $db = new SQLite3('C:\xampp\Data\prototype.db');
    $stmt = $db->prepare('SELECT username, password FROM User WHERE username=:username AND password=:password');
    $stmt->bindParam(':username', $_POST['username'], SQLITE3_TEXT);
    $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);

    $result = $stmt->execute();

    $rows_array = [];
    while ($row=$result->fetchArray())
    {
        $rows_array[]=$row;
    }
    return $rows_array;
  }
  function verifyAdmin () {

    $db = new SQLite3('C:\xampp\Data\prototype.db');
    $stmt = $db->prepare('SELECT username, password FROM Administrative_Approver WHERE username=:username AND password=:password');
    $stmt->bindParam(':username', $_POST['username'], SQLITE3_TEXT);
    $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);

    $result = $stmt->execute();

    $rows_array = [];
    while ($row=$result->fetchArray())
    {
        $rows_array[]=$row;
    }
    return $rows_array;

}

function verifySysAdmin () {

  $db = new SQLite3('C:\xampp\Data\prototype.db');
  $stmt = $db->prepare('SELECT username, password FROM Admin WHERE username=:username AND password=:password');
  $stmt->bindParam(':username', $_POST['username'], SQLITE3_TEXT);
  $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);

  $result = $stmt->execute();

  $rows_array = [];
  while ($row=$result->fetchArray())
  {
      $rows_array[]=$row;
  }
  return $rows_array;

}



//following code is for error messages, if input is incorrect/null
$nameErr = $pwderr = $invalidMesg = "";

if (isset($_POST['submit'])) {

    if ($_POST['username']=="") {
        $nameErr = "Username is required";
      } 
      
      if ($_POST['password']==null) {
        $pwderr = "password is required";
      }

    if($_POST['username'] != null && $_POST['password'] !=null)
    {
        $array_user = verifyUsers(); 
        $array_admin = verifyAdmin();
        $array_sysadmin= verifySysAdmin();
        
        if ($array_user != null) {

      
            if (null !==($array_user))
            {

                session_start();
                //starts sessions/

                header("Location: dashboard.php");
                exit();
            } 
        }
        elseif($array_admin != null){
          if (null !==($array_user))
            {
                session_start();
                //starts sessions

                header("Location: pendingrequest.php");
                exit();
            }
        }
        elseif($array_sysadmin != null){
          if (null !==($array_user))
            {
                session_start();
                //starts sessions

                header("Location: viewrequest.php");
                exit();
            }
        }
        if ($array_user != $_POST['username'] or $_POST['password'] || $array_admin != $_POST['username'] or $_POST['password'])
        {
          $nameErr = "Invalid username or password";
          $pwderr = "Invalid username or password";
        }
        else{
            $invalidMesg = "Invalid username and password!";
        }
    }
}

?>
<!DOCTYPE html>
<html>
  <link rel="stylesheet" href="style.css">
<?php 
//this is the input boxes for the login
?>
        <form method="post">
                   <div class="tester">
                        <label class="control-label labelFont">Username</label>
                        <input class="form-control" type="text" name = "username">
                        <span style="color: red"><?php echo $nameErr; ?></span>
                   </div>

                   <div class="tester2">
                        <label class="control-label labelFont">Password</label>
                        <input class="form-control" type="password" name = "password">
                        <span style="color: red"><?php echo $pwderr; ?></span>
                   </div>
                   <div class="tester3">
                        <input class="btn btn-primary" type="submit" value="submit" name ="submit">
                   </div>
                </form>
  </body>
</html>