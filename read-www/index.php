<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN"><!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Time Table </title>
    <meta charset=utf-8>
  </head>
  <body>
    <header>
      <h1>Time Table</h1>
      <nav>
    <div id ="menu"><a href="http://ec2-35-153-70-117.compute-1.amazonaws.com"><h2>Enter Details</h2></a></div>
    <div id ="menu"><h2>Time table</h2></div>
      </nav>
    </header>

    <div id="main">
      <table id="time">
        <tr><th> Paper Code </th><th> Day </th><th> Time </th></tr>

        <?php
          
          $RDS_host   = 'timetable.c7knw1zt4z9h.us-east-1.rds.amazonaws.com';
          $RDS_name   = 'timetable';
          $RDS_user   = 'vagrant';
          $RDS_passwd = '12345678';

          $pdo_dsn = "mysql:host=$RDS_host;dbname=$RDS_name";

          $pdo = new PDO($pdo_dsn, $RDS_user, $RDS_passwd);

          $q = $pdo->query("SELECT * FROM timetable");

        while($row = $q->fetch()){
        echo "<tr><td>".$row["code"]."</td><td>".$row["day"]."</td><td>".$row[time]."</td></tr>\n";
        }

        ?>
      </table>
    </div>



  </body>
</html>
