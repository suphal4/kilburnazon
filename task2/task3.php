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
h1{
    padding-top: 200px;
}
</style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Deletion Form</title>
</head>
<body style="background-color:black;">

    <div>
        <?php
            if(isset($_POST['create'])){
                $employee_ID = $_POST['employee_ID'] ?? '';
                $department_name = $_POST['department_name'] ?? '';
                $name = $_POST['name'] ?? '';
                $dob = $_POST['dob'] ?? '';
                $salary = $_POST['salary'] ?? '';
                $NIN = $_POST['NIN'] ?? '';
                $address = $_POST['address'] ?? '';
                $emergency_name = $_POST['emergency_name'] ?? '';
                $relationship = $_POST['relationship'] ?? '';
                $phone_number = $_POST['phone_number'] ?? '';
                $emp_incharge = $_POST['emp_incharge'] ?? '';

                $sql = "INSERT INTO Incharge(emp_incharge) VALUE(?)";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([$emp_incharge]);

                $s = $db->prepare("SELECT emergency_contact_ID FROM Employee WHERE employee_ID='$employee_ID'");
                $s->execute();
                $row_e=$s->fetch();
                
                
                $s = $db->prepare("SELECT NIN FROM Employee WHERE employee_ID='$employee_ID'");
                $s->execute();
                $row_n=$s->fetch();


                $sql = "DELETE FROM Manager WHERE employee_ID='$employee_ID'";
                $sdelete = $db->prepare($sql);
                $result=$sdelete->execute();

                $sql = "DELETE FROM HR WHERE employee_ID='$employee_ID'";
                $sdelete = $db->prepare($sql);
                $result=$sdelete->execute();

                $sql = "DELETE FROM Drivers WHERE employee_ID='$employee_ID'";
                $sdelete = $db->prepare($sql);
                $result=$sdelete->execute();

                $sql = "DELETE FROM Packagers WHERE employee_ID='$employee_ID'";
                $sdelete = $db->prepare($sql);
                $result=$sdelete->execute();

                $sql = "DELETE FROM Employee WHERE employee_ID='$employee_ID'";
                $sdelete = $db->prepare($sql);
                $result=$sdelete->execute();
                
                $sql = "DELETE FROM NIN_info WHERE NIN='$row_n[0]'";
                $sdelete = $db->prepare($sql);
                $result=$sdelete->execute();

                $sql = "DELETE FROM Emergency_Contact WHERE emergency_contact_ID='$row_e[0]'";
                $sdelete = $db->prepare($sql);
                $result=$sdelete->execute();

                



            }
        ?>
    </div>

    <div>
        <form action="task3.php" method="post">
        <div class="form-group">
                <center>
                <h1 style="color:green">Delete Details </h1>
                </center>
                <div class="form-group">
                <label for="employee_ID"   style="color:green"><b>Employee ID To Be Deleted</b></label>
                <input type="text" class="form-control"  name="employee_ID" id="employee_ID" placeholder="ID">
                </div>

                <div class="form-group">
                <label for="emp_incharge"   style="color:green"><b>Your Employee ID</b></label>
                <input type="text" class="form-control"  name="emp_incharge"  placeholder="ID">
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