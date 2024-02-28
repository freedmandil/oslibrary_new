<?php

use App\Models\LocAssignment;

if (!function_exists('detectLanguage'))
{
    function detectLanguage($string): string {

        // Hebrew Unicode block ranges from U+0590 to U+05FF
        $hebrewCharPattern = '/[\x{0590}-\x{05FF}]/u';

        if (preg_match($hebrewCharPattern, $string)) {
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
            "משנה ברורה" => array(
                "first_name" => "ישראל",
                "middle_name" => "מאיר",
                "last_name" => "קגן",
                "nickname" => "חפץ חיים",
                'type' => 'author'
            ),
            "חפץ חיים" => array(
                "first_name" => "ישראל",
                "middle_name" => "מאיר",
                "last_name" => "קגן",
                "nickname" => "חפץ חיים",
                'type' => 'author'
            ),
            "שמירת הלשון" => array(
                "first_name" => "ישראל",
                "middle_name" => "מאיר",
                "last_name" => "קגן",
                "nickname" => "חפץ חיים",
                'type' => 'author'
            ),
            "משנה תורה" => array(
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
                'type' => 'author'
            ),
            'מהר"ל' => array(
                "first_name" => "יהודה",
                "middle_name" => "ליווא",
                "last_name" => "מפראג",
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
        );
        foreach ($author_mappings as $key_phrase => $author_info) {
            // Check if the key phrase is present in the title
            if (preg_match("/$key_phrase/iu", $title)) {
                return $author_info; // Return author information
            }
        }
        return null; // Return null if no matching key phrase is found
    }
}

if (!function_exists('parseAuthorName')) {
    function parseAuthorName($name, $book_title = null): ?array
    {
        if (empty(trim($name))) {
            return null; // Or return an array with all values set to null or empty, depending on your needs
        }
        $name = removeSingleLetters($name);
        $prefixes = ['ר׳', 'רב', 'רבי', 'הגאון', 'גאון', "'ר", 'Rabbi', 'Rav', 'Rebbi', 'Rebbe', 'haRav', 'haGaon', 'haRav haGaon', "R'"];
        $suffixes = ['Shlita', 'Shlit"a', 'שליט״א', 'שליט"א', 'ז״ל', 'z"l', 'zl', 'ז"ל', 'זצ״ל', 'זצ"ל', 'זצק״ל', 'זצק"ל', 'ztz"l', 'ztzk"l'];
        $suffixes_cohen = ['haKohen', 'haKohein', 'haCohen', 'haCohein', 'הכהן', '(כהן)'];
        $suffixes_levi = ['haLevi', 'הלוי', '(לוי)'];
        $author_details = parseTitleAndUpdateAuthor($book_title);
        if (empty($author_details)) {
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
    function determineLocAssignmentId($shelfno)
    {
        $letter = mb_strtoupper(preg_replace('/[0-9]+/', '', $shelfno));
        $number = (int)preg_replace("/[^0-9]/", '', $shelfno);

        $query = LocAssignment::query();

        // Apply the ref_code condition only if display_code = 1
        $query->when($letter, function ($q) use ($letter) {
            return $q->where('display_code', 1)
                ->where('ref_code', $letter);
        }, function ($q) {
            // If display_code is not 1, or no letter is provided, do not limit by ref_code
            return $q->where(function($query) {
                $query->where('display_code', '!=', 1)
                    ->orWhereNull('display_code');
            })->orWhereNull('ref_code'); // Consider cases where ref_code is null
        });

        // Apply conditions for starting_number and ending_number regardless of display_code
        $query->where('starting_number', '<=', $number)
            ->where('ending_number', '>=', $number);

        $locAssignment = $query->first();

        return !empty($locAssignment) ? $locAssignment->id : null;
    }
}

