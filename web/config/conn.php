<?php

include "db.php";

function pg_connection_string($DB_NAME, $DB_DSN, $DB_PORT, $DB_USER, $DB_PASSWORD)
{
    return "dbname=" . $DB_NAME . " host=" . $DB_DSN . " port=" . $DB_PORT . " user=" . $DB_USER . " password=" . $DB_PASSWORD . " sslmode=require";
}

# Establish db connection
# $db = pg_connect(pg_connection_string($DB_NAME, $DB_DSN, $DB_PORT, $DB_USER, $DB_PASSWORD));
$db = pg_connect(getenv('DATABASE_URL'));
if (!$db) {
    //echo 'Database Connection Error' . '</br>';
} else {
    //echo 'Connected.';
}

?>