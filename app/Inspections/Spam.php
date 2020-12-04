<?php
/**
 * Created by PhpStorm.
 * User: kapustis
 * Date: 08.08.2018
 * Time: 8:22
 */

namespace App\Inspections;

use Exception;

class Spam
{

    protected $inspections = [
        InvalidKeywords::class,
        KeyHeldDown::class
    ];

    /**
     * Обнаружение спама.
     * @param $body
     * @return bool
     * @throws Exception
     */
    public function detect($body)
    {
        foreach ($this->inspections as $inspection) {
            app($inspection)->detect($body);
        }

        return false;
    }

}
