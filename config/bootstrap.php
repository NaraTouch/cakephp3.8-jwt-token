<?php
require __DIR__ . '/paths.php';
require CORE_PATH . 'config' . DS . 'bootstrap.php';

use Cake\Cache\Cache;
use Cake\Console\ConsoleErrorHandler;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Database\Type;
use Cake\Datasource\ConnectionManager;
use Cake\Error\ErrorHandler;
use Cake\Http\ServerRequest;
use Cake\Log\Log;
use Cake\Mailer\Email;
use Cake\Mailer\TransportFactory;
use Cake\Utility\Security;

try {
	Configure::config('default', new PhpConfig());
	Configure::load('app', 'default', false);
} catch (\Exception $e) {
	exit($e->getMessage() . "\n");
}

if (Configure::read('debug')) {
	Configure::write('Cache._cake_model_.duration', '+2 minutes');
	Configure::write('Cache._cake_core_.duration', '+2 minutes');
	// disable router cache during development
	Configure::write('Cache._cake_routes_.duration', '+2 seconds');
}

date_default_timezone_set(Configure::read('App.defaultTimezone'));
mb_internal_encoding(Configure::read('App.encoding'));
ini_set('intl.default_locale', Configure::read('App.defaultLocale'));

$isCli = PHP_SAPI === 'cli';
if ($isCli) {
	(new ConsoleErrorHandler(Configure::read('Error')))->register();
} else {
	(new ErrorHandler(Configure::read('Error')))->register();
}

if ($isCli) {
	require __DIR__ . '/bootstrap_cli.php';
}

if (!Configure::read('App.fullBaseUrl')) {
	$s = null;
	if (env('HTTPS')) {
		$s = 's';
	}

	$httpHost = env('HTTP_HOST');
	if (isset($httpHost)) {
		Configure::write('App.fullBaseUrl', 'http' . $s . '://' . $httpHost);
	}
	unset($httpHost, $s);
}

Cache::setConfig(Configure::consume('Cache'));
ConnectionManager::setConfig(Configure::consume('Datasources'));
TransportFactory::setConfig(Configure::consume('EmailTransport'));
Email::setConfig(Configure::consume('Email'));
Log::setConfig(Configure::consume('Log'));
Security::setSalt(Configure::consume('Security.salt'));

ServerRequest::addDetector('mobile', function ($request) {
	$detector = new \Detection\MobileDetect();

	return $detector->isMobile();
});
ServerRequest::addDetector('tablet', function ($request) {
	$detector = new \Detection\MobileDetect();

	return $detector->isTablet();
});

Type::build('time')
	->useImmutable();
Type::build('date')
	->useImmutable();
Type::build('datetime')
	->useImmutable();
Type::build('timestamp')
	->useImmutable();
