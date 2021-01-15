# Script Loader Tags

## 1.2.0 - 2020-01-15

- Added possibility for `nomodule` and `type="module"` attributes.
- Updated usage to use pipes instead of `--suffix`. Use `|async` instead of `--async` and `|defer` instead of `--defer`. The old suffixes are still supported.
- Added new function `update_script_tag()` that can be used for all cases. The `script_loader_tag_method()` can still be used, but `update_script_tag()` is recommended.
- Updated README.

## 1.1.0 - 2018-05-24

- Added function `script_loader_tag_method()` to change how an already enqueued script is loaded.
