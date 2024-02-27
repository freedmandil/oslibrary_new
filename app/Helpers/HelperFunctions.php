<?php

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

if (!function_exists('parseAuthorName')) {
    function parseAuthorName($name): ?array
    {
        if (empty(trim($name))) {
            return null; // Or return an array with all values set to null or empty, depending on your needs
        }

        $prefixes = ['ר׳', 'רב', 'רבי', 'הגאון', 'גאון'];
        $nameComponents = [
            'prefix' => null,
            'first_name' => null,
            'last_name' => null,
            'middle_name' => null,
            'suffix' => null,
            'acronym' => null,
            'type' => 'author',
        ];

        // Check for and remove prefix
        foreach ($prefixes as $prefix) {
            if (strpos($name, $prefix) !== false) {
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

        return $nameComponents;
    }
}

if (!function_exists('create_barcode_number')) {
    function create_barcode_number($booknum, $shelfno): string
    {
        $length=0;

        $barcode_num = "";
        $booknum = strval($booknum);
        $str_length = 7;
        $str = substr("0{$booknum}", -$str_length);

// Left padding if number < $str_length
        while ($length < $str_length) {

            $str = substr("0{$str}", -$str_length);
            $length = strlen($str);
        }


        $length = strlen($str);
        $sum = 0;
        $p = $length % 2;
// Sum digits, where every second digit from right is doubled (last one is check digit, which is not in parameter)
        for($i = $length-1; $i >= 0; --$i) {
            $digit = $str[$i];
            // Every second digit is doubled
            if ($i % 2 != $p) {
                $digit *= 2;
                // If doubled value is 10 or more (for example 13), then add to sum each digit (i.e. 1 and 3)
                if($digit > 9){
                    $sum += $digit[0];
                    $sum += $digit[1];
                } else{
                    $sum += $digit;
                }
            } else{
                $sum += $digit;
            }
        }
// Multiply by 9
        $sum *= 9;
// Last one is check digit
        $barcode_num = $str.substr($sum, -1, 1);
        $shelfno  = preg_replace('/\d+/u', '', $shelfno);
        $shelfno = preg_replace('/[[:^print:]]/', '', $shelfno);
        if (empty($shelfno)) {$shelfno = "1";}
        $shelf_letter = $shelfno;
        $barcode_num = mb_convert_case($shelf_letter, MB_CASE_UPPER, "UTF-8").$barcode_num;
        return ($barcode_num);
    }

}
use App\Models\LocAssignment;

if (!function_exists('determineLocAssignmentId')) {
    function determineLocAssignmentId($shelfno): int
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
            });
        });

        // Apply conditions for starting_number and ending_number regardless of display_code
        $query->where('starting_number', '<=', $number)
            ->where('ending_number', '>=', $number);

        $locAssignment = $query->first();

        return $locAssignment ? $locAssignment->id : 0;
    }
}

