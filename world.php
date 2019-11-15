<?php
$host = getenv('IP');
$username = 'natechris';
$password = 'MasterMind';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if ($_GET):
    $country = $_GET['country'];
    $cntxt = $_GET['context'];
    if (strlen($country) <= 50):
        $country = filter_var($country, FILTER_SANITIZE_STRING);
        $cntxt = filter_var($cntxt, FILTER_SANITIZE_STRING);
        echo "<p>Context: ${cntxt} </p>";
        if ($cntxt !== 'cities'):
            $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
        else:
            $stmt = $conn->query("SELECT cs.name, cs.district, cs.population FROM countries c JOIN cities cs 
            on c.code = cs.country_code where c.name LIKE '$country'");
        endif;
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
<?php if($cntxt !== 'cities'):  ?>
    <tr>
        <th>Name</th>
        <th>Continent</th>
        <th>Independence</th>
        <th>Head of State</th>
    </tr>
<?php else: ?>
    <tr>
        <th>Name</th>
        <th>District</th>
        <th>Population</th>
    </tr>
<?php endif; ?>
<?php foreach ($results as $row): 
        if ($cntxt !== 'cities'):
?>
    <tr>
        <td><?=$row['name']?></td>
        <td><?=$row['continent']?></td>
        <td><?=$row['independence_year']?></td>
        <td><?=$row['head_of_state']?></td>
    </tr>
<?php     else: ?>
    <tr>
        <td><?=$row['name']?></td>
        <td><?=$row['district']?></td>
        <td><?=$row['population']?></td>
    </tr>

<?php endif;
endforeach; ?>
</table>