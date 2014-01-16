<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(
    'native' => array(
        'name' => 'session_native',
        'lifetime' => 43200,
    ),
    'cookie' => array(
        'name' => 'session_cookie',
        'encrypted' => TRUE,
        'lifetime' => 43200,
    ),
    'database' => array(
        'name' => 'session_database',
        'encrypted' => TRUE,
        'lifetime' => 43200,
        'table' => 'sessions',
        'columns' => array(
            'session_id'  => 'session_id',
            'last_active' => 'last_active',
            'contents'    => 'contents'
        ),
        'gc' => 500,
    ),
);