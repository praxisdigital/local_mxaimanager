# Changelog

## 1.1.3 (2026111600)

### Fixed
- `classes/app/collection.php`: check cursor validity without passing null to `array_key_exists()`. Preserve zero/empty-string keys and null values.
- Add database-free iterator boundary regression coverage.

Refs praxisdigital/moodle-opgaver#1089. Targets the approved Moodle 5.0 stable; dependencies unchanged.
