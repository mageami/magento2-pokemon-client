# Pokemon API Client
The module is a client API providing a connection to the Pokemon API

### Version
1.0.0

### Compatibility
- Magento Open Source 2.4.3, 2.4.4
- Magento Commerce 2.4.3, 2.4.4
- Not tested on other versions

### Installation

The recommended way to install this extension is via composer:

```shell
composer config repositories.mageami-pokemon-client git git@github.com:mageami/magento2-pokemon-client.git
composer require mageami/magento2-pokemon-client:dev-master
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento c:cl
php bin/magent c:fl
```

### Configuration

The extension functionality is disabled by default.

To enable it and configure your Identity Provider, visit the `Stores > Configuration > Services > Pokemon` section in the Magento backend.

#### Change log

##### 10.03.2024 1.0.0
- Init repository
