<?php

/**
 * Created by PhpStorm.
 * User: laci
 * Date: 3/23/17
 * Time: 10:48 AM
 */
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('./database/test.db');
    }

    public function onCreate()
    {

        $sql = "
                  CREATE TABLE COMPANY
                 (ID INT PRIMARY KEY     NOT NULL,
                  NAME           TEXT    NOT NULL,
                  AGE            INT     NOT NULL,
                  ADDRESS        CHAR(50),
                  SALARY         REAL);";

        return $this->exec($sql);

    }
}

$logHandle = fopen('./log/database.log', 'w');

$db = new MyDB();

if (!$db) {
    fwrite($logHandle, $db->lastErrorMsg());
} else {
    fwrite($logHandle, "Database opened" . PHP_EOL);
}


if (!$db->onCreate()) {
    fwrite($logHandle, $db->lastErrorMsg());
} else {
    fwrite($logHandle, "Table Created" . PHP_EOL);
}

$db->close();

