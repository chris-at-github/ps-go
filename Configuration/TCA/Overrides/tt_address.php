<?php

// ---------------------------------------------------------------------------------------------------------------------
// Weitere Felder in TT-Content
$tmpXoTtAddressColumns = [
	'record_type' => [
		'exclude' => 0,
		'label' => 'LLL:EXT:xo/Resources/Private/Language/locallang_tca.xlf:tx_xo_tt_address.record_type',
		'config' => [
			'type' => 'select',
			'renderType' => 'selectSingle',
			'items' => [
				['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value', 0]
			]
		]
	],
	'tx_xo_content' => [
		'exclude' => true,
		'label' => 'CONTENT',
		'config' => [
			'type' => 'input',
			'size' => 4,
			'eval' => 'int'
		]
	]
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_address', $tmpXoTtAddressColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_address', 'name', 'record_type', 'before:gender');

// ---------------------------------------------------------------------------------------------------------------------
// Tabelle um Typen erweitern
$GLOBALS['TCA']['tt_address']['ctrl']['type'] = 'record_type';

// Neuen Typ Adresse hinzufuegen
$GLOBALS['TCA']['tt_address']['types'][\Ps\Xo\Domain\Model\Address::class] = $GLOBALS['TCA']['tx_news_domain_model_news']['types']['0'];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tt_address', 'record_type', [
	'LLL:EXT:xo/Resources/Private/Language/locallang_tca.xlf:tx_xo_tt_address.record_type.address',
	\Ps\Xo\Domain\Model\Address::class,
	'xo-ttaddress-address'
]);

// Neue Palette General hinzufuegen
$GLOBALS['TCA']['tt_address']['palettes']['xoGeneral'] = [
	'showitem' => 'record_type,'
];

$GLOBALS['TCA']['tt_address']['palettes']['xoAddress'] = [
	'showitem' => 'address, --linebreak--, city, zip, country,'
];

$GLOBALS['TCA']['tt_address']['palettes']['xoContact'] = [
	'showitem' => 'email, --linebreak--, phone, mobile, fax, --linebreak--, www,'
];

$GLOBALS['TCA']['tt_address']['types'][\Ps\Xo\Domain\Model\Address::class]['showitem'] = '
	--palette--;xoGeneral, record_type, name, description, image,
	--palette--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_palette.address;xoAddress,
	--palette--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_palette.contact;xoContact,
	--div--;LLL:EXT:xo/Resources/Private/Language/locallang_tca.xlf:tx_xo_tt_address.div.map,
	--palette--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_palette.coordinates;coordinates,
	,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
	--palette--;;language,
	--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,hidden
	,--div--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_category.tabs.category,categories
';