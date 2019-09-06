<?php
session_start();

$_SESSION["userid"] = $_GET["userid"];
header("Location: index.php");