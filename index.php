<?php

$con = new mysqli("localhost", "root", "", "my_db");

$sql_person = "SELECT * FROM person_records";
$result_person = $con->query($sql_person);

$sql_employee = "SELECT * FROM employees";
$result_employee = $con->query($sql_employee);

$sql_select = "SELECT * FROM person_records";
$result_select = $con->query($sql_select);

if (
    isset($_POST["firstName"]) && $_POST["firstName"] !== ""
    && isset($_POST["lastName"]) && $_POST["lastName"] !== ""
    && isset($_POST["dateOfBirth"]) && $_POST["dateOfBirth"] !== ""
) :
$sql_person = "INSERT INTO person_records (first_name,last_name, date_of_birth) VALUES ('{$_POST["firstName"]}','{$_POST["lastName"]}', '{$_POST["dateOfBirth"]}')";
$con->query($sql_person);
endif;

if(isset($_POST['submit'])) 
{
    $person_id = $_POST['person_id'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $insert = "INSERT INTO employees (person_id, position, salary) VALUES ('{$person_id}', '{$position}', '{$salary}')";
    $con->query($insert);
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Database</title>
</head>


<body>
    <div class="container">
        <h1>Person Database</h1>
        <table>
            <colgroup>
                <col span="1" class="col-n">
                <col span="3" class="col-w">
            </colgroup>
            <tr>
                <th>Person ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
            </tr>
            <?php
        while ($row = $result_person->fetch_assoc()) :
        ?>
            <tr>
                <td><?= $row["person_id"] ?></td>
                <td><?= $row["first_name"] ?></td>
                <td><?= $row["last_name"] ?></td>
                <td><?= $row["date_of_birth"] ?></td>
            </tr>
            <?php 
        endwhile;
        ?>
        </table>
        <h2>Add a person record:</h2>
        <form method="POST">
            <label for="firstName">First Name</label>
            <input id="firstName" name="firstName">
            <label for="lastName">Last Name</label>
            <input id="lastName" name="lastName">
            <label for="dateOfBirth">Date of Birth</label>
            <input id="dateOfBirth" name="dateOfBirth">
            <button type="submit" name="submit">Submit</button>
        </form>
        <h1>Employee Database</h1>
        <table>
            <colgroup>
                <col span="2" class="col-n">
                <col span="1">
                <col span="1" class="col-n">
            </colgroup>
            <tr>
                <th>Employee ID</th>
                <th>Person ID</th>
                <th>Position</th>
                <th>Salary</th>
            </tr>
            <?php
        while ($row = $result_employee->fetch_assoc()) :
        ?>
            <tr>
                <td><?= $row["employee_id"] ?></td>
                <td><?= $row["person_id"] ?></td>
                <td><?= $row["position"] ?></td>
                <td><?= $row["salary"] ?></td>
            </tr>
            <?php
        endwhile;
        ?>
        </table>
        <h2>Add an employee:</h2>
        <form method="POST">
            <label for="personRecord">Person Record</label>
            <select name="person_id" id="personRecord">
                <option>Select a person</option>
                <?php foreach($result_select as $key => $value) { ?>
                <option value="<?=$value['person_id'];?>"><?=$value['first_name'], ' ', $value['last_name'];?></option>
                <?php } ?>
            </select>
            <label for="position">Position</label>
            <input id="position" name="position">
            <label for="salary">Salary</label>
            <input id="salary" name="salary">
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
<?php
$con->close();
?>

</html>