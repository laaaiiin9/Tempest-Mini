<?php

require_once BASE_PATH . '/core/Model.php';

class UserModel extends Model {

    protected static $table = 'users';

    protected static $fillable = [
        'id',
        'first_name',
        'last_name'
    ];

}