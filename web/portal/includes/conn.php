<?php

include "db.php";

# Establish db connection
# $db = pg_connect(pg_connection_string($DB_NAME, $DB_DSN, $DB_PORT, $DB_USER, $DB_PASSWORD));
$db = pg_connect(getenv("DATABASE_URL"));
if (!$db) {
    //echo 'Database Connection Error';
} else {
    //echo 'Connected.';
}

?>