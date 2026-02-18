<?php

//print_r($data);

$rows = count($users);

echo "Row Count: {$rows} <br>";

foreach ($users as $user) {
    echo 'User: ' . $user['first_name'];
}