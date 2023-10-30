<?php
    require_once('config1.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
    .button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration Form</title>
    <script src="validate.js"></script>
</head>
<body style="background-color:black;">

    <div>
        <?php
            if(isset($_POST['create'])){
                
                $department_name= $_POST['department_name'] ?? '';
                
                $relationship= $_POST['relationship'] ?? '';

                $result = NULL;
                
                if($department_name == 'Driver')
                    {$fk_em = $db->prepare("SELECT `s_no.` FROM Drivers WHERE (SELECT relationship FROM Emergency_Contact WHERE emergency_contact_ID =(SELECT emergency_contact_ID FROM Employee where employee_ID= Drivers.employee_ID)) = ? ORDER BY `s_no.`;");
                    $fk_em->execute([$relationship]);
                    $fk_em->setFetchMode(PDO::FETCH_ASSOC);
                    $driver_no = [];
                    $driver_name = [];
                    $manager_no = [];
                    while($row = $fk_em->fetch()){
                        $fk_em1 = $db->prepare("SELECT NIN_info.name FROM NIN_info WHERE NIN_info.NIN = (SELECT Employee.NIN FROM Employee WHERE employee_ID =(SELECT employee_ID FROM Drivers WHERE Drivers.`s_no.` = ?))");
                        $fk_em1->execute([$row['s_no.']]);
                        $l = $fk_em1->fetch();
                        array_push($driver_name, $l[0]);
                        array_push($driver_no, $row['s_no.']);
                    }
                    for($x =0; $x < sizeof($driver_no); $x++){
                    $fk_em = $db->prepare("SELECT manager_no FROM (Drivers INNER JOIN Manager ON Drivers.manager_no = Manager.`manager_no.`) WHERE (SELECT Emergency_Contact.relationship FROM Emergency_Contact WHERE Emergency_Contact.emergency_contact_ID =(SELECT emergency_contact_ID FROM Employee where Employee.employee_ID=Drivers.employee_ID)) = ? AND `s_no.` = ? ORDER BY RAND() LIMIT 1;");
                        $fk_em->execute([$relationship,$driver_no[$x]]);
                        $manager_no1 = $fk_em->fetch();
                        $fk_em = $db->prepare("SELECT NIN_info.name FROM NIN_info WHERE NIN_info.NIN = (SELECT Employee.NIN FROM Employee WHERE employee_ID =(SELECT employee_ID FROM Manager WHERE `manager_no.` = ?));");
                        $result=$fk_em->execute([$manager_no1[0]]);

                        $manager_no1 = $fk_em->fetch();
                        
                        array_push($manager_no, $manager_no1[0]);
                        
                    }
                    echo "<table>";
                    echo "<tr>";
                        echo "<th style='color:green;'>Driver Name</th>";
                        echo "<th style='color:green;'>Department</th>";
                        echo "<th style='color:green;'>Emergency Contact Relationship</th>";
                        echo "<th style='color:green;'>Dept_manager</th>";
                    echo "</tr>";
                    for ($x=0; $x < sizeof($driver_no); $x++) { 
                        echo ("<tr style='color:white;'><td>$driver_name[$x]</td><td>Driver</td><td>$relationship</td><td>$manager_no[$x]</td></tr>");
                    }
                }


                if($department_name == 'HR')
                    {$fk_em = $db->prepare("SELECT `s_no.` FROM HR WHERE (SELECT relationship FROM Emergency_Contact WHERE emergency_contact_ID =(SELECT emergency_contact_ID FROM Employee where employee_ID= HR.employee_ID)) = ? ORDER BY `s_no.`;");
                    $fk_em->execute([$relationship]);
                    $fk_em->setFetchMode(PDO::FETCH_ASSOC);
                    $driver_no = [];
                    $driver_name = [];
                    $manager_no = [];
                    while($row = $fk_em->fetch()){
                        $fk_em1 = $db->prepare("SELECT NIN_info.name FROM NIN_info WHERE NIN_info.NIN = (SELECT Employee.NIN FROM Employee WHERE employee_ID =(SELECT employee_ID FROM HR WHERE HR.`s_no.` = ?))");
                        $fk_em1->execute([$row['s_no.']]);
                        $l = $fk_em1->fetch();
                        array_push($driver_name, $l[0]);
                        array_push($driver_no, $row['s_no.']);
                    }
                    for($x =0; $x < sizeof($driver_no); $x++){
                    $fk_em = $db->prepare("SELECT manager_no FROM (HR INNER JOIN Manager ON HR.manager_no = Manager.`manager_no.`) WHERE (SELECT Emergency_Contact.relationship FROM Emergency_Contact WHERE Emergency_Contact.emergency_contact_ID =(SELECT emergency_contact_ID FROM Employee where Employee.employee_ID=HR.employee_ID)) = ? AND `s_no.` = ? ORDER BY RAND() LIMIT 1;");
                        $fk_em->execute([$relationship,$driver_no[$x]]);
                        $manager_no1 = $fk_em->fetch();
                        $fk_em = $db->prepare("SELECT NIN_info.name FROM NIN_info WHERE NIN_info.NIN = (SELECT Employee.NIN FROM Employee WHERE employee_ID =(SELECT employee_ID FROM Manager WHERE `manager_no.` = ?));");
                        $result=$fk_em->execute([$manager_no1[0]]);

                        $manager_no1 = $fk_em->fetch();
                        
                        array_push($manager_no, $manager_no1[0]);
                        
                    }
                    echo "<table>";
                    echo "<tr style='color:green;'>";
                        echo "<th>HR Name</th>";
                        echo "<th>Department</th>";
                        echo "<th>Emergency Contact Relationship</th>";
                        echo "<th>Dept_manager</th>";
                    echo "</tr>";
                    for ($x=0; $x < sizeof($driver_no); $x++) { 
                        echo ("<tr style='color:white;'><td>$driver_name[$x]</td><td>HR</td><td>$relationship</td><td>$manager_no[$x]</td></tr>");
                    }
                }
                if($department_name == 'Packager')
                    {$fk_em = $db->prepare("SELECT `s_no.` FROM Packagers WHERE (SELECT relationship FROM Emergency_Contact WHERE emergency_contact_ID =(SELECT emergency_contact_ID FROM Employee where employee_ID= Packagers.employee_ID)) = ? ORDER BY `s_no.`;");
                    $fk_em->execute([$relationship]);
                    $fk_em->setFetchMode(PDO::FETCH_ASSOC);
                    $driver_no = [];
                    $driver_name = [];
                    $manager_no = [];
                    while($row = $fk_em->fetch()){
                        $fk_em1 = $db->prepare("SELECT NIN_info.name FROM NIN_info WHERE NIN_info.NIN = (SELECT Employee.NIN FROM Employee WHERE employee_ID =(SELECT employee_ID FROM Packagers WHERE Packagers.`s_no.` = ?))");
                        $fk_em1->execute([$row['s_no.']]);
                        $l = $fk_em1->fetch();
                        array_push($driver_name, $l[0]);
                        array_push($driver_no, $row['s_no.']);
                    }
                    for($x =0; $x < sizeof($driver_no); $x++){
                    $fk_em = $db->prepare("SELECT manager_no FROM (Packagers INNER JOIN Manager ON Packagers.manager_no = Manager.`manager_no.`) WHERE (SELECT Emergency_Contact.relationship FROM Emergency_Contact WHERE Emergency_Contact.emergency_contact_ID =(SELECT emergency_contact_ID FROM Employee where Employee.employee_ID=Packagers.employee_ID)) = ? AND `s_no.` = ? ORDER BY RAND() LIMIT 1;");
                        $fk_em->execute([$relationship,$driver_no[$x]]);
                        $manager_no1 = $fk_em->fetch();
                        $fk_em = $db->prepare("SELECT NIN_info.name FROM NIN_info WHERE NIN_info.NIN = (SELECT Employee.NIN FROM Employee WHERE employee_ID =(SELECT employee_ID FROM Manager WHERE `manager_no.` = ?));");
                        $result=$fk_em->execute([$manager_no1[0]]);

                        $manager_no1 = $fk_em->fetch();
                        
                        array_push($manager_no, $manager_no1[0]);
                        
                    }
                    echo "<table>";
                    echo "<tr style='color:green;'>";
                        echo "<th>HR Name</th>";
                        echo "<th>Department</th>";
                        echo "<th>Emergency Contact Relationship</th>";
                        echo "<th>Dept_manager</th>";
                    echo "</tr>";
                    for ($x=0; $x < sizeof($driver_no); $x++) { 
                        echo ("<tr style='color:white;'><td>$driver_name[$x]</td><td>Packager</td><td>$relationship</td><td>$manager_no[$x]</td></tr>");
                    }
                }
                
                

                if($result){
                    echo "<p style='color:white;'>". "Displayed" . "</p>";
                }else{
                    echo "<p style='color:white;'>". "Not Displayed" . "</p>";
                }
            }
        ?>
    </div>
        <form action="task4.php" method="post">
            <div class="form-group">
                <center>
                <h1 style="color:green">Display Form </h1>
                </center>
                
                <div class="form-group">
                <label for="department_name" style="color:green"><b>Department:</b></label>
                <select name="department_name" class="form-control" id="department_name">
                    <option value="Driver">Driver</option>
                    <option value="HR">HR</option>
                    <option value="Packager">Packager</option>
                </select>
                </div>

                <div class="form-group">
                <label for="relationship" style="color:green"><b>Emergency Relationship</b></label>
                <input type="text" class="form-control" name="relationship" placeholder="Relation"required>
                </div>

                <center>
                <input type="submit" class="button" name="create" style="color:white" value="Submit">
                <a href="home.php" class="button"style="color:white">Home</a>
                </center>
            </div>
        </form>
    </div>
</body>
</html>