<?php
/**
 * Desc:
 * Date: 19-2-26 Time: 下午3:21
 */
namespace Soar\ReadCsv\Facades;

use Illuminate\Support\Facades\Facade;

class Csv extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'csv';
    }
}