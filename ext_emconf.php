<?php

$EM_CONF[$_EXTKEY] = [
    'title'              => 'JSON Editor',
    'description'        => 'Edit json in Backend and export to file',
    'category'           => 'plugin',
    'shy'                => false,
    'version'            => '0.1',
    'dependencies'       => '',
    'conflicts'          => '',
    'priority'           => '',
    'loadOrder'          => '',
    'module'             => '',
    'state'              => 'beta',
    'uploadfolder'       => 0,
    'createDirs'         => '',
    'modify_tables'      => '',
    'clearcacheonload'   => true,
    'lockType'           => '',
    'author'             => 'Bernhard Schütz',
    'author_email'       => 'schuetz@azurgruen.de',
    'author_company'     => 'azurgruen // code + design',
    'CGLcompliance'      => null,
    'CGLcompliance_note' => null,
    'constraints'        => [
        'depends'   => [
            'typo3' => '7.5.0-8.99.99'
        ],
        'conflicts' => [],
        'suggests'  => []
    ],
/*
    'autoload' => [
        'psr-4' => [
            'Azurgruen\\AzgrJsonfiler\\' => 'Classes',
        ]
    ]
*/
];
