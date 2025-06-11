# Best4u Backend module for Magento 2

A base Magento 2 backend module designed to serve as the foundation for all other Best4u Magento 2 extensions.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Uninstallation](#uninstallation)
- [Support](#support)

## Requirements

- Magento 2.4.5 or later
- PHP 7.4 or 8.x
- Composer 2.x

## Installation

Install the module via Composer:

1. Add the repository to your Composer configuration:
```bash
composer config repositories.best4u-backend vcs [repository-url]
```
2. Require the module (without updating immediately):
```bash
composer require best4u/module-backend --no-update
```
3. Update Composer dependencies:
```bash
composer update best4u/module-backend
```
4. Enable the module in Magento:
```bash
bin/magento module:enable Best4u_Backend
```
5. Run the upgrade and deploy commands:
```bash
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento setup:static-content:deploy -f -s standard
bin/magento cache:flush
```

## Usage

Once enabled, downstream modules can declare `Best4u_Backend` as a dependency in their `module.xml`:
```bash
<sequence>
    <module name="Best4u_Backend"/>
</sequence>
```

## Uninstallation

To remove the module, run the following commands:

```bash
bin/magento module:disable Best4u_Backend
composer remove best4u/module-backend
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento setup:static-content:deploy -f -s standard
bin/magento cache:flush
```

## Support

For questions, bug reports, or contributions, please contact us at [magento@best4u.nl](mailto:magento@best4u.nl) or open an issue in the repository.
