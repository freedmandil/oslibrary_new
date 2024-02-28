<?php

use App\Models\LocAssignment;

if (!function_exists('stripPunctuation')) {
    function stripPunctuation($str)
    {
        // Define the regular expression pattern to match punctuation
        $pattern = '/[^\p{L}\p{N}\s\p{P}]/u';

        // Use preg_replace to remove all punctuation characters from the string
        $cleaned_str = preg_replace($pattern, '', $str);

        return $cleaned_str;
    }
}

if (!function_exists('detectLanguage'))
{
    function detectLanguage($string): ?string {
        $HebChars = preg_match('/[\x{0590}-\x{05FF}]/u', stripPunctuation($string));
        if ($HebChars) {
            // Hebrew Unicode block ranges from U+0590 to U+05F
                return 'he';
            } else {
                return 'en';
            }
    }
}

if (!function_exists('parseShelfNumber')) {
    function parseShelfNumber($shelfNumber): array
    {
        // Initialize default components
        $components = [
            'prefix' => '',
            'number' => 0,
            'suffix' => ''
        ];

        // Regex pattern to match the shelf number components
        // Assuming the number part is always present and must be between 1 and 9999
        $pattern = '/^([^0-9]*)([1-9][0-9]{0,3})([^0-9]*)$/u';

        if (preg_match($pattern, $shelfNumber, $matches)) {
            // Matches found, update components
            $components['prefix'] = $matches[1] ?? '';
            $components['number'] = (int)($matches[2] ?? 0);
            $components['suffix'] = $matches[3] ?? '';
        }

        return $components;
    }
}

if (!function_exists('removeSingleLetters')) {

    function removeSingleLetters($author_name)
    {
        // Split the author's name into parts
        $name_parts = explode(' ', $author_name);

        // Loop through each part
        foreach ($name_parts as $key => $part) {
            // Check if the part is a single letter
            if (strlen($part) === 1) {
                // Remove the single letter from the name parts
                unset($name_parts[$key]);
            }
        }

        // Reconstruct the author's name without single letters
        $cleaned_name = implode(' ', $name_parts);

        return $cleaned_name;
    }
}


