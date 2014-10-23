<html>
<head>
<Title>Search</Title>
<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>
</head>
<body>
<h1>Register here!</h1>
<p>Type the name or email or company name then click <strong>Search</strong> to search.</p>
<form method="get" action="search.php" enctype="multipart/form-data" >
      
      search by name :<input type="text" name="name" id="searchname"/></br>
      search by email :<input type="text" name="email" id="searchemail"/></br>
      search by company :<input type="text" name="company" id="searchcompany"/></br>
      <input type="submit" name="search" value="Search Database" />
</form>
<?php
   
    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    //using the values you retrieved earlier from the portal.
    $host = "eu-cdbr-azure-north-b.cloudapp.net";
    $user = "b089d5af601690";
    $pwd = "b9b1d523";
    $db = "randomrApgTD6hW1";
    $found = False;
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    // Insert registration info
    if(!empty($_GET)) {
    try {
        $name = $_GET['name'];
        $email = $_GET['email'];
        $company = $_GET['company'];
        $found = true; 
        
    }
    catch(Exception $e) {
        die(var_dump($e));
    }
    echo "<h3>Thank You for searching</h3>";
    }
    // Retrieve data
    if ($found == true){
    $sql_select = "SELECT * FROM registration_tbl Where 
    name like '%$name%' AND 
    email like '%$email%' AND
    company like '%$company%' ";
    $stmt = $conn->query($sql_select);
    $registrants = $stmt->fetchAll(); 
    if(count($registrants) > 0) {
        echo "<h2>People You searched For : </h2>";
        echo "<table>";
        echo "<tr><th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Date</th>";
        echo "<th>Company</th></tr>";
        foreach($registrants as $registrant) {
            echo "<tr><td>".$registrant['name']."</td>";
            echo "<td>".$registrant['email']."</td>";
            echo "<td>".$registrant['date']."</td>";
            echo "<td>".$registrant['Company']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>Not Found !!!</h3>";
    }
}
else {
    echo "Waiting..." ; 
}
?>

</body>
</html>