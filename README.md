# Tealium Integration for PHP

[![Build Status](https://travis-ci.org/TimeIncOSS/tealium-bundle.svg?branch=master)](https://travis-ci.org/TimeIncOSS/tealium-bundle)

This bundle provides Tealium integration for Symfony2 and Symfony3 using
the [`timeinc/tealium`](https://github.com/TimeIncOSS/tealium-php) package.

## Installation

### Composer
```bash
composer require timeinc/tealium-bundle
```

### Enable in AppKernel.php
```php
$bundles = [
    // ...
    new TimeInc\TealiumBundle\TimeIncTealiumBundle(),
];
```

## Configuration
```yml
# app/config/config.yml
time_inc_tealium:
    organisation: organisation-name # Required
    app: tealium-application        # Required
    environment: prod               
    udo:
        namespace: utag_data
        defaults: []                # Array of any variables to add as utag_data defaults
```

## Usage

### Controller
To use configure the UDO in the service, you can call the `timeinc.tealium` service:
```php
<?php

class DemoController extends Controller {
    public function demoAction(){
        $tealium = $this->get('timeinc.tealium');
        $udo = $tealium->getUdo();
        
        // use $udo->properties to add data to the UDO object
        $udo->properties['site'] = 'My Site';
    }
}
```

### Twig
To render Tealium onto the page, use the `tealium()` twig function:
 
```twig
<html>
    <head>
    </head>
    <body>
        {{ tealium() }}
    </body>
</html>
```
