# Log Behavior

Simple extension to log every change made to any model.

## Installation

Install via composser

```
composer require yepes/yii2-model-log-behavior
```

Apply migrations:

```
./yii migrate/up --migrationPath=@vendor/yepes/yii2-model-log-behavior/migrations
```

Configure the behavior

```
public function behaviors()
{
    return [
        \goltratec\log\LogBehavior::className()
    ];
}
```

### Ignoring attributes

In the model, just define an attribute **$logIgnoredAttributes** which is an array of string, representings the properties you wish to ignore.

```
public $logIgnoredAttributes = ['attribute1', 'attribute2'];
```

If $logIgnoredAttributes is not defined, every attribute will be logged.

### Ignore log

To ignore the creation of a log line, simply add ignoreLog in your model and set it to true:

Your model:

```
public $ignoreLog = false;
```

Your action you don't want to log:

```
$myModel->ignoreLog = true;
$myModel->save();
```

## TODO

Right now, logs are just saved in the database, in a table named goltratec_log

Maybe we should:

- create a simple UI to view the logs.
- some method to view the log of a particular model.
- some way to restore a model to a particular log.
