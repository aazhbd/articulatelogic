<?php

$conf = array(
    'production' => array(
        'db_name' => 'articulatelogic_db',
        'db_host' => 'localhost',
        'db_user' => 'root',
        'db_pass' => '',
        'development_mode' => true,

        'path_url' => '',
        'path_root' => '',

        'path_sys_template' => '/Template/base.twig',
        'path_static' => '/Template/static/',
        'path_user_template' => '/App/views',
        'user_var' => array(
            'project_name' => 'ArticulateLogic.com',
            'project_static' => '/App/static',
            'files_dir' => '../../file_dir'
        ),
    ),
    'development' => array(
        'db_name' => 'articulatelogic_db',
        'db_host' => 'localhost',
        'db_user' => 'root',
        'db_pass' => '',
        'development_mode' => true,
        'path_sys_template' => '/Template/base.twig',
        'path_static' => '/Template/static/',
        'path_user_template' => '/App/views',
        'user_var' => array(
            'project_name' => 'ArticulateLogic.com',
            'project_static' => '/App/static',
            'files_dir' => '../../file_dir'
        ),
    ),
    'staging' => array(
        'db_name' => 'articulatelogic_db',
        'db_host' => 'localhost',
        'db_user' => 'root',
        'db_pass' => '',
        'development_mode' => true,
        'path_sys_template' => '/Template/base.twig',
        'path_static' => '/Template/static/',
        'path_user_template' => '/App/views',
        'user_var' => array(
            'project_name' => 'ArticulateLogic.com',
            'project_static' => '/App/static',
            'files_dir' => '../../file_dir'
        ),
    )
);

return $conf['development'];

