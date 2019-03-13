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

## TODO

Right now, logs are just saved in the database, in a table named goltratec_log

Maybe we should:
- create a simple UI to view the logs.
- some method to view the log of a particular model.
- some way to restore a model to a particular log.