# Testing

You can test this module as you would a Yii2 app. The module uses a SQLite3 database to test for ease of portability. 

## SQLlite3 

As mentioned, we use SQLite3 as the test database for ease of portability. You can learn more and install this if required on your system via the homepage here:

* https://sqlite.org/cli.html

You may also want a nice SQLite viewer for which you can install SQLite Browser.

In addition you may find Yii2 cannot find the driver to run the tests in that can you might be missing the php driver for mysqli sqlite, see more here:

* https://stackoverflow.com/questions/8822209/pdo-sqlite-driver-not-present-what-to-do

For me i had to install the following for PHP:
```
$ sudo apt-get install php7.2-sqlite3
$ sudo service apache2 restart
```

## Startup the local server
You can start up the local server to check how things look:

* Navigate to:
```
$ cd src/tests/app/web
```

* Run the webserver

```
$ php -S localhost:8080
```

* Run the migrations for the test database
    * Navigate to the tests folder

* Next run the yii migrations

```
$ php yii migrate/down 100
$ php yii migrate/up
```

* Next let's load the fixtures

```
$ php yii fixture/load "*"
```

## Running Codeception testing

Please note you may need to run the codecept build before runnings tests, codeception will tell you if required to run the following from the root of the app:

```
vendor/bin/codecept build
```

To run just a single test:

* Navigate to the root of the module
* Now you need to run the tests from the module utilising the existing codeception executable in your main app.
* Run the unit test, where Model is the Name of the model you want to test:

```
vendor/bin/codecept run unit ModelTest
```

* Run unit tests

```
vendor/bin/codecept run unit
```

* Run functional tests

```
vendor/bin/codecept run functional
```

* Run them all at once

```
vendor/bin/codecept run
```
