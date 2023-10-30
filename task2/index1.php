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

                
                $sql = "INSERT INTO NIN_info(NIN,name,dob,address) VALUES(?,?,?,?)";
                $sinsert = $db->prepare($sql);
                $result = $sinsert->execute([$NIN,$name,$dob,$address]);

                $sql = "INSERT INTO Emergency_Contact(emergency_name,relationship, phone_number) VALUES(?,?,?)";
                $sinsert = $db->prepare($sql);
                $result = $sinsert->execute([$emergency_name,$relationship,$phone_number]);
                $s = $db->prepare("SELECT MAX(emergency_contact_ID) FROM Emergency_Contact ");
                $s->execute();
                $row=$s->fetch();
                $sql = "INSERT INTO Employee(employee_ID,emergency_contact_ID,salary,NIN,department_name) VALUES(?,?,?,?,?)";
                $sinsert = $db->prepare($sql);
                $result = $sinsert->execute([$employee_ID,$row[0],$salary,$NIN,$department_name]);

            

      

                if($result){
                    echo 'Saved';
                }else{
                    echo 'Not saved';
                }
            }
        ?>
    </div>

    <div>



        <form action="index1.php" method="post">
            <div class="form-group">
                <center>
                <h1 style="color:green">Registration Form </h1>
                </center>
                <div class="form-group">
                <label for="employee_ID"   style="color:green"><b>Employee ID</b></label>
                <input type="text" class="form-control"  name="employee_ID" id="employee_ID" placeholder="ID"required>
                </div>

                <div class="form-group">
                <label for="name" style="color:green"><b>Name</b></label>
                <input type="text" class="form-control" name="name" placeholder="Name"required>
                </div>

                <div class="form-group">
                <label for="address" style="color:green"><b>Address</b></label>
                <input type="text" class="form-control" name="address" placeholder="Address"required>
                </div>

                <div class="form-group">
                <label for="salary" style="color:green"><b>Salary</b></label>
                <input type="text" class="form-control" name="salary" placeholder="Salary"required>
                </div>

                <div class="form-group">
                <label for="dob" style="color:green"><b>Date of birth</b></label>
                <input type="text" class="form-control" name="dob" placeholder="DOB"required>
                </div>

                <div class="form-group">
                <label for="NIN" style="color:green"><b>NIN</b></label>
                <input type="text" class="form-control" name="NIN" placeholder="NIN"required>
                </div>


                <div class="form-group">
                <label for="department_name" style="color:green"><b>Department:</b></label>
                <select name="department_name" class="form-control" id="department_name">
                    <option value="Manager">Manager</option>
                    <option value="Driver">Driver</option>
                    <option value="HR">HR</option>
                    <option value="Packager">Packager</option>
                </select>
                </div>

                <div class="form-group">
                <label for="emergency_name" style="color:green"><b>Emergency Name</b></label>
                <input type="text" class="form-control" name="emergency_name" placeholder="Emergency Contact Name"required>
                </div>

                <div class="form-group">
                <label for="relationship" style="color:green"><b>Emergency Relationship</b></label>
                <input type="text" class="form-control" name="relationship" placeholder="Relation"required>
                </div>

                <div class="form-group">
                <label for="phone_number" style="color:green"><b>Emergency Phone</b></label>
                <input type="text" class="form-control" name="phone_number" placeholder="Phone number" required>
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