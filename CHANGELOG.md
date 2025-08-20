# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [4.0.0] - 2025-08-20

- Add support for October CMS 4.x
- Minimal version of PHP required is 8.0.2
  - Requires `ext-exif` extension
- Remove support for October CMS 2.x

## [3.2.0] - 2022-05-27

- Add support for October CMS 3.0

## [3.1.0] - 2022-03-05

- __!!! October 2.x required__
- Add .gitattributes file.
- Update composer version constraints for composer/installers package.
- Add version constraint for october/system.

## [3.0.1] - 2021-07-21

### Added
- Add missing CHANGELOG file.

## [3.0.0] - 2021-07-06

### Added
- Add Sign Key implementation (please add `GLIDE_SIGN_KEY` to your `.env`)

### Changed
- Improved plugin documentation.

### Removed
- Drop support for PHP 7.1 (minimum required PHP version 7.4)

## [2.0.0] - 2021-05-28

- __!!! October Build 1.1.0 required__
- Make laravel 6 compatible.

## [1.1.0] - 2019-03-22

- Move thumbnail generation logic to a (re-usable) Helper.

## [1.0.1] - 2019-01-25

- Catch exception when file cannot be found or image could not be created.

## [1.0.0] - 2019-01-22

- First version of Vdlp.Glide
