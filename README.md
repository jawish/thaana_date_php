Here is a PHP 5 class that provides a drop-in function replacement/equivalent for the built-in PHP date() function to output formatted dates in Thaana/Dhivehi. It follows the standard method of writing Gregorian dates in Thaana by using transliterations of the English month names and using the native Dhivehi names for the week days. It accepts all the usual formatting arguments permitted by the original date() function thus allowing the same degree of formatting freedom as the original.

The output returned from the function uses ASCII Thaana and, if needed, can then be converted to Unicode/UTF-8 by using the Thaana Conversions class. This class does not support Hijri dates (yet).

## Functions exposed
format()
Returns a Dhivehi date string formatted according to the given format string using the given integer timestamp

## Usage
<?php
// Load class include
require 'thaana_date.obj.php';

// Format date
$thaanatoday = Thaana_Date::format('j M Y', time());
?>

## License
The class is released under the Open Source MIT License.