if (!function_exists('parseTitleAndUpdateAuthor')) {
    function parseTitleAndUpdateAuthor($title)
    {
        $author_mappings = array(
            'משנה ברורה' => array(
                "first_name" => "ישראל",
                "middle_name" => "מאיר",
                "last_name" => "קגן",
                "nickname" => "חפץ חיים",
                'type' => 'author'
            ),
            'חפץ חיים' => array(
                "first_name" => "ישראל",
                "middle_name" => "מאיר",
                "last_name" => "קגן",
                "nickname" => "חפץ חיים",
                'type' => 'author'
            ),
            'שמירת הלשון' => array(
                "first_name" => "ישראל",
                "middle_name" => "מאיר",
                "last_name" => "קגן",
                "nickname" => "חפץ חיים",
                'type' => 'author'
            ),
            'משנה תורה' => array(
                "first_name" => "משה",
                "last_name" => "מיימון",
                "acronym" => 'רמב"ם',
                'type' => 'author'
            ),
            'רמב"ן' => array(
                "first_name" => "משה",
                "last_name" => "נחמן",
                "acronym" => 'רמב"ן',
                'type' => 'author'
            ),
            'רשב"א' => array(
                "first_name" => "שלמה",
                "last_name" => "אדרת",
                "acronym" => 'רשב"א',
                'type' => 'author'
            ),
            'ריטב"א' => array(
                "first_name" => "אברהם",
                "middle_name" => "יום טוב",
                "last_name" => "אשבילי",
                "acronym" => 'ריטב"א',
                'type' => 'author'
            ),
            'ר"ן' => array(
                "prefix" => "רבנו",
                "first_name" => "ניסים",
                "last_name" => "מג'רונה",
                "acronym" => 'ר"ן',
                'type' => 'author'
            ),
            'רמב״ן' => array(
                "first_name" => "משה",
                "last_name" => "נחמן",
                "acronym" => 'רמב"ן',
                'type' => 'author'
            ),
            'רשב״א' => array(
                "first_name" => "שלמה",
                "last_name" => "אדרת",
                "acronym" => 'רשב"א',
                'type' => 'author'
            ),
            'ריטב״א' => array(
                "first_name" => "אברהם",
                "middle_name" => "יום טוב",
                "last_name" => "אשבילי",
                "acronym" => 'ריטב"א',
                'type' => 'author'
            ),
            'ר״ן' => array(
                "prefix" => "רבנו",
                "first_name" => "ניסים",
                "last_name" => "מג'רונה",
                "acronym" => 'ר"ן',
                'type' => 'author'
            ),
            'מהר״ל' => array(
                "first_name" => "יהודה",
                "middle_name" => "ליווא",
                "last_name" => "מפראג",
                "nickname" => "גור אריה",
                'type' => 'author'
            ),
            'גור אריה' => array(
                "first_name" => "יהודה",
                "middle_name" => "ליווא",
                "last_name" => "מפראג",
                "nickname" => "גור אריה",
                'type' => 'author'
            ),
            'חומש גור אריה' => array(
                "first_name" => "יהודה",
                "middle_name" => "ליווא",
                "last_name" => "מפראג",
                "nickname" => "גור אריה",
                'type' => 'author'
            ),
            'מהר"ל' => array(
                "first_name" => "יהודה",
                "middle_name" => "ליווא",
                "last_name" => "מפראג",
                "nickname" => "גור אריה",
                'type' => 'author'
            ),
            'ערוך השלחן' => array(
                "first_name" => "יחיאל",
                "middle_name" => "מיכל",
                "last_name" => "אפשטיין",
                "suffix" => "הלוי",
                "nickname" => "ערוך השלחן",
                'type' => 'author'
            ),
            'ערוך השולחן' => array(
                "first_name" => "יחיאל",
                "middle_name" => "מיכל",
                "last_name" => "אפשטיין",
                "suffix" => "הלוי",
                "nickname" => "ערוך השלחן",
                'type' => 'author'
            ),
            'תורה תמימה' => array(
                "first_name" => "ברוך",
                "last_name" => "אפשטיין",
                "suffix" => "הלוי",
                "nickname" => "תורה תמימה",
                'type' => 'author'
            ),
            'שולחן ערוך הרב' => array(
                "first_name" => "שניאור",
                "middle_name" => "זלמן",
                "last_name" => "מלאדי",
                "nickname" => "בעל התניא",
                'type' => 'author'
            ),
            'שלחן ערוך הרב' => array(
                "first_name" => "שניאור",
                "middle_name" => "זלמן",
                "last_name" => "מלאדי",
                "nickname" => "בעל התניא",
                'type' => 'author'
            ),
            'שפת אמת' => array(
                "first_name" => "יהודה",
                "middle_name" => "אריה ליב אלתר ",
                "last_name" => "מגור",
                "nickname" => "שפת אמת",
                'type' => 'author'
            ),
            'משך חכמה' => array(
                "first_name" => "מאיר",
                "middle_name" => "שמחה",
                "last_name" => "מדווינסק",
                "suffix" => "הכהן",
                "nickname" => "אור שמח",
                'type' => 'author'
            ),
            'אור שמח' => array(
                "first_name" => "מאיר",
                "middle_name" => "שמחה",
                "last_name" => "מדווינסק",
                "suffix" => "הכהן",
                "nickname" => "אור שמח",
                'type' => 'author'
            ),
            'מאיר שמחה' => array(
                "first_name" => "מאיר",
                "middle_name" => "שמחה",
                "last_name" => "מדווינסק",
                "suffix" => "הכהן",
                "nickname" => "אור שמח",
                'type' => 'author'
            ),
            'רש״י' => array(
                "first_name" => "מאיר",
                "middle_name" => "שמחה",
                "last_name" => "מדווינסק",
                "suffix" => "הכהן",
                "acronym" => "אור שמח",
                'type' => 'author'
            ),
            'רש"י' => array(
                "first_name" => "שלמה",
                "last_name" => "יצחק",
                "acronym" => 'רש"י',
                'type' => 'author'
            ),
        );
        foreach ($author_mappings as $key_phrase => $author_info) {
            // Escape special characters in the key phrase
            $escaped_key_phrase = preg_quote($key_phrase, '/');

            // Check if the key phrase is present in the title
            if (preg_match("/$escaped_key_phrase/iu", $title)) {
                return $author_info; // Return author information
            }
        }
        return null; // Return null if no matching key phrase is found
    }
}

