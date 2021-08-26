<?php

namespace Tool\Utils;

class SortVNUtil
{
    CONST VIET_NAM_CHARS =  array(
        '/a/', '/à/', '/ả/', '/ã/', '/á/', '/ạ/',
        '/ă/', '/ằ/', '/ẳ/', '/ẵ/', '/ắ/', '/ặ/',
        '/â/', '/ầ/', '/ẩ/', '/ẫ/', '/ấ/', '/ậ/',
        '/e/', '/è/', '/ẻ/', '/ẽ/', '/é/', '/ẹ/',
        '/ê/', '/ề/', '/ể/', '/ễ/', '/ế/', '/ệ/',
        '/i/', '/ì/', '/ỉ/', '/ĩ/', '/í/', '/ị/',
        '/o/', '/ò/', '/ỏ/', '/õ/', '/ó/', '/ọ/',
        '/ô/', '/ồ/', '/ổ/', '/ỗ/', '/ố/', '/ộ/',
        '/ơ/', '/ờ/', '/ở/', '/ỡ/', '/ớ/', '/ợ/',
        '/u/', '/ù/', '/ủ/', '/ũ/', '/ú/', '/ụ/',
        '/ư/', '/ừ/', '/ử/', '/ữ/', '/ứ/', '/ự/',
        '/y/', '/ỳ/', '/ỷ/', '/ỹ/', '/ý/', '/ỵ/',
        '/A/', '/À/', '/Ả/', '/Ã/', '/Á/', '/Ạ/',
        '/Ă/', '/Ằ/', '/Ẳ/', '/Ẵ/', '/Ắ/', '/Ặ/',
        '/Â/', '/Ầ/', '/Ẩ/', '/Ẫ/', '/Ấ/', '/Ậ/',
        '/E/', '/È/', '/Ẻ/', '/Ẽ/', '/É/', '/Ẹ/',
        '/Ê/', '/Ề/', '/Ể/', '/Ễ/', '/Ế/', '/Ệ/',
        '/I/', '/Ì/', '/Ỉ/', '/Ĩ/', '/Í/', '/Ị/',
        '/O/', '/Ò/', '/Ỏ/', '/Õ/', '/Ó/', '/Ọ/',
        '/Ô/', '/Ồ/', '/Ổ/', '/Ỗ/', '/Ố/', '/Ộ/',
        '/Ơ/', '/Ờ/', '/Ở/', '/Ỡ/', '/Ớ/', '/Ợ/',
        '/U/', '/Ù/', '/Ủ/', '/Ũ/', '/Ú/', '/Ụ/',
        '/Ư/', '/Ừ/', '/Ử/', '/Ữ/', '/Ứ/', '/Ự/',
        '/Y/', '/Ỳ/', '/Ỷ/', '/Ỹ/', '/Ý/', '/Ỵ/',
        '/d/', '/đ/', '/D/', '/Đ/');

    CONST ENCODE_CHARS = array(
        'a0', 'a02', 'a03', 'a04', 'a05', 'a06',
        'a1', 'a12', 'a13', 'a14', 'a15', 'a16',
        'a2', 'a22', 'a23', 'a24', 'a25', 'a26',
        'e0', 'e02', 'e03', 'e04', 'e05', 'e06',
        'e1', 'e12', 'e13', 'e14', 'e15', 'e16',
        'i0', 'i02', 'i03', 'i04', 'i05', 'i06',
        'o0', 'o02', 'o03', 'o04', 'o05', 'o06',
        'o1', 'o12', 'o13', 'o14', 'o15', 'o16',
        'o2', 'o22', 'o23', 'o24', 'o25', 'o26',
        'u0', 'u02', 'u03', 'u04', 'u05', 'u06',
        'u1', 'u12', 'u13', 'u14', 'u15', 'u16',
        'y0', 'y02', 'y03', 'y04', 'y05', 'y06',
        'A0', 'A02', 'A03', 'A04', 'A05', 'A06',
        'A1', 'A12', 'A13', 'A14', 'A15', 'A16',
        'A2', 'A22', 'A23', 'A24', 'A25', 'A26',
        'E0', 'E02', 'E03', 'E04', 'E05', 'E06',
        'E1', 'E12', 'E13', 'E14', 'E15', 'E16',
        'I0', 'I02', 'I03', 'I04', 'I05', 'I06',
        'O0', 'O02', 'O03', 'O04', 'O05', 'O06',
        'O1', 'O12', 'O13', 'O14', 'O15', 'O16',
        'O2', 'O22', 'O23', 'O24', 'O25', 'O26',
        'U0', 'U02', 'U03', 'U04', 'U05', 'U06',
        'U1', 'U12', 'U13', 'U14', 'U15', 'U16',
        'Y0', 'Y02', 'Y03', 'Y04', 'Y05', 'Y06',
        'd81', 'd91', 'D81', 'D91');

    static private function encodedArray(array $array): array
    {
        $array_encoded = [];

        for ($i = 0; $i < count($array); $i++) {
            $array_encoded[$i] = preg_replace(self::VIET_NAM_CHARS, self::ENCODE_CHARS, strval($array[$i]));
            $array_encoded[$i] = preg_replace("/\b(\w+)([012])([2-6])(\w+)?\b/", "$1$2$4$3", $array_encoded[$i]);
        }

        return $array_encoded;
    }

    public static function sort(array &$array): array
    {
        $array_encoded = self::encodedArray($array);

        array_multisort(array_map('strtolower', $array_encoded), SORT_ASC, SORT_NATURAL, $array, SORT_ASC, SORT_NATURAL);

        return $array;
    }

    public static function kSort(array &$array): array
    {
        $array_keys = array_keys($array);
        $array_keys_encoded = self::encodedArray($array_keys);

        array_multisort(array_map('strtolower', $array_keys_encoded), SORT_ASC, SORT_NATURAL, $array, $array_keys);
        $array = array_combine($array_keys, $array);

        return $array;
    }
}