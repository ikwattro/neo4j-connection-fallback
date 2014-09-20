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

$actors = json_decode($client->sendCypherQuery($query), true);

?>
<html>
<body>
<h1>Neo4j connection fallback example using <a href="https://github.com/neoxygen/neo4j-neoclient" title="NeoClient">NeoClient</a>.</h1>

<h2>Simple heroku app using 2 db instances from <a href="http://www.graphenedb.com/" title="Graphene DB">Graphene DB</a></h2>
<p>The two instances are loaded with the MovieDB example from <a href="http://neo4j.org" title="Neo4j">Neo4j</a>, one of the databases 
has been shutdowned and the app automatically fallback on the second configured connection. If you have ChromePHP, you can see logs in the 
browser. The query used is "<b>MATCH (actor:Actor) RETURN actor.name ORDER BY actor.name</b>"</p>

<?php
echo '<pre>';
print_r($actors);
