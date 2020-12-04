<?php
/**
 * Created by PhpStorm.
 * User: kapustis
 * Date: 09.08.2018
 * Time: 15:08
 */

namespace App\Inspections;

use Exception;

class InvalidKeywords
{
    /**
     * Все зарегистрированные недействительные ключевые слова.
     *
     * @var array
     */
    protected $keywords = [
        'yahoo customer support',
        'syka'
    ];


    /**
     * Обнаружение спама.
     *
     * @param   string $body
     * @throws \Exception
     */
    public function detect($body)
    {
        foreach ($this->keywords as $keyword) {
            if (stripos($body, $keyword) !== false) {
                throw new Exception('Your reply contains spam.');
            }
        }
    }

}
