<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MySQL";
// Create connection

$mysqli = new mysqli($servername, $username, $password, $dbname);

$table1 = "CREATE TABLE Person (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    gender VARCHAR(50),
    birth_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                    )";
$table2 = "CREATE TABLE PersonInfo(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        familyMembers INT(3) NOT NULL,
        petsCount int(3) NOT NULL,
        personId int(3) UNSIGNED,
        FOREIGN KEY(personId) REFERENCES Person(id))";
$tables = [$table1, $table2];
foreach ($tables as $key => $sql) {
    if ($mysqli->query($sql) === TRUE) {
        echo "Tables created successfully <br>";
    } else {
        if ($mysqli->errno == '1050') {
        } else
            echo "Error creating table: " . $mysqli->error . "<br>";
    }
}
$sql = "show tables";

$result = mysqli_query($mysqli, $sql);
while ($table = mysqli_fetch_array($result)) {
    echo('Table: ' . $table[0] . "<BR>");
}
//123
function selectFromPerson($mysqli)
{
    $sql = "SELECT * FROM Person";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Full name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
        }
    } else {
        echo "0 results";
    }
}

function selectFromPersonInfo($mysqli)
{
    $sql = "SELECT * FROM PersonInfo";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - family members count: " . $row["familyMembers"] . " pets count " . $row["petsCount"] . " which person: " . $row["personId"] . "<br>";
        }
    } else {
        echo "0 results";
    }
}

selectFromPerson($mysqli);
selectFromPersonInfo($mysqli);
echo "<br><br>";
$sql = "SELECT firstname, lastname, Person.id AS id, familyMembers, PersonInfo.personId AS personId
    FROM Person
    LEFT JOIN PersonInfo
    ON Person.id = PersonInfo.personId
    WHERE personId IS NULL";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Full name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
    }
} else {
    echo "0 results";
}

echo '<br> <br>';

$sql = "Update Person SET firstname='John' WHERE id=1";
$result = $mysqli->query($sql);

$sql = "DELETE FROM Person 
        WHERE firstname LIKE 'a%'
        ORDER BY firstname ASC 
        LIMIT 2";
$result = $mysqli->query($sql);
?>

