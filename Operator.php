<?php

namespace ThaoHR\Services\Bonus;
class Operator
{
    const GREATER_THAN = '>';
    const GREATER_THAN_EQUAL = '>=';
    const LESS_THAN ='<';
    const LESS_THAN_EQUAL ='<=';
    const CONTAIN = 'LIKE';
    const NOT_CONTAIN ='NOT LIKE';
    const EQUAL ='==';
    const NOT_EQUAL ='!=';

    static function getOperators() {
        return [
            self::GREATER_THAN => 'Lớn hơn',
            self::GREATER_THAN_EQUAL => 'Lớn hơn bằng',
            self::LESS_THAN => 'Nhỏ hơn',
            self::LESS_THAN_EQUAL => 'Nhỏ hơn bằng',
            self::CONTAIN => 'Chứa',
            self::NOT_CONTAIN => 'Không chứa',
            self::EQUAL => 'Bằng',
            self::NOT_EQUAL => 'Không bằng',
        ];
    }
}