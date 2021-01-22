<?php

namespace TaskApp;

class Helpers
{
    /**
     * Путь до файла
     * @param string $fileName
     * @return string
     */
    public static function fullPath(string $fileName): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . "/views/" . $fileName;
    }

    /**
     * Проверка на присуствие файла
     * @param string $fileName
     * @return string
     */
    public static function checkFile(string $fileName): string
    {
        return file_exists(self::fullPath($fileName));
    }

    /**
     * Парсинг csv
     * @param string $fileName
     * @return array
     */
    public static function parseCsv(string $fileName): array
    {
        $result = [];
        if (self::checkFile($fileName)) {
            if (($handle = fopen(self::fullPath($fileName), "r")) !== false) {
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    $result[] = explode(";", array_shift($data));
                }
                fclose($handle);
            }
            array_shift($result);
            return $result;
        } else {
            echo 'Файла нет';
        }
    }

    /**
     * @param string $templateName
     * @param array $data
     * @return string
     */
    public static function view(string $templateName, array $data = []): string
    {
        extract($data);

        return require self::fullPath($templateName);
    }

    /**
     * @return array
     */
    public static function converterList(): array
    {
        return [
            "а" => "a",
            "ый" => "iy",
            "ые" => "ie",
            "б" => "b",
            "в" => "v",
            "г" => "g",
            "д" => "d",
            "е" => "e",
            "ё" => "yo",
            "ж" => "zh",
            "з" => "z",
            "и" => "i",
            "й" => "y",
            "к" => "k",
            "л" => "l",
            "м" => "m",
            "н" => "n",
            "о" => "o",
            "п" => "p",
            "р" => "r",
            "с" => "s",
            "т" => "t",
            "у" => "u",
            "ф" => "f",
            "х" => "kh",
            "ц" => "ts",
            "ч" => "ch",
            "ш" => "sh",
            "щ" => "shch",
            "ь" => "",
            "ы" => "y",
            "ъ" => "",
            "э" => "e",
            "ю" => "yu",
            "я" => "ya",
            "йо" => "yo",
            "ї" => "yi",
            "і" => "i",
            "є" => "ye",
            "ґ" => "g"
        ];
    }

    /**
     * @param string $str
     * @return string
     */
    public static function generateURL(string $str): string
    {
        $str = strtr(mb_strtolower($str), self::converterList());

        $str = preg_replace("/(?![.=$'€%-])\p{P}/u", "-", $str);

        $str = preg_replace("/\s+/", "-", $str);

        $str = trim(preg_replace('/-+/', '-', $str), "-");
        return $str;

    }

    /**
     * @param array $sales
     * @return array
     */
    public static function slug(array $sales): array
    {
        $result = [];
        foreach ($sales as $sale) {
            $sale['link'] = self::generateURL(
                $sale['id'] . ' ' . $sale['name']
            );
            $result[] = $sale;
        }
        return $result;
    }

    /**
     * @param null $message
     * @param int $code
     * @return false|string
     */
    public static function jsonResponse($message = null, $code = 200)
    {
        header_remove();
        http_response_code($code);
        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
        header('Content-Type: application/json');

        $status = array(
            200 => '200 OK',
            400 => '400 Bad Request',
            422 => 'Unprocessable Entity',
            500 => '500 Internal Server Error'
        );

        header('Status: ' . $status[$code]);

        /* Возвращаем декодированный json, bool $code */
        return json_encode(array(
            'status' => $code < 300,
            'message' => $message
        ));
    }
}
