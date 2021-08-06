# Best4u module backend for Magento 2
## Installation
1. Login to the server via SSH client
2. Go to Magento `root` directory
3. Run the following commands:
```bash
composer config repositories.best4u-backend vcs [bitbucket-repository-url]
```
```bash
composer require best4u/module-backend=1.0.1 --no-update
```
```bash
composer update
```
```bash
php bin/magento module:enable Best4u_Backend
```
```bash
php bin/magento setup:upgrade
```
```bash
php bin/magento setup:static-content:deploy
```