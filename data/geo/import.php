<?

$config = require dirname(__FILE__) . "/../../config/main_conf.php";
$config['db'] = $config['components']['db'];


$db_conf = explode(";", $config['db']['connectionString']);

$config['db']['host'] = explode("=", $db_conf[0]);
$config['db']['host'] = $config['db']['host'][1];
$config['db']['db_name'] = explode("=", $db_conf[1]);
$config['db']['db_name'] = $config['db']['db_name'][1];

$link = mysqli_connect($config['db']['host'], $config['db']['username'], $config['db']['password'], $config['db']['db_name']) or die("Error " . mysqli_error($link));

$query = file_get_contents("import.sql");

mysqli_multi_query($link, $query) or die(" error ");
?>