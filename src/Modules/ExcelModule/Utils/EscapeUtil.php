<?php

namespace Tool\Modules\ExcelModule\Utils;

class EscapeUtil
{
    private static function escape($string, $escapeWords): string
    {
        $string = trim($string);

        foreach ($escapeWords as $word) {
            $prefix = substr($string, 0, strlen($word));

            if (strcmp(mb_strtolower($word), mb_strtolower($prefix)) !== 0)
                continue;

            return ltrim(trim(substr($string, strlen($word))), '0');
        }

        throw new \Exception('No thing is escaped');
    }

    public static function escapeProvinceName(string $provinceName): string
    {
        return self::escape($provinceName, [ 'Thành phố', 'Tỉnh']);
    }

    public static function escapeDistrictName(string $districtName): string
    {
        //Thành phố trực thuộc cấp huyện -> vd Thành Phố Hà Giang
        return self::escape($districtName, ['Quận', 'Thành phố', 'Thị xã', 'Huyện']);
    }

    public static function escapeWardName(string $ward): string
    {
        return self::escape($ward, ['Phường','Thị trấn', 'Xã']);
    }
}