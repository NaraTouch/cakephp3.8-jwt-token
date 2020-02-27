<?php
use Cake\Cache\Engine\FileEngine;
use Cake\Database\Connection;
use Cake\Database\Driver\Mysql;
use Cake\Error\ExceptionRenderer;
use Cake\Log\Engine\FileLog;
use Cake\Mailer\Transport\MailTransport;

return [
	'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),
	'App' => [
		'namespace' => 'App',
		'encoding' => env('APP_ENCODING', 'UTF-8'),
		'defaultLocale' => env('APP_DEFAULT_LOCALE', 'en_US'),
		'defaultTimezone' => env('APP_DEFAULT_TIMEZONE', 'UTC'),
		'base' => false,
		'dir' => 'src',
		'webroot' => 'webroot',
		'wwwRoot' => WWW_ROOT,
		//'baseUrl' => env('SCRIPT_NAME'),
		'fullBaseUrl' => false,
		'imageBaseUrl' => 'img/',
		'cssBaseUrl' => 'css/',
		'jsBaseUrl' => 'js/',
		'paths' => [
			'plugins' => [ROOT . DS . 'plugins' . DS],
			'templates' => [APP . 'Template' . DS],
			'locales' => [APP . 'Locale' . DS],
		],
	],

	'Security' => [
		'salt' => env('SECURITY_SALT', '__SALT__'),
	],

	'Asset' => [
		//'timestamp' => true,
		// 'cacheTime' => '+1 year'
	],

	'Cache' => [
		'default' => [
			'className' => FileEngine::class,
			'path' => CACHE,
			'url' => env('CACHE_DEFAULT_URL', null),
		],

		'_cake_core_' => [
			'className' => FileEngine::class,
			'prefix' => 'myapp_cake_core_',
			'path' => CACHE . 'persistent/',
			'serialize' => true,
			'duration' => '+1 years',
			'url' => env('CACHE_CAKECORE_URL', null),
		],

		'_cake_model_' => [
			'className' => FileEngine::class,
			'prefix' => 'myapp_cake_model_',
			'path' => CACHE . 'models/',
			'serialize' => true,
			'duration' => '+1 years',
			'url' => env('CACHE_CAKEMODEL_URL', null),
		],

		'_cake_routes_' => [
			'className' => FileEngine::class,
			'prefix' => 'myapp_cake_routes_',
			'path' => CACHE,
			'serialize' => true,
			'duration' => '+1 years',
			'url' => env('CACHE_CAKEROUTES_URL', null),
		],
	],

	'Error' => [
		'errorLevel' => E_ALL,
		'exceptionRenderer' => ExceptionRenderer::class,
		'skipLog' => [],
		'log' => true,
		'trace' => true,
	],

	'EmailTransport' => [
		'default' => [
			'className' => MailTransport::class,
			/*
			 * The following keys are used in SMTP transports:
			 */
			'host' => 'localhost',
			'port' => 25,
			'timeout' => 30,
			'username' => null,
			'password' => null,
			'client' => null,
			'tls' => null,
			'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
		],
	],

	'Email' => [
		'default' => [
			'transport' => 'default',
			'from' => 'you@localhost',
			//'charset' => 'utf-8',
			//'headerCharset' => 'utf-8',
		],
	],

	'Datasources' => [
		'default' => [
			'className' => Connection::class,
			'driver' => Mysql::class,
			'persistent' => false,
			'host' => 'localhost',
			/*
			 * CakePHP will use the default DB port based on the driver selected
			 * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
			 * the following line and set the port accordingly
			 */
			//'port' => 'non_standard_port_number',
			'username' => 'my_app',
			'password' => 'secret',
			'database' => 'my_app',
			/*
			 * You do not need to set this flag to use full utf-8 encoding (internal default since CakePHP 3.6).
			 */
			//'encoding' => 'utf8mb4',
			'timezone' => 'UTC',
			'flags' => [],
			'cacheMetadata' => true,
			'log' => false,
			'quoteIdentifiers' => false,
			'url' => env('DATABASE_URL', null),
		],
		'test' => [
			'className' => Connection::class,
			'driver' => Mysql::class,
			'persistent' => false,
			'host' => 'localhost',
			//'port' => 'non_standard_port_number',
			'username' => 'my_app',
			'password' => 'secret',
			'database' => 'test_myapp',
			//'encoding' => 'utf8mb4',
			'timezone' => 'UTC',
			'cacheMetadata' => true,
			'quoteIdentifiers' => false,
			'log' => false,
			//'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
			'url' => env('DATABASE_TEST_URL', null),
		],
	],

	'Log' => [
		'debug' => [
			'className' => FileLog::class,
			'path' => LOGS,
			'file' => 'debug',
			'url' => env('LOG_DEBUG_URL', null),
			'scopes' => false,
			'levels' => ['notice', 'info', 'debug'],
		],
		'error' => [
			'className' => FileLog::class,
			'path' => LOGS,
			'file' => 'error',
			'url' => env('LOG_ERROR_URL', null),
			'scopes' => false,
			'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
		],
		// To enable this dedicated query log, you need set your datasource's log flag to true
		'queries' => [
			'className' => FileLog::class,
			'path' => LOGS,
			'file' => 'queries',
			'url' => env('LOG_QUERIES_URL', null),
			'scopes' => ['queriesLog'],
		],
	],
	'Session' => [
		'defaults' => 'php',
	],
];
