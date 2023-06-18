<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.8
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

/*
 * Configure paths required to find CakePHP + general filepath constants
 */
require __DIR__ . '/paths.php';

/*
 * Bootstrap CakePHP.
 *
 * Does the various bits of setup that CakePHP needs to do.
 * This includes:
 *
 * - Registering the CakePHP autoloader.
 * - Setting the default application paths.
 */
require CORE_PATH . 'config' . DS . 'bootstrap.php';

use Cake\Cache\Cache;
use Cake\Console\ConsoleErrorHandler;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Datasource\ConnectionManager;
use Cake\Error\ErrorHandler;
use Cake\Http\ServerRequest;
use Cake\Log\Log;
use Cake\Mailer\Email;
use Cake\Mailer\TransportFactory;
use Cake\Utility\Security;

/**
 * Uncomment block of code below if you want to use `.env` file during development.
 * You should copy `config/.env.default to `config/.env` and set/modify the
 * variables as required.
 *
 * It is HIGHLY discouraged to use a .env file in production, due to security risks
 * and decreased performance on each request. The purpose of the .env file is to emulate
 * the presence of the environment variables like they would be present in production.
 */
// if (!env('APP_NAME') && file_exists(CONFIG . '.env')) {
//     $dotenv = new \josegonzalez\Dotenv\Loader([CONFIG . '.env']);
//     $dotenv->parse()
//         ->putenv()
//         ->toEnv()
//         ->toServer();
// }

/*
 * Read configuration file and inject configuration into various
 * CakePHP classes.
 *
 * By default there is only one configuration file. It is often a good
 * idea to create multiple configuration files, and separate the configuration
 * that changes from configuration that does not. This makes deployment simpler.
 */
try {
    Configure::config('default', new PhpConfig());
    Configure::load('app', 'default', false);
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}

/*
 * Load an environment local configuration file.
 * You can use a file like app_local.php to provide local overrides to your
 * shared configuration.
 */
//Configure::load('app_local', 'default');

/*
 * When debug = true the metadata cache should only last
 * for a short time.
 */
if (Configure::read('debug')) {
    Configure::write('Cache._cake_model_.duration', '+2 minutes');
    Configure::write('Cache._cake_core_.duration', '+2 minutes');
    // disable router cache during development
    Configure::write('Cache._cake_routes_.duration', '+2 seconds');
}

/*
 * Set the default server timezone. Using UTC makes time calculations / conversions easier.
 * Check http://php.net/manual/en/timezones.php for list of valid timezone strings.
 */

/*
 * Configure the mbstring extension to use the correct encoding.
 */
mb_internal_encoding(Configure::read('App.encoding'));

/*
 * Set the default locale. This controls how dates, number and currency is
 * formatted and sets the default language to use for translations.
 */
ini_set('intl.default_locale', Configure::read('App.defaultLocale'));

/*
 * Register application error and exception handlers.
 */
$isCli = PHP_SAPI === 'cli';
if ($isCli) {
    (new ConsoleErrorHandler(Configure::read('Error')))->register();
} else {
    (new ErrorHandler(Configure::read('Error')))->register();
}

/*
 * Include the CLI bootstrap overrides.
 */
if ($isCli) {
    require __DIR__ . '/bootstrap_cli.php';
}

/*
 * Set the full base URL.
 * This URL is used as the base of all absolute links.
 *
 * If you define fullBaseUrl in your config file you can remove this.
 */
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

/*
 * The default crypto extension in 3.0 is OpenSSL.
 * If you are migrating from 2.x uncomment this code to
 * use a more compatible Mcrypt based implementation
 */
//Security::engine(new \Cake\Utility\Crypto\Mcrypt());

/*
 * Setup detectors for mobile and tablet.
 */
ServerRequest::addDetector('mobile', function ($request) {
    $detector = new \Detection\MobileDetect();

    return $detector->isMobile();
});
ServerRequest::addDetector('tablet', function ($request) {
    $detector = new \Detection\MobileDetect();

    return $detector->isTablet();
});

/*
 * Enable immutable time objects in the ORM.
 *
 * You can enable default locale format parsing by adding calls
 * to `useLocaleParser()`. This enables the automatic conversion of
 * locale specific date formats. For details see
 * @link https://book.cakephp.org/3.0/en/core-libraries/internationalization-and-localization.html#parsing-localized-datetime-data
 */
//Type::build('time')
//    ->useImmutable();
//Type::build('date')
//    ->useImmutable();
//Type::build('datetime')
//    ->useImmutable();
//Type::build('timestamp')
//    ->useImmutable();
//Cake\I18n\FrozenDate::setToStringFormat('Y-m-d H:i:s');
/*
 * Custom Inflector rules, can be set to correctly pluralize or singularize
 * table, model, controller names or whatever other string is passed to the
 * inflection functions.
 */
