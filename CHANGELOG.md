# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [7.0.2]
### Changed
- Stubs by [@regnerisch](https://github.com/regnerisch)

## [7.0.1]
### Changed
- Changelog by [@regnerisch](https://github.com/regnerisch)

## [7.0.0]
### Added
- Universal usable `--global` flag by [@regnerisch](https://github.com/regnerisch)

### Fixed
- Access before initialization by [@regnerisch](https://github.com/regnerisch) in [#100](https://github.com/akrillia/laravel-beyond/issues/100) reported by [@napruzzese](https://github.com/napruzzese)

### Changed
- Refactor directory structure, tests and much more by [@regnerisch](https://github.com/regnerisch)

### Removed
- Removed Commands: `beyond:make:app`, `beyond:make:middleware`, `beyond:make:migration`, `beyond:make:notification`, `beyond:publish:deptrac` by [@regnerisch](https://github.com/regnerisch)

## [7.0.0-beta.7]
### Changed
- Change directory structure back to v6, as it seems to be a better one by [@regnerisch](https://github.com/regnerisch)

## [7.0.0-beta.6]
### Added
- Add missing changes in CHANGELOG.md by [@regnerisch](https://github.com/regnerisch)

### Changed
- Change module selection by [@regnerisch](https://github.com/regnerisch)

## [7.0.0-beta.5]
### Added
- Add tests by [@alexanderkroneis](https://github.com/alexanderkroneis)
- Add windows tests by [@alexanderkroneis](https://github.com/alexanderkroneis) in [#98](https://github.com/akrillia/laravel-beyond/pull/98)
- Add deptrac config and publish command by [@regnerisch](https://github.com/regnerisch) [#38](https://github.com/akrillia/laravel-beyond/issues/38)
- Add `MakeTestCommand` by [@regnerisch](https://github.com/regnerisch) [#92](https://github.com/akrillia/laravel-beyond/issues/92)
- Add documentation to repository by [@regnerisch](https://github.com/regnerisch) [#34](https://github.com/akrillia/laravel-beyond/issues/34)

### Fixed
- Fix wrong use statement by [@regnerisch](https://github.com/regnerisch) [#94](https://github.com/akrillia/laravel-beyond/issues/94)

### Changed
- Rename `DataTransferObjects` to `DataObjects` by [@alexanderkroneis](https://github.com/alexanderkroneis) in [#97](https://github.com/akrillia/laravel-beyond/pull/97)

### Removed
- Support for php8.1 by [@regnerisch](https://github.com/regnerisch)

## [7.0.0-beta.4]
### Added
- Add `beyond:make:migration` command by [@regnerisch](https://github.com/regnerisch)
- Add [phpstan](https://github.com/phpstan/phpstan) and fix errors by [@regnerisch](https://github.com/regnerisch)
- Add support for additional directories `beyond:make:controller User.Admin/UserController` by [@regnerisch](https://github.com/regnerisch)

### Fixed
- Fix module choice attempts by [@regnerisch](https://github.com/regnerisch)

### Changed
- Replace `pest` with `phpunit` by [@regnerisch](https://github.com/regnerisch)
- Changed `beyond:make:{command} Module/ClassName` to `beyond:make:{command} Module.ClassName` to support directories by [@regnerisch](https://github.com/regnerisch)

## [7.0.0-beta.3]
### Changed
- Update dependencies by [@regnerisch](https://github.com/regnerisch)

## [7.0.0-beta.2]
### Added
- Add alias for `beyond:make:dto` by [@regnerisch](https://github.com/regnerisch)

### Fixed
- Fixed some messages by [@regnerisch](https://github.com/regnerisch)

### Changed
- Swap deprecated rule interface by [@regnerisch](https://github.com/regnerisch)
- Swap default behaviour on `beyond:make:module` by [@regnerisch](https://github.com/regnerisch)

## [7.0.0-beta.1]

## [6.0.1] - 2023-02-22

## [6.0.0] - 2023-02-22
### Added
- Laravel 10.x support by [@regnerisch](https://github.com/regnerisch)

### Removed
- Laravel-Command-Hooks Dependency by [@regnerisch](https://github.com/regnerisch)

## [5.4.1] - 2023-01-10
### Added
- Preparation for Laravel 10 by [@alexgaal](https://github.com/alexgaal)

## [5.3.2] - 2023-01-10
### Fixed
- Wrong namespace in UPGRADE.md by [@alexgaal](https://github.com/alexgaal)
- Used wrong function of `Schema` when creating a migration by [@alexgaal](https://github.com/alexgaal) 

## [5.3.1] - 2022-12-11
### Added
- Add test for PHP 8.2 to ensure compatibility by [@alexgaal](https://github.com/alexgaal)

## [5.2.1] - 2022-11-30
### Fixed
- Old if conditions in MakeControllerCommand by [@bleakprestiger](https://github.com/bleakprestiger)

## [5.2.0] - 2022-11-28
### Added
- Observer Command by [@krishnahimself](https://github.com/krishnahimself)
- Notification Command by [@alexgaal](https://github.com/alexgaal)

## [5.1.0] - 2022-11-25
### Added
- Trait Command by [@dimzeta](https://github.com/dimzeta)

### Fixed
- Factory stub in README.md by [@krishnahimself](https://github.com/krishnahimself)
- Improved install instructions in README.md by [@Wulfheart](https://github.com/Wulfheart)

## [5.0.0] - 2022-11-16
### Fixed
- Fix missing links in CHANGELOG.md by [@regnerisch](https://github.com/regnerisch)

### Changed
- Changed namespace from `Regnerisch` to `AkrilliA` by [@regnerisch](https://github.com/regnerisch)
- Changed package name from `regnerisch/laravel-beyond` to `akrillia/laravel-beyond` by [@regnerisch](https://github.com/regnerisch)

## [4.0.1] - 2022-09-26
### Fixed
- Fix `migration` and `factory` shortcut flags by [@krishnahimself](https://github.com/krishnahimself) in [#73](https://github.com/akrillia/laravel-beyond/pull/73)

## [4.0.0] - 2022-09-23
### Added
- `MakeDataTransferObjectFactoryCommand` by [@regnerisch](https://github.com/regnerisch) reported by [@thewebartisan7](https://github.com/thewebartisan7) in [#58](https://github.com/akrillia/laravel-beyond/pull/58)
- Extend the default `Controller` of Laravel by [@regnerisch](https://github.com/regnerisch) reported by [@thewebartisan7](https://github.com/thewebartisan7) in [#63](https://github.com/akrillia/laravel-beyond/issues/63)
- UPGRADE.md by [@alexgaal](https://github.com/alexgaal)

### Changed
- Reset folder structure by [@regnerisch](https://github.com/regnerisch) reported by [@thewebartisan7](https://github.com/thewebartisan7) in [#56](https://github.com/akrillia/laravel-beyond/issues/56)
- Use `regnerisch/laravel-command-hooks` instead of custom `BaseCommand` by [@regnerisch](https://github.com/regnerisch)
- Rename `--overwrite` to `--force` to be more Laravel compatible by [@regnerisch](https://github.com/regnerisch)

### Fixed
- Fix commands not autoloaded by [@regnerisch](https://github.com/regnerisch) reported by [@dimzeta](https://github.com/dimzeta) in [#66](https://github.com/akrillia/laravel-beyond/issues/66)

## [3.2.1] - 2022-09-22
### Added
- Missing contributor by [@regnerisch](https://github.com/regnerisch)

## [3.2.0] - 2022-09-22
### Added
- `invokable` flag on `MakeControllerCommand` by [@dimzeta](https://github.com/dimzeta) in [#67](https://github.com/akrillia/laravel-beyond/pull/67)

### Fixed
- Fix some CHANGELOG typos and links by [@regnerisch](https://github.com/regnerisch)

## [3.1.1] - 2022-09-15
### Changed
- Use FQN instead of classname in `SetupCommand` output by [@Wulfheart](https://github.com/Wulfheart) in [#70](https://github.com/akrillia/laravel-beyond/pull/70)

## [3.1.0] - 2022-09-01
### Added
- Queueable Actions by [@thewebartisan7](https://github.com/thewebartisan7) in [#64](https://github.com/akrillia/laravel-beyond/pull/64)

### Changed
- Change changelog schema from "Conventional changelog" to "Keep a changelog" by [@regnerisch](https://github.com/regnerisch)

### Fixed
- Drop table in `down` method by [@thewebartisan7](https://github.com/thewebartisan7) in [#55](https://github.com/akrillia/laravel-beyond/pull/55)

### Removed
- Remove auto generation of changelog in release it by [@regnerisch](https://github.com/regnerisch)

[Unreleased]: https://github.com/regnerisch/laravel-beyond/compare/v7.0.2...HEAD
[7.0.1]: https://github.com/regnerisch/laravel-beyond/compare/v7.0.1...v7.0.2
[7.0.1]: https://github.com/regnerisch/laravel-beyond/compare/v7.0.0...v7.0.1
[7.0.0]: https://github.com/regnerisch/laravel-beyond/compare/v7.0.0-beta.7...v7.0.0
[7.0.0-beta.7]: https://github.com/regnerisch/laravel-beyond/compare/v7.0.0-beta.6...v7.0.0-beta.7
[7.0.0-beta.6]: https://github.com/regnerisch/laravel-beyond/compare/v7.0.0-beta.5...v7.0.0-beta.6
[7.0.0-beta.5]: https://github.com/regnerisch/laravel-beyond/compare/v7.0.0-beta.4...v7.0.0-beta.5
[7.0.0-beta.4]: https://github.com/regnerisch/laravel-beyond/compare/v7.0.0-beta.3...v7.0.0-beta.4
[7.0.0-beta.3]: https://github.com/regnerisch/laravel-beyond/compare/v7.0.0-beta.2...v7.0.0-beta.3
[7.0.0-beta.2]: https://github.com/regnerisch/laravel-beyond/compare/v7.0.0-beta.1...v7.0.0-beta.2
[7.0.0-beta.1]: https://github.com/regnerisch/laravel-beyond/compare/v6.0.1...v7.0.0-beta.1
[6.0.1]: https://github.com/regnerisch/laravel-beyond/compare/v6.0.0...v6.0.1
[6.0.0]: https://github.com/regnerisch/laravel-beyond/compare/v5.4.1...v6.0.0
[5.4.1]: https://github.com/regnerisch/laravel-beyond/compare/v5.3.2...v5.4.1
[5.3.2]: https://github.com/regnerisch/laravel-beyond/compare/v5.3.1...v5.3.2
[5.3.1]: https://github.com/regnerisch/laravel-beyond/compare/v5.3.0...v5.3.1
[5.3.0]: https://github.com/regnerisch/laravel-beyond/compare/v5.2.1...v5.3.0
[5.2.1]: https://github.com/regnerisch/laravel-beyond/compare/v5.2.0...v5.2.1
[5.2.0]: https://github.com/regnerisch/laravel-beyond/compare/v5.1.0...v5.2.0
[5.1.0]: https://github.com/regnerisch/laravel-beyond/compare/v5.0.0...v5.1.0
[5.0.0]: https://github.com/regnerisch/laravel-beyond/compare/v4.0.1...v5.0.0
[4.0.1]: https://github.com/regnerisch/laravel-beyond/compare/v4.0.0...v4.0.1
[4.0.0]: https://github.com/regnerisch/laravel-beyond/compare/v3.2.1...v4.0.0
[3.2.1]: https://github.com/regnerisch/laravel-beyond/compare/v3.2.0...v3.2.1
[3.2.0]: https://github.com/regnerisch/laravel-beyond/compare/v3.1.1...v3.2.0
[3.1.1]: https://github.com/regnerisch/laravel-beyond/compare/v3.1.0...v3.1.1
[3.1.0]: https://github.com/regnerisch/laravel-beyond/compare/v3.0.0...v3.1.0
[3.0.0]: https://github.com/regnerisch/laravel-beyond/compare/v2.0.0...v3.0.0
[2.0.0]: https://github.com/regnerisch/laravel-beyond/compare/v1.0.0...v2.0.0
