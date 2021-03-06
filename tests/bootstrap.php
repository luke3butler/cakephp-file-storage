<?php

use Cake\Core\Plugin;

$findRoot = function ($root) {
	do {
		$lastRoot = $root;
		$root = dirname($root);
		if (is_dir($root . '/vendor/cakephp/cakephp')) {
			return $root;
		}
	} while ($root !== $lastRoot);
	throw new \Exception('Cannot find the root of the application, unable to run tests');
};

$root = $findRoot(__FILE__);
unset($findRoot);
chdir($root);
//if (file_exists($root . '/config/bootstrap.php')) {
//	require $root . '/config/bootstrap.php';
//	return;
//}
require $root . '/vendor/cakephp/cakephp/tests/bootstrap.php';
$loader = require $root . '/vendor/autoload.php';

$loader->setPsr4('Cake\\', './vendor/cakephp/cakephp/src');
$loader->setPsr4('Cake\Test\\', './vendor/cakephp/cakephp/tests');
$loader->setPsr4('Burzum\Imagine\\', './vendor/burzum/cakephp-imagine-plugin/src');

$config = [
	'path' => dirname(__FILE__, 2) . DS,
];
if (\version_compare(\Cake\Core\Configure::version(), '3.7.0', 'lt')) {
	Plugin::load('Burzum/FileStorage', $config);
} else {
	$plugin = new \Burzum\FileStorage\Plugin($config);
	Plugin::getCollection()->add($plugin);
}
