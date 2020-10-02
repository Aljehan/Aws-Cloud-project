 <!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
 <html>
   <head>
     <link rel="stylesheet" type="text/css" href="style.css">
     <title>Time Table</title>
     <meta charset=utf-8>
   </head>
   <body>
     <header>
       <h1>Time Table</h1>
       <nav>
     <div id ="menu"><h2>Enter Class Details</h2></div>
         <div id ="menu"><a href="http://ec2-34-230-23-9.compute-1.amazonaws.com"><h2>Class time</h2></a></div>
       </nav>
     </header>

<div id="main">
  <form action="index.php" method="post">
<fieldset>
  <legend>Enter Course time table:</legend>
  Course name:<br>
  <input type="text" name="code" ><br>
  Day:<br>
  <input type="text" name="day" ><br>
  Time:<br>
  <input type="text" name="time" ><br>
  <input type="submit" value="Submit" name="submit">
</fieldset>
  </form>
</div>

<?php
 
if(isset($_POST['submit'])){
    ini_set('display_errors', true);
    error_reporting(E_ALL);
    $RDS_host   = 'timetable.c7knw1zt4z9h.us-east-1.rds.amazonaws.com';
    $RDS_name   = 'timetable';
    $RDS_user   = 'vagrant';
    $RDS_passwd = '12345678';
    $pdo_dsn = "mysql:host=$RDS_host;dbname=$RDS_name";
    try{
        $pdo = new PDO($pdo_dsn, $RDS_user, $RDS_passwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sqlquery = "INSERT INTO timetable (code, day, time)
VALUES ('".$_POST["code"]."','".$_POST["day"]."','".$_POST["time"]."')";
        if ($pdo->query($sqlquery)) {
            echo 'Table updated!';
        }

        
        
    }
    catch(PDOException $error){
        echo "Connection error " . $error->getMessage();
        }
    }

?>
    
