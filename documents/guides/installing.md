# Installing

## Install via composer

As you will use the module as a base you simply want to git clone it to your local workspace

```
$ git clone https://github.com/artbyrab/yii2-module-base.git your-app-name-here
```

## Manual install 

You can also manually install the module. Simply download a copy and unzip or unpack the folder you wish to install in for example your public_html folder.

## Setup

To view the module as intended you will need to run the database migrations and load the fixtures from a terminal.

### Setup the database migrations

Assuming your are already in the root of the directory of the module:

Now navigate to the tests folder:
```
cd src/tests
```

Now run the migrations, first you can migrate down to make sure the database is clean:
```
php yii migrate/down 100
```

Now migrate up:
```
php yii migrate/up
```

### Setup the fixtures

We need to load the database fixtures too, again make sure you are in the tests folder:
```
cd src/tests
```

Now run the fixture load all command:
```
php yii fixture/load "*"
```

## Running

You will need to have PHP installed on your system to run the local server. 

Assuming you are already in the root directory of the module, to get the module up and running navigate to the tests/app folder:
```
$ cd src/tests/app/web
```

Now start the PHP server:
```
$ php -S localhost:8080
```

### Stopping the php server

To stop the php server running you can do the following:

* Press Ctrl-C to quit

## Viewing the module in your browser

Once you have got the module up and running you can view it in your browser, simply navigate to:
```
http://localhost:8080/
```
