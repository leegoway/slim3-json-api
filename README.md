# slim-rest-api

This is a slim extension to implement fast JSON API's response

##Installation
Using composer you can add use this as your composer.json

```json
    {
        "require": {
            "slim/slim": "3.*",
            "leegoway/slim3-json-api": "dev-master"
        }
    }

```
##Usage
To include the extension, you should learn about DI in slim.

```php
    require 'vendor/autoload.php';

    $app = new \Slim\Slim();

    $container = $app->getContainer();
    $container['jsonviewer'] = function ($c) {
        $viewer = new JsonViewer($c['response']);
        return $viewer;
    };
```

###example method
all your requests will be returning a JSON output.
the usage will be `$app->render($DATA);` and `$app->renderException( (int)$HTTP_CODE, (string)$MSG);`

####example Normal Data  
```php

    $app->get('/[{name}]', function ($request, $response, $args) {
        // Render json view
        return $this->jsonviewer->render(['username' => 'leego.sir', 'realname' => '李坏', 'age' => 18]);
    });

```


####example output
```json
{
    "code":200,
    "data":{"username":"leego.sir",sir","realname":"李坏","age":18},
    "msg":""
}

```

####example Exception Data  
```php

    $app->get('/[{name}]', function ($request, $response, $args) {
        // Render json view
        return $this->jsonviewer->renderException(400, 'not allowed username param');
    });

```


####example output
```json
{
    "code":400,
    "data":null,
    "msg":"not allowed username param"
}

```

## Protocol
This extension is used to format response, and whenever it will return code\msg\data json result.
The http protocol code will always be 200.

