# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Fixed
- Fix missing links in CHANGELOG.md by [@regnerisch](https://github.com/regnerisch)

## [4.0.1] - 2022-09-26
### Fixed
- Fix `migration` and `factory` shortcut flags by [@krishnahimself](https://github.com/krishnahimself) in [#73](https://github.com/regnerisch/laravel-beyond/pull/73)

## [4.0.0] - 2022-09-23
### Added
- `MakeDataTransferObjectFactoryCommand` by [@regnerisch](https://github.com/regnerisch) reported by [@thewebartisan7](https://github.com/thewebartisan7) in [#58](https://github.com/regnerisch/laravel-beyond/pull/58)
- Extend the default `Controller` of Laravel by [@regnerisch](https://github.com/regnerisch) reported by [@thewebartisan7](https://github.com/thewebartisan7) in [#63](https://github.com/regnerisch/laravel-beyond/issues/63)
- UPGRADE.md by [@alexgaal](https://github.com/alexgaal)

### Changed
- Reset folder structure by [@regnerisch](https://github.com/regnerisch) reported by [@thewebartisan7](https://github.com/thewebartisan7) in [#56](https://github.com/regnerisch/laravel-beyond/issues/56)
- Use `regnerisch/laravel-command-hooks` instead of custom `BaseCommand` by [@regnerisch](https://github.com/regnerisch)
- Rename `--overwrite` to `--force` to be more Laravel compatible by [@regnerisch](https://github.com/regnerisch)

### Fixed
- Fix commands not autoloaded by [@regnerisch](https://github.com/regnerisch) reported by [@dimzeta](https://github.com/dimzeta) in [#66](https://github.com/regnerisch/laravel-beyond/issues/66)

## [3.2.1] - 2022-09-22
### Added
- Missing contributor by [@regnerisch](https://github.com/regnerisch)

## [3.2.0] - 2022-09-22
### Added
- `invokable` flag on `MakeControllerCommand` by [@dimzeta](https://github.com/dimzeta) in [#67](https://github.com/regnerisch/laravel-beyond/pull/67)

### Fixed
- Fix some CHANGELOG typos and links by [@regnerisch](https://github.com/regnerisch)

## [3.1.1] - 2022-09-15
### Changed
- Use FQN instead of classname in `SetupCommand` output by [@Wulfheart](https://github.com/Wulfheart) in [#70](https://github.com/regnerisch/laravel-beyond/pull/70)

## [3.1.0] - 2022-09-01
### Added
- Queueable Actions by [@thewebartisan7](https://github.com/thewebartisan7) in [#64](https://github.com/regnerisch/laravel-beyond/pull/64)

### Changed
- Change changelog schema from "Conventional changelog" to "Keep a changelog" by [@regnerisch](https://github.com/regnerisch)

### Fixed
- Drop table in `down` method by [@thewebartisan7](https://github.com/thewebartisan7) in [#55](https://github.com/regnerisch/laravel-beyond/pull/55)

### Removed
- Remove auto generation of changelog in release it by [@regnerisch](https://github.com/regnerisch)

[Unreleased]: https://github.com/regnerisch/laravel-beyond/compare/v4.0.1...HEAD
[4.0.1]: https://github.com/regnerisch/laravel-beyond/compare/v4.0.0...v4.0.1
[4.0.0]: https://github.com/regnerisch/laravel-beyond/compare/v3.2.1...v4.0.0
[3.2.1]: https://github.com/regnerisch/laravel-beyond/compare/v3.2.0...v3.2.1
[3.2.0]: https://github.com/regnerisch/laravel-beyond/compare/v3.1.1...v3.2.0
[3.1.1]: https://github.com/regnerisch/laravel-beyond/compare/v3.1.0...v3.1.1
[3.1.0]: https://github.com/regnerisch/laravel-beyond/compare/v3.0.0...v3.1.0
[3.0.0]: https://github.com/regnerisch/laravel-beyond/compare/v2.0.0...v3.0.0
[2.0.0]: https://github.com/regnerisch/laravel-beyond/compare/v1.0.0...v2.0.0
