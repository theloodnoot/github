<?php 
include("navbar.php");
//error messages//
$errorfname = $errorlname = $erroruname = $errordob = $errorpwd = $erroremail = $erroroc = "";
$allFields = "yes";

if (isset($_POST['submit'])){

    if ($_POST['movie']==""){
        $errorfname = "movie name is mandatory";
        $allFields = "no";
    }
    if ($_POST['genre']==null){
        $errorlname = "genre is mandatory";
        $allFields = "no";
    }
    if ($_POST['quality']==""){
        $erroruname = "qualitine is mandatory";
        $allFields = "no";
    }
    if ($_POST['price']==""){
        $errordob = "price is mandatory";
        $allFields = "no";
    }

    if($allFields == "yes")
    {
        $createUser = newmovie();
        header('Location: viewrequest.php?createUser='.$createUser);
    }
     if [$_POST==yes]
     {
     $movieid="movieid +1"
     }
}

function createnewMovie(){
    $id = $dateString = $movie = "";
    date_default_timezone_set('Europe/London');
    $date = date('d');

    $dateString = (string)$date;

    $Random = rand (100000,999999);

    $firstnamesub = substr($_POST['movie'], 0, 2);
    $lastnamesub = substr($_POST['gerner'], 0, 2);
    $postcodesub = substr($_POST['id'], -2);
    $id = $firstnamesub. $lastnamesub. $postcodesub. $dateString. $Random;
    $date = date('d-m-y');
    $uid = (String) $id;

    $created = false;
    $db = new SQLite3('C:\xampp\Data\prototype.db');
    $sql = 'INSERT INTO User(userID, username, applicationDate, firstName, lastName, dateOfBirth, password, email, occupation, status) VALUES (:uID, :userName, :AppDate, :fName, :lName, :DoB, :pswd, :mail, :Occ, "Active")';
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':movieID', $id, SQLITE3_TEXT);
    $stmt->bindParam(':movie', $_POST['movie'], SQLITE3_TEXT); 
    $stmt->bindParam(':AppDate', $date , SQLITE3_TEXT);
    $stmt->bindParam(':price', $_POST['price'], SQLITE3_TEXT);
    $stmt->bindParam(':moveid', $_POST['movieid'], SQLITE3_TEXT);
    $stmt->bindParam(':DoB', $_POST['dob'], SQLITE3_INTEGER);
    $stmt->bindParam(':qualitey', $_POST['qualitey'], SQLITE3_TEXT);
   

    $stmt->execute();

    if($stmt){
        $created = $uid;
    }

    return $created;
}
?>

<?php 
//form to enter
?>
<div class="container pb-5">
<main role="main" class="pb-3">
<div class="row">
                <div class="col-6">
                    <form method="post">

                        <div class="form-group col-md-6">
                            <label class="control-label labelFont">User Name</label>
                            <input class="form-control" type="text" name = "uname">
                            <span class="text-danger"><?php echo $erroruname; ?></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label labelFont">First Name</label>
                            <input class="form-control" type="text" name = "fname">
                            <span class="text-danger"><?php echo $errorfname; ?></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label labelFont">Last Name</label>
                            <input class="form-control" type="text" name = "lname">
                            <span class="text-danger"><?php echo $errorlname; ?></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label labelFont">Date of Birth</label>
                            <input class="form-control" type="text" name = "dob">
                            <span class="text-danger"><?php echo $errordob; ?></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label labelFont">Password</label>
                            <input class="form-control" type="password" name = "pwd">
                            <span class="text-danger"><?php echo $errorpwd; ?></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label labelFont">Email Address</label>
                            <input class="form-control" type="text" name = "mal">
                            <span class="text-danger"><?php echo $erroremail; ?></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label labelFont">Occupation</label>
                            <input class="form-control" type="text" name = "oc">
                            <span class="text-danger"><?php echo $erroroc; ?></span>
                        </div>

                        <div class="form-group col-md-4">
                            <input class="btn btn-primary" type="submit" value="Create User" name ="submit">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>