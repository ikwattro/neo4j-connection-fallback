## Neo4j connection fallback example

http://neoclient-fallback-example.herokuapp.com/

Simple application example to show how easy it is to configure a fallback connection with [NeoClient](https://github.com/neoxygen/neo4j-neoclient) .

---

## Create a configuration file at the root of your project, for e.g. `neoclient.yml` :

```yaml
connections:
  defaultdb:
    scheme: http
    host: testdb.sb02.stations.graphenedb.com
    port: 24789
    auth: true
    user: testdb
    password: "%defaultdb_password%"
  backupdb:
    scheme: http
    host: testdb2.sb02.stations.graphenedb.com
    port: 24789
    auth: true
    user: testdb2
    password: "%testdb2_password%"

fallback:
  defaultdb: backupdb
```

## Setup your client and provide the configuration file :

```php
// index.php file (simple example)
$client = new Client();
$client
	->loadConfigurationFile(__DIR__.'/neoclient.yml')
	->createDefaultChromePHPLogger('browserlog')
	->setLogger('neolog', $logger)
	->build();
```

That's it ! If your connection `defaultdb` is down, it will automatically fall back to the `backupdb` ...

---

#### Author

Christophe Willemsen [@ikwattro](https://twitter.com/ikwattro)