if (!function_exists('parseAuthorName')) {
    function parseAuthorName($name, $book_title): ?array
    {
        $author_details = parseTitleAndUpdateAuthor($book_title);
        if (empty($author_details)) {
            if (empty(trim($name))) {
                return null; // Or return an array with all values set to null or empty, depending on your needs
            }
            $name = removeSingleLetters($name);
            $prefixes = ['ר׳', 'רב', 'רבי', 'הגאון', 'גאון', "'ר", "ר'", 'Rabbi', 'Rav', 'Rebbi', 'Rebbe', 'haRav', 'haGaon', 'haRav haGaon', "R'"];
            $suffixes = ['Shlita', 'Shlit"a', 'שליט״א', 'שליט"א', 'ז״ל', 'z"l', 'zl', 'ז"ל', 'זצ״ל', 'זצ"ל', 'זצק״ל', 'זצק"ל', 'ztz"l', 'ztzk"l'];
            $suffixes_cohen = ['haKohen', 'haKohein', 'haCohen', 'haCohein', 'הכהן', '(כהן)'];
            $suffixes_levi = ['haLevi', 'הלוי', '(לוי)'];
                $nameComponents = [
                    'prefix' => null,
                    'first_name' => null,
                    'last_name' => null,
                    'middle_name' => null,
                    'suffix' => null,
                    'acronym' => null,
                    'type' => 'author',
                ];

                $name = trim(str_ireplace('ב״ר', '', $name));
                $name = trim(str_ireplace('ב"ר', '', $name));


                // Check for and remove prefix
                foreach ($prefixes as $prefix) {
                    $EnglishChars = preg_match('/[^a-zA-Z]/', $name);
                    if ($EnglishChars && strpos(strtolower($name), strtolower($prefix)) !== false) {
                        $nameComponents['prefix'] = $prefix;
                        $name = trim(str_ireplace($prefix, '', $name));
                        break;
                    } elseif (!$EnglishChars && strpos($name, $prefix) !== false) {
                        $nameComponents['prefix'] = $prefix;
                        $name = trim(str_replace($prefix, '', $name));
                        break;
                    }
                }
                foreach ($suffixes as $suffix) {
                    $EnglishChars = preg_match('/[^a-zA-Z]/', $name);
                    if ($EnglishChars && strpos(strtolower($name), strtolower($suffix)) !== false) {
                        $name = trim(str_ireplace($suffix, '', $name));
                        break;
                    } elseif (!$EnglishChars && strpos($name, $suffix) !== false) {
                        $name = trim(str_replace($suffix, '', $name));
                        break;
                    }
                }

                // Check for and remove Cohen suffixes
                foreach ($suffixes_cohen as $suffix) {
                    $EnglishChars = preg_match('/[^a-zA-Z]/', $name);
                    if ($EnglishChars && strpos(strtolower($name), strtolower($prefix)) !== false) {
                        $nameComponents['suffix'] = 'haKohen';
                        $name = trim(str_ireplace($suffix, '', $name));
                        break;
                    } elseif (!$EnglishChars && strpos($name, $prefix) !== false) {
                        $nameComponents['suffix'] = 'הכהן';
                        $name = trim(str_replace($prefix, '', $name));
                        break;
                    }
                }

                foreach ($suffixes_levi as $suffix) {
                    $EnglishChars = preg_match('/[^a-zA-Z]/', $name);
                    if ($EnglishChars && strpos(strtolower($name), strtolower($prefix)) !== false) {
                        $nameComponents['suffix'] = 'haLevi';
                        $name = trim(str_ireplace($suffix, '', $name));
                        break;
                    } elseif (!$EnglishChars && strpos($name, $prefix) !== false) {
                        $nameComponents['suffix'] = 'הלוי';
                        $name = trim(str_replace($prefix, '', $name));
                        break;
                    }
                }

                // Check for and remove prefix
                foreach ($prefixes as $prefix) {
                    $EnglishChars = preg_match('/[^a-zA-Z]/', $name);
                    if ($EnglishChars && strpos(strtolower($name), strtolower($prefix)) !== false) {
                        $nameComponents['prefix'] = $prefix;
                        $name = trim(str_ireplace($prefix, '', $name));
                        break;
                    } elseif (!$EnglishChars && strpos($name, $prefix) !== false) {
                        $nameComponents['prefix'] = $prefix;
                        $name = trim(str_replace($prefix, '', $name));
                        break;
                    }
                }

                // Split the name into parts
                $parts = explode(' ', $name);

                // Determine how to assign parts based on count and content
                $numParts = count($parts);
                if ($numParts === 1) {
                    $nameComponents['last_name'] = $parts[0];
                } elseif ($numParts === 2) {
                    $nameComponents['first_name'] = $parts[0];
                    $nameComponents['last_name'] = $parts[1];
                } else {
                    // Check for acronym in the last part
                    if (strpos(end($parts), '"') !== false) {
                        $nameComponents['acronym'] = array_pop($parts);
                    } else {
                        $nameComponents['last_name'] = array_pop($parts);
                    }
                    $nameComponents['first_name'] = array_shift($parts);
                    if (!empty($parts)) {
                        $nameComponents['middle_name'] = implode(' ', $parts);
                    }
                }
        } else {
            $nameComponents = $author_details;
        }
        foreach ($nameComponents as &$component) {
            $component = str_toTitleCase($component);
        }
        return $nameComponents;
    }
}

