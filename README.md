# Magento2 CustomShipping
This Magento 2 module allows you to provide a custom shipping method in backend only, frontend only or both. With the `Scheduler` feature you can manage the availability automatically. In the following screenshots you can see an example `Free - December Special` for `$0.00`.

![Magento2 CustomShipping - Intro](http://www.tobiasforkel.de/public/magento/forkel_customshipping/2/version/1.2.0/screenshots/github/intro.gif)

![Magento2 CustomShipping - Backend - Frontend](http://www.tobiasforkel.de/public/magento/forkel_customshipping/2/version/1.2.0/screenshots/github/frontend/cart.gif)

![Magento2 CustomShipping - Backend - Configuration](http://www.tobiasforkel.de/public/magento/forkel_customshipping/2/version/1.2.0/screenshots/github/backend/config_01.gif)

![Magento2 CustomShipping - Backend - Configuration](http://www.tobiasforkel.de/public/magento/forkel_customshipping/2/version/1.2.0/screenshots/github/backend/config_02.gif)

![Magento2 CustomShipping - Backend - Configuration](http://www.tobiasforkel.de/public/magento/forkel_customshipping/2/version/1.2.0/screenshots/github/backend/config_03.gif)

![Magento2 CustomShipping - Backend - Configuration](http://www.tobiasforkel.de/public/magento/forkel_customshipping/2/version/1.2.0/screenshots/github/backend/config_04.gif)

![Magento2 CustomShipping - Backend - Order](http://www.tobiasforkel.de/public/magento/forkel_customshipping/2/version/1.2.0/screenshots/github/backend/order.gif)


## Installation (Composer)

1. Add this extension to your repository `composer config repositories.tobias-forkel/magento2-customshipping vcs https://github.com/tobias-forkel/Magento2_CustomShipping.git`
2. Update your composer.json `composer require "tobias-forkel/magento2-customshipping":"1.2.1"`

```
./composer.json has been updated
Loading composer repositories with package information
Updating dependencies (including require-dev)              
Package operations: 1 install, 0 updates, 0 removals
  - Installing tobias-forkel/magento2-customshipping (1.2.1): Downloading (100%)         
Writing lock file
Generating autoload files
```

## Installation (Manually)
1. Pull the code.
2. Copy the code in `./app/code/Forkel/CustomShipping/`.
3. Enable the module and clear static content.

```
php bin/magento module:enable Forkel_CustomShipping --clear-static-content
php bin/magento setup:upgrade
```

## Features
* The option `Backend`, `Frontend` or `Backend / Frontend` allows you hide or display the custom shipping method in frontend or backend.
* The option `Customer` allows you to display the custom shipping method for logged in customers only.
* With `Scheduler` you can manage the availability automatically by using the `Start Date` or `End Date` field.
* `Frequency` allows you to enable the custom shipping method on specific weekdays only.
* With `Hide Other Shipping Methods` you can disable other shipping methods if Custom Shipping is available.
* Customizable `Method Name` and `Method Title`.
* Customizable `Price`. Default is `0.00`.

## Usage
The functionality can be used in the backend section `Stores > Configuration > Sales > Shipping Methods > Custom Shipping`.

## Support
If you have any issues with this extension, open an issue on [Github](https://github.com/tobias-forkel/Magento2_CustomShipping/issues). For a custom build, please contact me on http://www.tobiasforkel.de.

## Contributing
1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`.
3. Commit your changes: `git commit -am 'Add some feature'`.
4. Push to the branch: `git push origin my-new-feature`.
5. Submit a pull request.

Follow me on [GitHub](https://github.com/tobias-forkel) and [Twitter](https://twitter.com/tobiasforkel).

## History
===== 1.2.1 =====
* Fix composer.json

===== 1.2.0 =====
* Added new feature `Hide Other Shipping Methods` that allows you to disable other shipping methods if Custom Shipping is available.
* Code improvements

===== 1.1.0 =====
* Added new feature `Scheduler` that allows you to enable and disable automatically. You can choose between `Start Date` and `End Date`, which you can combine with `Frequency`.
* Code improvements

===== 1.0.1 =====
* Code improvements in Model\Carrier\Custom
* Added new option `Customer` that allows you to display the custom shipping method for logged in customers only.

===== 1.0.0 =====
* Stable version of this module

## License
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)