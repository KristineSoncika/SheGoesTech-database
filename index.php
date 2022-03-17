<?php

$con = new mysqli("localhost", "root", "", "my_db");
if ($con->connect_error)
    die("Connection error" . $con->connect_error);

if (
    isset($_POST["firstName"]) && $_POST["firstName"] !== ""
    && isset($_POST["lastName"]) && $_POST["lastName"] !== ""
    && isset($_POST["dateOfBirth"]) && $_POST["dateOfBirth"] !== ""
) :
$sql_person = "INSERT INTO person_records (first_name,last_name, date_of_birth) VALUES ('{$_POST["firstName"]}','{$_POST["lastName"]}', '{$_POST["dateOfBirth"]}')";
$con->query($sql_person);
endif;

$sql_person = "SELECT * FROM person_records";
$result_person = $con->query($sql_person);

$sql_employee = "SELECT * FROM employees";
$result_employee = $con->query($sql_employee);
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
                <td class="center"><?= $row["person_id"] ?></td>
                <td><?= $row["first_name"] ?></td>
                <td><?= $row["last_name"] ?></td>
                <td class="center"><?= $row["date_of_birth"] ?></td>
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
            <button type="submit">Submit</button>
        </form>
        <h1>Employee Database</h1>
        <table>
            <tr>
                <th>Employee ID</th>
                <th>Person ID</th>
                <th>Role</th>
                <th>Salary</th>
            </tr>
            <?php
        while ($row = $result_employee->fetch_assoc()) :
        ?>
            <tr>
                <td class="center"><?= $row["employee_id"] ?></td>
                <td class="center"><?= $row["person_id"] ?></td>
                <td><?= $row["role"] ?></td>
                <td><?= $row["salary"] ?></td>
            </tr>
            <?php
        endwhile;
        ?>
        </table>
        <h2>Add an employee:</h2>
        <form method="POST">
            <label for="personRecord">Person Record</label>
            <select id="firstName" name="firstName"></select>
            <label for="role">Role</label>
            <input id="role" name="role">
            <label for="salary">Salary</label>
            <input id="salary" name="salary">
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
<?php
$con->close();
?>

</html>