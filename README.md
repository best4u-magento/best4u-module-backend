# Best4u Backend module for Magento 2

A base Magento 2 backend module designed to serve as the foundation for all other Best4u Magento 2 extensions.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Uninstallation](#uninstallation)
- [Support](#support)

## Features

- **Best4u** top-level menu in the Admin Panel (with the Best4u logo icon) that other Best4u extensions add their menu items to; the menu is hidden automatically when it has no items the current admin user is allowed to see
- **Best4u Extensions** configuration tab under *Stores > Configuration* that other Best4u extensions add their sections to
- **Best4u** root ACL resource
- *Best4u Backend* icon font used for the menu and configuration tab icons

## Requirements

- Magento Open Source / Adobe Commerce 2.4.4 – 2.4.9
- PHP 8.1, 8.2, 8.3, 8.4 or 8.5 (within the range supported by your Magento version)
- Composer 2.2 or later

## Installation

Install the module via Composer:

1. Add the repository to your Composer configuration:
```bash
composer config repositories.best4u-module-backend vcs https://github.com/best4u-magento/best4u-module-backend.git
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

Once enabled, downstream modules declare the dependency in their `composer.json`:
```json
"require": {
    "best4u/module-backend": "^1.0"
}
```
and in their `etc/module.xml`:
```xml
<sequence>
    <module name="Best4u_Backend"/>
</sequence>
```

The module provides the following identifiers for downstream modules:

| Element | Identifier | Used in |
|---|---|---|
| Admin menu root | `Best4u::best4u_elements` | `parent` attribute in `etc/adminhtml/menu.xml` |
| Configuration tab | `best4u` | `<tab>` element of a section in `etc/adminhtml/system.xml` |
| ACL root resource | `Best4u_Backend::admin` | `etc/acl.xml` |

Example menu item in a downstream module (`etc/adminhtml/menu.xml`):
```xml
<add id="Vendor_Module::config" title="My Extension" translate="title" module="Vendor_Module"
     sortOrder="10" parent="Best4u::best4u_elements" action="adminhtml/system_config/edit/section/my_section"
     resource="Vendor_Module::config"/>
```

Example configuration section in a downstream module (`etc/adminhtml/system.xml`):
```xml
<section id="my_section" translate="label" sortOrder="10" showInDefault="1" showInWebsite="1" showInStore="1">
    <label>My Extension</label>
    <tab>best4u</tab>
    <resource>Vendor_Module::config</resource>
</section>
```

The **Best4u** menu is only displayed when it contains at least one menu item that is enabled and allowed for the current admin user (ACL); otherwise it is hidden automatically. The **Best4u Extensions** tab is likewise only displayed by Magento once at least one section is assigned to it.

## Uninstallation

Other Best4u extensions depend on this module, so remove them first. Then run the following commands:

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