if (!function_exists('create_barcode_number')) {
    function create_barcode_number($bkrefno, $shelfno)
    {
        $length = 0;
        $barcode_num = "";

        // Convert book reference number to string
        $bkrefno = strval($bkrefno);
        $str_length = 7;
        $str = substr("0{$bkrefno}", -$str_length);

        // Left padding if number < $str_length
        while ($length < $str_length) {
            $str = substr("0{$str}", -$str_length);
            $length = strlen($str);
        }

        $length = strlen($str);
        $sum = 0;
        $p = $length % 2;

        // Sum digits, where every second digit from right is doubled (last one is check digit, which is not in parameter)
        for ($i = $length - 1; $i >= 0; --$i) {
            $digit = intval($str[$i]);
            // Every second digit is doubled
            if ($i % 2 != $p) {
                $digit *= 2;
                // If doubled value is 10 or more, then add each digit separately
                if ($digit > 9) {
                    $sum += intval($digit / 10); // Get the first digit
                    $sum += $digit % 10; // Get the second digit
                } else {
                    $sum += $digit;
                }
            } else {
                $sum += $digit;
            }
        }

        // Multiply by 9
        $sum *= 9;

        // Last one is check digit
        $barcode_num = $str . substr($sum, -1, 1);

        // Clean shelf number
        $shelfno  = preg_replace('/\d+/u', '', $shelfno);
        $shelfno = preg_replace('/[[:^print:]]/', '', $shelfno);
        if (empty($shelfno)) {
            $shelfno = "1";
        }
        $shelf_letter = $shelfno;

        // Convert shelf letter to uppercase
        $barcode_num = mb_convert_case($shelf_letter, MB_CASE_UPPER, "UTF-8") . $barcode_num;

        return $barcode_num;
    }
}

