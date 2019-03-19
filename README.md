infra-sdk
=========

A set of practical utilities to use in your custom PHP-based [infra](https://github.com/linkorb/infra) scripts.

### query

```php
$data = \Infra\Sdk\Utils::query($graphql); // executes `infra query` and returns the response as an array
```

### getArguments

You can let Infra SDK parse your command line arguments against a [docopt](http://docopt.org/) definition.

Simply include a file with the exact same name as your script, but with a ".md" file extension, and Infra SDK will extract the docopt definition and parse your command line arguments.

```php
$arguments = \Infra\Sdk\Utils::getArguments(); 
```

## License

MIT. Please refer to the [license file](LICENSE) for details.

## Brought to you by the LinkORB Engineering team

<img src="http://www.linkorb.com/d/meta/tier1/images/linkorbengineering-logo.png" width="200px" /><br />
Check out our other projects at [linkorb.com/engineering](http://www.linkorb.com/engineering).

Btw, we're hiring!

