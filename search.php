<?php
    $host = "eu-cdbr-azure-west-b.cloudapp.net";
    $user = "b2d53b6618053e";
    $pwd = "6268b980";
    $db = "aazure1AL5sOMnZN";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title></title>
</head>
<body>
<form action="" method="post">
Search: <input type="text" name="term" /><br />
<input type="submit" value="Submit" />
</form>
<?php
    if (!empty($_REQUEST['term'])) {
        
        $term = $_REQUEST['term'];
        $term = addslashes($term);
        $sql_select = "SELECT * FROM registration_tbl WHERE email LIKE '%".$term."%' OR name LIKE '%".$term."%' OR CompanyName LIKE '%".$term."%'";
        $stmt = $conn->query($sql_select);
        $registrants = $stmt->fetchAll();
        if(count($registrants) > 0) {
            echo "<h2>People who are registered:</h2>";
            echo "<table>";
            echo "<tr><th>Name</th>";
            echo "<th>Email</th>";
            echo "<th>Company Name</th>";
            echo "<th>Date</th></tr>";
            foreach($registrants as $registrant) {
                echo "<tr><td>".$registrant['name']."</td>";
                echo "<td>".$registrant['email']."</td>";
                echo "<td>".$registrant['CompanyName']."</td>";
                echo "<td>".$registrant['date']."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<h3>No search results.</h3>";
        }

        
        
    }
    ?>
</body>
</html>