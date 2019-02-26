<?php
/**
 * Desc:
 * Date: 2019/1/15 Time: 11:28
 */
namespace Soar\Csv;

use Soar\Csv\Csv\Read;

class Csv
{
    /**
     * Read实例
     *
     * @var null
     */
    public static $instance = null;

    /**
     * 每次读取行数
     *
     * @var int
     */
    const LENGTH = 5000;

    /**
     * Csv constructor.
     * @param $session
     * @param $config
     */
    public function __construct($session = [], $config = [])
    {
    }

    /**
     * simpleData
     * @param $file
     * @param $dealObj
     * @param int $lines
     * @param string $separator
     * @return array
     * @throws \Exception
     * Date: 2019/1/15 Time: 19:15
     */
    public function csvRead($file, $dealObj, $lines = 0, $separator = '|')
    {
        self::$instance = new Read($file);
        $length = $lines ? intval($lines) : self::LENGTH;
        $startLine = 1;
        $data = [];
        while (true) {
            $fileBlock = self::$instance->getData($length, $startLine);
            if (count($fileBlock) == 0) {
                break;
            }
            $block = [];
            foreach ($fileBlock as $value) {
                $row = explode($separator, $value);
                $row = call_user_func([$dealObj, 'row'], $row);
                $row && array_push($block, $row);
            }

            $data = array_merge($data, $block);

            $startLine = $startLine + $length;
        }
        return $data;
    }
}