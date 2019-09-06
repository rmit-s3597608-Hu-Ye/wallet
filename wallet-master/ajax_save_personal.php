<?php
require_once "util/dbUtils.php";

$table = $_POST['type'];
$field = $_POST['name'];
$value = $_POST['value'];

$result = updatePersonalProfile($table, $field, $value);
echo $result;
