# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [5.0.0] - 2026-06-02

### Added
- Support for October CMS 4.1 and higher

### Changed
- Minimum required PHP version is now 8.2 (Glide v3 requirement)
- Bump `october/rain` to `^4.1`
- Bump `league/glide` to `^3.0` (Glide v3, intervention/image v3)
- Bump `league/glide-symfony` to `^2.1` (first stable release allowing Glide v3)

### Removed
- Support for October CMS 3.x and 4.0

## [4.0.0] - 2025-08-20

### Added
- Support for October CMS 4.x

### Changed
- Minimum required PHP version is now 8.0.2 (requires the `ext-exif` extension)

### Removed
- Support for October CMS 2.x

## [3.2.0] - 2022-05-27

### Added
- Support for October CMS 3.0

## [3.1.0] - 2022-03-05

### Added
- `.gitattributes` file
- Version constraint for `october/system`

### Changed
- October CMS 2.x is now required
- Update composer version constraints for the `composer/installers` package

## [3.0.1] - 2021-07-21

### Added
- Missing CHANGELOG file

## [3.0.0] - 2021-07-06

### Added
- Sign Key implementation (add `GLIDE_SIGN_KEY` to your `.env`)

### Changed
- Improved plugin documentation

### Removed
- Support for PHP 7.1 (minimum required PHP version is now 7.4)

## [2.0.0] - 2021-05-28

### Changed
- October Build 1.1.0 is now required
- Make the plugin Laravel 6 compatible

## [1.1.0] - 2019-03-22

### Changed
- Move thumbnail generation logic to a (re-usable) helper

## [1.0.1] - 2019-01-25

### Fixed
- Catch exception when a file cannot be found or an image could not be created

## [1.0.0] - 2019-01-22

### Added
- First version of Vdlp.Glide
