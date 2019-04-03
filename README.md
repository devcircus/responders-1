# Perfect Oblivion - Responders
### A Responder Implementation for Laravel Projects.

[![Latest Stable Version](https://poser.pugx.org/perfect-oblivion/responders/version)](https://packagist.org/packages/perfect-oblivion/responders)
[![Build Status](https://img.shields.io/travis/perfect-oblivion/responders/master.svg)](https://travis-ci.org/perfect-oblivion/responders)
[![Quality Score](https://img.shields.io/scrutinizer/g/perfect-oblivion/responders.svg)](https://scrutinizer-ci.com/g/perfect-oblivion/responders)
[![Total Downloads](https://poser.pugx.org/perfect-oblivion/responders/downloads)](https://packagist.org/packages/perfect-oblivion/responders)

![Perfect Oblivion](https://res.cloudinary.com/phpstage/image/upload/v1554128207/img/Oblivion.png "Perfect Oblivion")

### Disclaimer
The packages under the PerfectOblivion namespace exist to provide some basic functionality that I prefer not to replicate from scratch in every project. Nothing groundbreaking here.

Responders are a great way to make your controllers slim and keep the code related to responses in one place. The general idea is based on the "R" in [ADR - Action Domain Responder](http://paul-m-jones.com/archives/5970), by [Paul M. Jones](https://twitter.com/pmjones).

For example, in your controller:

```php
namespace App\Http\Controllers;

use App\MyDatasource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responders\Post\IndexResponder;

class PostIndex implements Controller
{
    /**
     * The Responder.
     *
     * @var \App\Http\Responders\Post\IndexResponder
     */
    private $responder;

    /**
     * Construct a new PostIndex Controller.
     *
     * @param \App\Http\Responders\Post\IndexResponder $responder
     */
    public function __construct(Responder $responder)
    {
        $this->responder = $responder;
    }

    public function index(Request $request)
    {
        $data = MyDatasource::getSomeData($request);

        return $this->responder->withPayload($data);
    }
}
```

Then in your responder:

```php
namespace App\Http\Responders\Post;

use Illuminate\Http\Request;
use PerfectOblivion\Responder\Responder;

class IndexResponder extends Responder
{
    /**
     * Send a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|array|null  $data
     *
     * @return mixed
     */
    public function respond()
    {
        if ($request->isApi()) { // isApi() is not part of this package
            // return json
        }

        return $this->view('posts.index', ['posts' => $this->payload]);
    }
}

```

The benefit over the traditional "handle the response inside your controller actions", is the clarity it brings, the narrow class responsibility, fewer dependencies in your controller and overall organization. When used together with [single action controllers](https://laravel.com/docs/5.6/controllers#single-action-controllers), you can really clean up your controllers and bring a lot of clarity to your codebase.

## Installation

You can install the package via composer:

```bash
composer require perfect-oblivion/responders
```

Laravel versions > 5.6.0 will automatically identify and register the service provider.

If you are using an older version of Laravel, add the package service provider to your config/app.php file, in the 'providers' array:
```php
'providers' => [
    //...
    PerfectOblivion\Services\ResponderServiceProvider::class,
    //...
];
```

Then, run:
```bash
php artisan vendor:publish
```
and choose the PerfectOblivion/Responders option.

This will copy the package configuration (responders.php) to your 'config' folder.
Here, you can set the root namespace for your Responder classes:

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Namespace
    |--------------------------------------------------------------------------
    |
    | Set the namespace for the Responders.
    |
 */

    'namespace' => 'Http\\Responders'
];
```

## Usage

To begin using PerfectOblivion/Responders, simply follow the instructions above, then generate your Responder classes as needed.
To generate an IndexResponder for Posts, as in the example above, enter the following command into your terminal:

```bash
php artisan adr:responder Post\\IndexResponder
```

Then add the responder as a dependency to your controller. Simply return the responder in your action. If you have data to pass to the responder, call the ```withPayload()``` method and pass the data:

```php
public function index(Request $request)
{
    $data = MyDatasource::getSomeData();

    // return $this->responder;
    return $this->responder->withPayload($data);
}

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email clay@phpstage.com instead of using the issue tracker.

## Roadmap

We plan to work on flexibility/configuration soon, as well as release a framework agnostic version of the package.

## Credits

- [Clayton Stone](https://github.com/devcircus)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
