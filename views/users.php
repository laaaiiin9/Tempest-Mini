<?php

//print_r($data);

$rows = count($data['users']);

echo "Row Count: {$rows} <br>";

foreach ($data['users'] as $user) {
    echo $user['first_name'];
}