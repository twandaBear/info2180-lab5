<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
    $country = filter_input(INPUT_GET, 'country', FILTER_DEFAULT);
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE '%$country%'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $cities = '<table>
    <tr>
      <th>Name</th>
     <th >District</th>
    <th >Population</th>
    </tr>';
   foreach ($results as $row){
    $cities .= '<tr>
    <td>' . $row['name'] . '</td>
    <td>' . $row['district'] . '</td>
    <td>' . $row['population'] . '</td>
    </tr>';
   }
   $cities .= '</table>';
   echo json_encode($cities);
   exit;  
}

if(isset($_GET['country'])) {
     
    $country = filter_input(INPUT_GET, 'country', FILTER_DEFAULT);
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $countries = '<table>
    <tr>
    <th>Country Name</th>
    <th>Continent</th>
    <th>Independence Year</th>
    <th>Head of State</th>
    </tr>';
    
    foreach ($results as $row) {
        $countries .= '<tr> 
        <td>' . $row['name'] . '</td>
        <td>' . $row['continent'] . '</td>
        <td>' . $row['independence_year'] . '</td>
        <td>' . $row['head_of_state'] . '</td></tr>';
    }
    $countries .= '</table>';

    echo json_encode($countries);
    exit;
}
?>