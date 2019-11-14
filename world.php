<?php
$host = getenv('IP');
$username = 'natechris';
$password = 'MasterMind';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if ($_GET):
    $country = $_GET['country'];
    if (strlen($country) <= 50):
        $country = filter_var($country, FILTER_SANITIZE_STRING);
        $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
        $stmt->execute();
    else:
        $country = '';
    endif;
else:
    
    $stmt = $conn->query("SELECT * FROM countries");
endif;

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $conn->query("SELECT * FROM countries");

?>
<table>
    <tr>
        <th>Name</th>
        <th>Continent</th>
        <th>Independence</th>
        <th>Head of State</th>
    </tr>
<?php foreach ($results as $row): ?>
    <tr>
        <td><?=$row['name']?></td>
        <td><?=$row['continent']?></td>
        <td><?=$row['independence_year']?></td>
        <td><?=$row['head_of_state']?></td>
    </tr>
<?php endforeach; ?>
</table>