<?php

require_once 'vendor/autoload.php';

use Neoxygen\NeoClient\Client;

$logger = new \Monolog\Logger("neoclient");
$logger->pushHandler(new \Monolog\Handler\ErrorLogHandler());

$client = new Client();
$client
	->loadConfigurationFile(__DIR__.'/neoclient.yml')
	->createDefaultChromePHPLogger('browserlog')
	->setLogger('neolog', $logger)
	->build();

$query = 'MATCH (actor:Actor) RETURN actor.name ORDER BY actor.name';

$actors = $client->sendCypherQuery($query);

echo '<pre>';
print_r(json_decode($actors, true));