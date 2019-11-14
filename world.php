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
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>