Change Log: `yii2-date-range`
=============================

## Version 1.6.5

**Date:** 22-Oct-2015

- (enh #52): New property `autoUpdateOnInit` to prevent plugin triggering change due to `pluginOptions['autoUpdateInput']` default setting.
- (enh #53): Added correct German translations.

## Version 1.6.4

**Date:** 19-Oct-2015

- (enh #41): Add Simplified Chinese translations.
- (enh #43): Add Slovak translations.
- (enh #51): Update to latest release of bootstrap-datarangepicker plugin.

## Version 1.6.3

**Date:** 22-May-2015

- (enh #31): Add Ukranian translations.
- (enh #32): Add Portugese translations.
- (enh #36): Add Polish translations.
- (enh #38): Update to latest release of bootstrap-datarangepicker plugin.
- (enh #40): Update moment library and locales.

## Version 1.6.2

**Date:** 02-Mar-2015

- (enh #27): Correct initial value initialization for all cases.
- (enh #28): Upgrade to latest release of bootstrap-daterangepicker plugin.
- Set copyright year to current.
- (enh #29): Improve validation to retrieve the right translation messages folder.

## Version 1.6.1

**Date:** 16-Feb-2015

- (enh #27): Correct initial value initialization for all cases.
- (enh #28): Upgrade to latest release of bootstrap-daterangepicker plugin.
- Set copyright year to current.

## Version 1.6.0

**Date:** 12-Jan-2015

- (enh #22): Estonian translation for kvdrp.php
- (enh #23): Russian translations updated.
- Code formatting updates as per Yii2 standards.
- Revamp to use new Krajee base InputWidget and TranslationTrait.

## Version 1.5.0

**Date:** 29-Nov-2014

- (enh #20): Enhance language locale file parsing and registering
    - Remove `_localeLang` property
    - Rename `locale` folder to `locales` to be consistent with `datepicker` and `datetimepicker` plugins
    - Utilize enhancements in krajee base [enh #9](https://github.com/kartik-v/yii2-krajee-base/issues/9) and  [enh #10 ](https://github.com/kartik-v/yii2-krajee-base/issues/10) 
    - Update `LanguageAsset` for new path

## Version 1.4.0

**Date:** 25-Nov-2014

- (enh #17): Updated Russian translations
- (bug #18): Plugin data attributes not set because of input rendering sequence.
- (enh #19): Enhance widget to use updated plugin registration from Krajee base 

## Version 1.3.0

**Date:** 21-Nov-2014

- (enh #7): Added Russian Translations
- (enh #12): Added Spanish Translations
- (enh #13): Update moment.js related range initializations.
- (enh #14): Update moment library to latest release.
- (enh #15): Revamp widget to remove dependency on custom locale JS files enhancement
- (enh #16): Update Lithunian translations and create German translations.

## Version 1.2.0

**Date:** 20-Nov-2014

- (bug #11): Fix bug in daterangepicker.js for duplicate dates in Dec 2013.
- Upgrade to latest plugin release 1.3.16 dated 12-Nov-2014.

## Version 1.1.0

**Date:** 10-Nov-2014

- PSR4 alias change
- Set dependency on Krajee base components
- Set release to stable

## Version 1.0.0

**Date:** 09-May-2014

- Initial release