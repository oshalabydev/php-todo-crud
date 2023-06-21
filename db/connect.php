<?php

// You'll need a config.php file that carries the info needed to connect to
// the database via mysqli: DB_HOST, DB_USER, DB_PASS and DB_NAME.
// Visit the README.md for more info

include $_SERVER["DOCUMENT_ROOT"] . "/todo-app/db/config.php";

$missing_db_info = DB_HOST === NULL || DB_USER === NULL || DB_PASS === NULL || DB_NAME === NULL;

// If some options in ./db/config.php are missing, set certain options to their default values
// Some options like DB_PASS and DB_NAME don't have defaults
// If setting to defaults doesn't fix the problem (e.g. DB_PASS or DB_NAME not set), exit the script and give an error

if ($missing_db_info) {
  define("DB_HOST", "localhost");
  define("DB_USER", "root");
}

if ($missing_db_info) {
  die("Error: missing important info for accessing database");
}

$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($database->connect_error) {
  die("Error: connection failed: " . $database->connect_error);
}
