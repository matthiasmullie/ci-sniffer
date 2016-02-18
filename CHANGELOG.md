# Changelog


## [1.2.0] - 2016-02-18
### Added
- Report commit author & email address
- Report previous commit

### Changed
- Removed duplicate code by letting all providers inherit from fallback class
- Changed binary's JSON key 'pr' to 'pull-request'

### Fixed
- Don't cause errors when file required for PR testing doesn't exist


## [1.1.0] - 2016-02-17
### Changed
- Renamed project to ci-sniffer
- Renamed bin/ci-environment to ci-sniffer


## [1.0.2] - 2016-02-16
### Added
- Detects Drone
- Detects Snap CI
- Report pull request number

### Fixed
- Don't show any branch when on PR
- Don't print error output when not in git repo


## [1.0.1] - 2016-02-12
### Added
- Detects Wercker
- Detects Shippable
- Detects Appveyor
- Add bin/ci-environment, which outputs data as json
- Report repo slug


## [1.0.0] - 2016-02-11
### Added
- Report provider, repo url, branch, commit & build
- Detects Travis CI
- Detects Circle CI
- Detects Codeship
- Detects Jenkins


[1.0.0]: https://github.com/matthiasmullie/ci-sniffer/compare/ab538de31ace283fcbe74e4d66a67d0c229af5a1...1.0.0
[1.0.1]: https://github.com/matthiasmullie/ci-sniffer/compare/1.0.0...1.0.1
[1.0.2]: https://github.com/matthiasmullie/ci-sniffer/compare/1.0.1...1.0.2
[1.1.0]: https://github.com/matthiasmullie/ci-sniffer/compare/1.0.2...1.1.0
[1.2.0]: https://github.com/matthiasmullie/ci-sniffer/compare/1.1.0...1.2.0
