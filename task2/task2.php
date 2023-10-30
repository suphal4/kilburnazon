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
</head>
<body style="background-color:black;">

    <div>
        <?php
            if(isset($_POST['create'])){
                (string)$employee_ID = $_POST['employee_ID'] ?? '';
                $department_name = $_POST['department_name'] ?? '';
                $name = $_POST['name'] ?? '';
                $dob = $_POST['dob'] ?? '';
                $salary = $_POST['salary'] ?? '';
                $NIN = $_POST['NIN'] ?? '';
                $address = $_POST['address'] ?? '';
                $emergency_name = $_POST['emergency_name'] ?? '';
                $relationship = $_POST['relationship'] ?? '';
                $phone_number = $_POST['phone_number'] ?? '';


                if (!empty($employee_ID)){
                    if (!empty($department_name)){
                        $sql = "UPDATE Employee SET department_name=? WHERE employee_ID='$employee_ID'";
                        $supdate = $db->prepare($sql);
                        $result = $supdate->execute([$department_name]);
                    }

                    
                    if (!empty($salary)){
                        echo $salary;
                        $sql = "UPDATE Employee SET salary=? WHERE employee_ID='$employee_ID'";
                        $supdate = $db->prepare($sql);
                        $result = $supdate->execute([$salary]);
                    }
                    if (!empty($name)){
                        $s = $db->prepare("SELECT NIN FROM Employee WHERE employee_ID='$employee_ID'");
                        $s->execute();
                        $row=$s->fetch();
                        $sql = "UPDATE NIN_info SET name=? WHERE NIN='$row[0]'";
                        $supdate = $db->prepare($sql);
                        $result = $supdate->execute([$name]);
                    }
                    if (!empty($address)){
                        $s = $db->prepare("SELECT NIN FROM Employee WHERE employee_ID='$employee_ID'");
                        $s->execute();
                        $row=$s->fetch();
                        $sql = "UPDATE NIN_info SET address=? WHERE NIN='$row[0]'";
                        $supdate = $db->prepare($sql);
                        $result = $supdate->execute([$address]);
                    }
                    if (!empty($emergency_name)){
                        $s = $db->prepare("SELECT emergency_contact_ID FROM Employee WHERE employee_ID='$employee_ID'");
                        $s->execute();
                        $row=$s->fetch();
                        $sql = "UPDATE Emergency_Contact SET emergency_name=? WHERE emergency_contact_ID='$row[0]'";
                        $supdate = $db->prepare($sql);
                        $result = $supdate->execute([$emergency_name]);
                    }
                    if (!empty($relationship)){
                        $s = $db->prepare("SELECT emergency_contact_ID FROM Employee WHERE employee_ID='$employee_ID'");
                        $s->execute();
                        $row=$s->fetch();
                        $sql = "UPDATE Emergency_Contact SET relationship=? WHERE emergency_contact_ID='$row[0]'";
                        $supdate = $db->prepare($sql);
                        $result = $supdate->execute([$relationship]);
                    }
                    if (!empty($phone_number)){
                        $s = $db->prepare("SELECT emergency_contact_ID FROM Employee WHERE employee_ID='$employee_ID'");
                        $s->execute();
                        $row=$s->fetch();
                        $sql = "UPDATE Emergency_Contact SET phone_number=? WHERE emergency_contact_ID='$row[0]'";
                        $supdate = $db->prepare($sql);
                        $result = $supdate->execute([$phone_number]);
                    }
                }

               
            }
        ?>
    </div>

    <div>
        <form action="task2.php" method="post">
        <div class="form-group">
                <center>
                <h1 style="color:green">Update Details </h1>
                </center>
                <div class="form-group">
                <label for="employee_ID"   style="color:green"><b>Employee ID</b></label>
                <input type="text" class="form-control"  name="employee_ID" id="employee_ID" placeholder="ID"required>
                </div>

                <div class="form-group">
                <label for="name" style="color:green"><b>Name</b></label>
                <input type="text" class="form-control" name="name" placeholder="Name">
                </div>

                <div class="form-group">
                <label for="address" style="color:green"><b>Address</b></label>
                <input type="text" class="form-control" name="address" placeholder="Address">
                </div>

                <div class="form-group">
                <label for="salary" style="color:green"><b>Salary</b></label>
                <input type="text" class="form-control" name="salary" placeholder="Salary">
                </div>

                

                


                <div class="form-group">
                <label for="department_name" style="color:green"><b>Department:</b></label>
                <input type="text" class="form-control" name="department_name" placeholder="Department">
                </div>

                <div class="form-group">
                <label for="emergency_name" style="color:green"><b>Emergency Name</b></label>
                <input type="text" class="form-control" name="emergency_name" placeholder="Emergency Contact Name">
                </div>

                <div class="form-group">
                <label for="relationship" style="color:green"><b>Emergency Relationship</b></label>
                <input type="text" class="form-control" name="relationship" placeholder="Relation">
                </div>

                <div class="form-group">
                <label for="phone_number" style="color:green"><b>Emergency Phone</b></label>
                <input type="text" class="form-control" name="phone_number" placeholder="Phone number" >
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