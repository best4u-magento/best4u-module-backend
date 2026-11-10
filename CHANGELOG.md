# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.1] - 2026-11-10

### Changed
- Changed the `license` in `composer.json` from `OSL-3.0`/`AFL-3.0` to `proprietary`.
- Added a License section to `README.md`.

### Removed
- Removed the obsolete `setup_version` attribute from `etc/module.xml`. The module has no database setup scripts; Magento 2.3+ treats modules without `setup_version` as up to date.

## [1.1.0] - 2026-11-10

### Added
- The **Best4u** admin menu is now hidden when it has no child items that are enabled and allowed for the current admin user, instead of being displayed as an empty menu (plugin `Best4u\Backend\Plugin\Backend\Model\Menu\ItemPlugin` on `Magento\Backend\Model\Menu\Item::isDisabled()`, adminhtml area only).
- Added unit tests for the menu plugin.
- Declared compatibility with Magento Open Source / Adobe Commerce 2.4.4 – 2.4.9.
- Declared compatibility with PHP 8.1, 8.2, 8.3, 8.4 and 8.5.
- Added missing dependencies to `composer.json`: `magento/framework` (used by `registration.php`) and `magento/module-config` (the `system.xml` configuration tab uses its schema).
- Added `authors` section to `composer.json`.
- Documented the menu, configuration tab and ACL identifiers for downstream modules in `README.md`.

### Changed
- Replaced the open `php: >=7.2.0` constraint with `~8.1.0||~8.2.0||~8.3.0||~8.4.0||~8.5.0`.
- Replaced the wildcard `magento/module-backend: *` constraint with `~102.0.4` (Magento 2.4.4 – 2.4.9).
- Fixed `composer.json` formatting (tab indentation mixed with spaces) and normalized its line endings to LF.
- Updated `README.md`: supported versions, real repository URL, features list, correct code-block languages, uninstall note.
- Verified with PHPCS (Magento2 standard) and PHPStan (level max) with no reported issues; verified that the LESS compiles against the Magento UI library.

## [1.0.12] - 2025-06-11

### Added
- Added a complete and properly structured `README.md` file with installation and usage instructions.
- Added a `CHANGELOG.md` file following the Keep a Changelog format.

### Changed
- Migrated the repository from Bitbucket to GitHub.

## [1.0.11] - 2025-02-20

### Changed
- Refactored code to comply with Magento 2 coding standards based on PHPCS and PHPMD validation results.

## [1.0.10] - 2024-03-05

### Added
- Introduced custom icon font (`Best4u Backend`) for admin styling.

## [1.0.9] - 2024-02-15

### Added
- Dependency on `Magento_Backend` module.

## [1.0.8] - 2024-02-12

### Added
- Compatibility with more PHP versions.

## [1.0.7] - 2023-03-09

### Changed
- Refactored code to comply with Magento 2 coding standards based on PHPCS and PHPMD validation results.

## [1.0.6] - 2023-03-09

### Added
- Compatibility with PHP versions 7.4 and 8.1

### Changed
- Refactored code to comply with Magento 2 coding standards based on PHPCS and PHPMD validation results.

## [1.0.5] - 2022-12-14

### Changed
- Changed the `Best4u` menu tab sort order.
- Replaced the configuration tab image `best4u-media-logo.svg` with `Best4u Extensions`.

## [1.0.4] - 2022-12-09

### Changed
- Corrected `psr-4` autoload namespace from `Magento\Backend\` to `Best4u\Backend\` in `composer.json` to reflect the actual module structure and ensure proper autoloading.
- Changed the `Best4u` menu tab sort order.
- Replaced the `Best4u Media B.V.` configuration tab with an image `best4u-media-logo.svg`.

## [1.0.3] - 2022-12-07

### Added
- Added a short description of the module in `composer.json` file.
- Compatibility with more PHP versions.

### Changed
- Changed the name of the configuration tab in Admin Panel from `Best4u Group B.V.` to `Best4u Media B.V.`.

## [1.0.2] - 2022-07-14

### Changed
- Updated copyright notice in all files from `Best4u Development` to `Best4u Media B.V.` to reflect the correct legal entity.

## [1.0.1] - 2021-08-06

### Added
- Included `Best4u` menu tab and `Best4u Group B.V.` configuration tab in Admin Panel.

## [1.0.0] - 2020-11-06

### Added
- Initial release of the Best4u Backend module for Magento 2.
- Composer-ready installation method.
- Basic README with installation instructions.
