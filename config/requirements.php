<?php
if (version_compare(PHP_VERSION, '5.6.0') < 0) {
	trigger_error('Your PHP version must be equal or higher than 5.6.0 to use CakePHP.' . PHP_EOL, E_USER_ERROR);
}
if (!extension_loaded('intl')) {
	trigger_error('You must enable the intl extension to use CakePHP.' . PHP_EOL, E_USER_ERROR);
}
if (!extension_loaded('mbstring')) {
	trigger_error('You must enable the mbstring extension to use CakePHP.' . PHP_EOL, E_USER_ERROR);
}
