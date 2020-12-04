<?php
/**
 * Created by PhpStorm.
 * User: kapustis
 * Date: 08.08.2018
 * Time: 14:54
 */

namespace App\Inspections;

use Exception;

class KeyHeldDown
{
    /**
     * Обнаружение спама.
     *
     * @param  string $body
     * @throws Exception
     */
    public function detect($body)
    {
        if (preg_match('/(.)\\1{4,}/u', $body)) { // body ffff =>0 fffff => 1
            throw new Exception('Your reply contains spam.');
        }
    }
}