if (!function_exists('determineLocAssignmentId')) {

        // Apply the ref_code condition only if display_code = 1
        function determineLocAssignmentId($shelf_prefix, $shelf_number)
        {
            // Convert shelf number to integer
            $number = (int)$shelf_number;

            // Query to fetch location assignment based on prefix or number
            $query = LocAssignment::query();

            // Check if shelf prefix exists
            if (!empty($shelf_prefix)) {
                // If prefix exists, match it with ref_code and display_code = 1
                $assignment = $query->where('ref_code', $shelf_prefix)
                    ->where('display_code', 1)
                    ->where('starting_number', '<=', $number)
                    ->where('ending_number', '>=', $number)
                    ->first();
            } else {
                // If prefix doesn't exist, match shelf number within range and display_code = 0
                $assignment = $query->where('starting_number', '<=', $number)
                    ->where('ending_number', '>=', $number)
                    ->where('display_code', 0)
                    ->first();
            }

            // If assignment found, return its ID, otherwise return null
            return $assignment ? $assignment->id : null;
        }
}

if (!function_exists('str_toTitleCase'))
{
    function str_toTitleCase($string): string
    {
        if ( preg_match('/^[a-zA-Z\s]*$/', stripPunctuation($bookTitle)) ) {
            return ucwords(strtolower($string));
        } else {
            return $string;
    }
}

if (!function_exists('convertVolume')) {
    function convertVolume($mascht)
    {
        // Initialize variables
        $volume_name = $mascht;
        $volume = null;

        // Search for the word "חלק" followed by one or more Hebrew letters
        if (preg_match('/(?:^|\s)חלק\s*(?:[\'"])?([א-ת]+)/iu', $mascht, $matches)) {
            // Extract the letters and convert them to an integer
            $volume = convertHebrewLettersToInt($matches[1]);

            // Remove "חלק" and the letters from the string
            $volume_name = ($mascht);
        } else {
            // Check if the input string is only one character
            $stripped_mascht = stripPunctuation($mascht);
            if (mb_strlen($stripped_mascht) <= 3) {
                // If the single character is a Hebrew letter, convert it to a number
                if (preg_match('/[א-ת]/u', $stripped_mascht)) {
                    $volume = convertHebrewLettersToInt(preg_replace('/[^א-ת]/u', '', $stripped_mascht));
                    // Remove the single Hebrew character from $volume_name
                    $volume_name = '';
                } else if (is_numeric($stripped_mascht)) {
                    // If the single character is a digit, convert it to an integer
                    $volume = intval($stripped_mascht);
                }
            }
        }

        // Trim any extra whitespace from $volume_name
        $volume_name = trim($volume_name);

        //no need to have both the volume and volume_name the same
        if ($volume === $volume_name) {
            $volume_name = null;
        }

        // Return volume and volume name in an array
        return ['volume' => $volume, 'volume_name' => $volume_name];
    }
}


if (!function_exists('convertHebrewLettersToInt')) {

// Function to convert Hebrew letters to integer
    function convertHebrewLettersToInt($letters)
    {
        // Define mapping between Hebrew letters and integers
        $hebrewToInt = [
            'א' => 1, 'ב' => 2, 'ג' => 3, 'ד' => 4, 'ה' => 5,
            'ו' => 6, 'ז' => 7, 'ח' => 8, 'ט' => 9, 'י' => 10,
            'כ' => 20, 'ל' => 30, 'מ' => 40, 'נ' => 50, 'ס' => 60,
            'ע' => 70, 'פ' => 80, 'צ' => 90, 'ק' => 100, 'ר' => 200,
            'ש' => 300, 'ת' => 400, 'ם'=> 40, 'ך' => 20, 'ן' => 50, 'ץ'=> 90, 'ף'=> 80
        ];

        // Split the letters into an array
        $lettersArray = preg_split('//u', $letters, -1, PREG_SPLIT_NO_EMPTY);

        // Initialize the total value
        $total = 0;

        // Iterate over each letter and sum the corresponding integer value
        foreach ($lettersArray as $letter) {
            if (array_key_exists($letter,$hebrewToInt)) {
                 $total += $hebrewToInt[$letter];
            }
        }

        return $total;
    }
}
