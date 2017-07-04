<?php
defined('TYPO3_MODE') or die();

//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'JSON File Editor');

if (TYPO3_MODE === 'BE') {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        //'Azurgruen' . $_EXTKEY,
        'Azurgruen.AzgrJsoneditor',
        'web',          // Main area
        'Editor',         // Name of the module
        '',             // Position of the module
        array(          // Allowed controller action combinations
            'Backend' => 'index,show,new,create,delete,deleteAll,edit,update',
            //'File' => 'index,show,new,create,delete,edit,update'
        ),
        array(          // Additional configuration
            'access'    => 'user,group',
            'icon'      => 'EXT:azgr_jsoneditor/ext_icon_module.svg',
            'labels'    => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xml',
        )
    );
}
