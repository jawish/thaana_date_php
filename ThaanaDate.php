<?php

// {{{ Formatting dates in Thaana

/**
 * Provides a function equivalent to the built-in PHP date() function to format dates in Thaana
 *
 * The month names used are the Thaana transliterations for the English month names while the week 
 * names are native Dhivehi.
 *
 * Functions exposed:
 * format() - Returns a string formatted according to the given format string using the given integer timestamp
 *
 * Usage:
 * $thaanatoday = ThaanaDate::format('j M Y', time());
 *
 *
 * @author Jawish Hameed
 * @link http://www.jawish.org/
 * @copyright 2008 Jawish Hameed
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @version Release: 0.1
 * @created 5 Jan 2008
 */
class ThaanaDate
{
	// {{{ format()
	
	/**
	 * Returns a ASCII thaana date formatted according to the given format string
	 *
	 * This function is meant as a direct Dhivehi replacement for PHP's date() function
	 *
	 * @param string $format		String formatting for the date
	 * @param integer $timestamp	Integer UNIX timestamp
	 * @return string				String formatted date in Dhivehi
	 */
	public static function format($format, $timestamp)
	{
		// Return blank if timestamp is invalid
		if (empty($timestamp) || !is_numeric($timestamp)) return '';
		
		// Setup months translation array
		$months = array(1 => 'jenuawrI', 2 => 'febcruawrI', 3 => 'mWCc', 
						4 => 'aEpcrilc', 5 => 'mE', 6 => 'jUnc', 
						7 => 'julwai', 8 => 'aOgwscTc', 9 => 'sepcTemcbwr', 
						10 => 'aokcTObwr', 11 => 'novemcbwr', 12 => 'Disemcbwr');
		
		// Setup week day translation array
		$dayofweek = array(	0 => 'wAdiwqta', 1 => 'hOma', 2 => 'wanqgAra', 
							3 => 'buda', 4 => 'burAsqfati', 5 => 'hukuru', 
							6 => 'honihiru');
		
		// Setup ante/post meridiem translation array
		$ampm = array('am' => 'menqdurukuri', 'pm' => 'menqdurufasq');
		
		// Split timestamp into date parts
		$dateparts = getdate($timestamp);
		
		// Construct the date in dhivehi using the formatting
		$dhivehidate = '';
		for ($i = 0; $i < strlen($format); $i++) {
			
			// Check the current char in the format string
			switch ($format[$i]) {
				case 'D':
				case 'l':
					// Day of the week - short and long
					$dhivehidate .= $dayofweek[$dateparts['wday']];
					break;
				
				case 'S':
					// Ordinal suffix but dhivehi doesn't have such so ignore
					break;
				
				case 'F':
				case 'M':
					// Textual representation of month - short and long
					$dhivehidate .= $months[$dateparts['mon']];
					break;
				
				case 'a':
				case 'A':
					// Ante meridiem and Post meridiem
					$dhivehidate .= ($dateparts['hours'] < 12) ? $ampm['am'] : $ampm['pm'];
					break;
				
				case ' ':
					$dhivehidate .= ' ';
					break;
				
				case '\\':
					// Escape slashes - get escaped char
					$i++;
					$dhivehidate .= $format[$i];
					break;
				
				default:
					$dhivehidate .= date($format[$i], $timestamp);
			}
		}
		
		return $dhivehidate;
		
	}
	
	// }}}
	
}

// }}}

?>
