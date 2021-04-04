<?php
namespace ThaoHR\Services\Bonus\Operands;

class NotLikeOperand extends AbsOperand
{
    public function isStatisfied()
    {
        if (empty($this->resource[$this->field])) return false;
        return strpos($this->resource[$this->field], $this->value) === FALSE;
    }
}