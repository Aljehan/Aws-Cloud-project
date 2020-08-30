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
    <div id ="menu"><a href="http://192.168.34.11"><h2>Enter Details</h2></a></div>
    <div id ="menu"><h2>Time table</h2></div>
      </nav>
    </header>

    <div id="main">
      <table id="time">
        <tr><th> Paper Code </th><th> Day </th><th> Time </th></tr>

        <?php
          
          $db_host   = '192.168.34.13';
          $db_name   = 'timetabledb';
          $db_user   = 'dbuser';
          $db_passwd = 'mypassword';

          $pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

          $pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

          $q = $pdo->query("SELECT * FROM timetable");

        while($row = $q->fetch()){
        echo "<tr><td>".$row["code"]."</td><td>".$row["day"]."</td><td>".$row[time]."</td></tr>\n";
        }

        ?>
      </table>
    </div>



  </body>
</html>