//Inflector::rules('plural', ['/^(inflect)or$/i' => '\1ables']);
//Inflector::rules('irregular', ['red' => 'redlings']);
//Inflector::rules('uninflected', ['dontinflectme']);
//Inflector::rules('transliteration', ['/å/' => 'aa']);


$this->addPlugin('Theme1');
$this->addPlugin('Theme2');
// Configure::write('Session', array(
// 	'defaults' => 'php',
// 	'timeout' => 30, // The session will timeout after 30 minutes of inactivity
// 	'cookieTimeout' => 1440, // The session cookie will live for at most 24 hours, this does not effect session timeouts
// 	'checkAgent' => false,
// 	'autoRegenerate' => true, // causes the session expiration time to reset on each page load
// ));
Configure::write('AdminRoles', ['admin.admin'=>'admin.admin', 'admin.root'=>'admin.root']);
Configure::write('UserRoles', ['user.free'=>'user.free', 'user.paid'=>'user.paid']);

Configure::write('roles', ['admin.root'=>'admin.root', 'admin.admin'=>'admin.admin', 'admin.editor'=>'admin.editor', 'user.free'=>'user.free', 'user.paid'=>'user.paid']);

Configure::write('languages', [1=>'en', 2=>'ar', 3=>'tr']);
Configure::write('languages_ids', ['en'=>1, 'ar'=>2, 'tr'=>3]);
Configure::write('app_folder', ( @$_SERVER['HTTP_HOST'] == "localhost" ? '/'.basename(dirname(__DIR__)) : ''));
Configure::write('isLocal', $_SERVER['HTTP_HOST'] == "localhost" ? true : false);

Configure::write('ROLES', [
	'user.free'=>[
		'polls'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'exams'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'categories'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'comments'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'contacts'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'scores'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'users'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'tags'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'results'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'competitions'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'competitors'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'matches'=>['create'=>0, 'read'=>1, 'update'=>0, 'delete'=>0, 'allids'=>1],
		'firms'=>['create'=>0, 'read'=>1, 'update'=>0, 'delete'=>0, 'allids'=>1],
	],
	'user.paid'=>[
		'polls'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'exams'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'categories'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'comments'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'contacts'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'scores'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'users'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'tags'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'results'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'competitions'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'competitors'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>0],
		'matches'=>['create'=>0, 'read'=>1, 'update'=>0, 'delete'=>0, 'allids'=>1],
		'firms'=>['create'=>0, 'read'=>1, 'update'=>0, 'delete'=>0, 'allids'=>1],
	],
	'admin.root'=>[
		'polls'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>1, 'allids'=>1],
		'exams'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>1, 'allids'=>1],
		'categories'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>1, 'allids'=>1],
		'comments'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>1, 'allids'=>1],
		'contacts'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>1, 'allids'=>1],
		'scores'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>1, 'allids'=>1],
		'users'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>1, 'allids'=>1],
		'tags'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>1, 'allids'=>1],
		'results'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>1, 'allids'=>1],
		'competitions'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>1, 'allids'=>1],
		'competitors'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>1, 'allids'=>1],
		'matches'=>['create'=>0, 'read'=>1, 'update'=>0, 'delete'=>0, 'allids'=>1],
		'firms'=>['create'=>0, 'read'=>1, 'update'=>0, 'delete'=>0, 'allids'=>1],
	],
	'admin.admin'=>[
		'polls'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'exams'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'categories'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'comments'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'contacts'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'scores'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'users'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'tags'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'results'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'competitions'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'competitors'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'matches'=>['create'=>0, 'read'=>1, 'update'=>0, 'delete'=>0, 'allids'=>1],
		'firms'=>['create'=>0, 'read'=>1, 'update'=>0, 'delete'=>0, 'allids'=>1],
	],
	'admin.editor'=>[
		'polls'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'exams'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'categories'=>['create'=>0, 'read'=>1, 'update'=>0, 'delete'=>0, 'allids'=>1],
		'comments'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'contacts'=>['create'=>0, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'scores'=>['create'=>0, 'read'=>1, 'update'=>0, 'delete'=>0, 'allids'=>1],
		'users'=>['create'=>0, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'tags'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'results'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
		'competitions'=>['create'=>0, 'read'=>1, 'update'=>0, 'delete'=>0, 'allids'=>1],
		'competitors'=>['create'=>0, 'read'=>1, 'update'=>0, 'delete'=>0, 'allids'=>1],
		'matches'=>['create'=>0, 'read'=>1, 'update'=>0, 'delete'=>0, 'allids'=>1],
		'firms'=>['create'=>1, 'read'=>1, 'update'=>1, 'delete'=>0, 'allids'=>1],
	],
]);
