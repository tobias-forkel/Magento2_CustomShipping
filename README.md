# Magento2 CustomShipping
This Magento 2 module allows you to provide a custom shipping method in backend only, frontend only or both. In the following screenshots you can see an example `Free - August Special` for `$0.00` in the backend and frontend.

![Magento2 CustomShipping - Backend - Configuration](http://www.tobiasforkel.de/public/magento/forkel_customshipping/2/version/1.0.0/screenshots/github/backend/config.jpg)

![Magento2 CustomShipping - Backend - Order](http://www.tobiasforkel.de/public/magento/forkel_customshipping/2/version/1.0.0/screenshots/github/backend/order.jpg)

![Magento2 CustomShipping - Frontend - Order](http://www.tobiasforkel.de/public/magento/forkel_customshipping/2/version/1.0.0/screenshots/github/frontend/cart.jpg)

## Installation (Composer)

1. Add this extension to your repository `composer config repositories.tobias-forkel/magento2-customshipping vcs https://github.com/tobias-forkel/Magento2_CustomShipping.git`
2. Update your composer.json `composer require "tobias-forkel/magento2-customshipping":"*"`

```
./composer.json has been updated
Loading composer repositories with package information
Updating dependencies (including require-dev)              
Package operations: 1 install, 0 updates, 0 removals
  - Installing tobias-forkel/magento2-customshipping (1.0.0): Downloading (100%)         
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
===== 1.0.0 =====
* Stable version of this module

## License
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)