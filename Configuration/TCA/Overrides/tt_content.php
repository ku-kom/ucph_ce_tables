<?php

defined('TYPO3') or die('Access denied.');

/**
 * Extend core tables TCA with checkbox to enable datatables.
 */

call_user_func(function ($extKey ='ucph_content_tables', $contentType ='table') {
    // Add Content Element
    if (!is_array($GLOBALS['TCA']['tt_content']['types'][$contentType] ?? false)) {
        $GLOBALS['TCA']['tt_content']['types'][$contentType] = [];
    }

    // Add content element PageTSConfig
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        $contentType,
        'Configuration/TsConfig/Page/ucph_content_tables.tsconfig',
        'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_ce_table_title'
    );
    

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', [
        // Add datatables checkbox element to enable datatables
        'tx_ucph_content_tables_enable_datatable' => [
            'exclude' => true,
            'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:enable_datatable',
            'onChange' => 'reload',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                    ],
                ],
            ],
        ],
        'tx_ucph_content_tables_datatable_columnpicker' => [
            'displayCond' =>'FIELD:tx_ucph_content_tables_enable_datatable:=:1',
            'exclude' => true,
            'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:column_picker',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        '1 (default)',
                        0,
                    ],
                    [
                        '2',
                        1,
                    ],
                    [
                        '3',
                        2,
                    ],
                    [
                        '4',
                        3,
                    ],
                    [
                        '5',
                        4,
                    ],
                    [
                        '6',
                        5,
                    ]
                ],
                'default' => 0
            ],
        ],
        'tx_ucph_content_tables_datatable_columnsort' => [
            'displayCond' =>'FIELD:tx_ucph_content_tables_enable_datatable:=:1',
            'exclude' => true,
            'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:column_sort',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:column_sort_asc',
                        'asc',
                    ],
                    [
                        'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:column_sort_desc',
                        'desc',
                    ]
                ],
                'default' => 'asc'
            ],
        ],
    ]);

    // Add more table classes
    $GLOBALS['TCA']['tt_content']['columns']['table_class']['config']['items'][] = [
        'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:table_hover',
        'hover'
    ];
    $GLOBALS['TCA']['tt_content']['columns']['table_class']['config']['items'][] = [
        'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:table_condensed',
        'condensed'
    ];

    // Add checkbox to existing tables palette
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'tableconfiguration', // table palette name
        '--linebreak--,tx_ucph_content_tables_enable_datatable,tx_ucph_content_tables_datatable_columnpicker,tx_ucph_content_tables_datatable_columnsort', // New TCA
        'after:table_caption' // Existing TCA
    );
});
