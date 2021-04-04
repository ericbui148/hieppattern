<?php
namespace ThaoHR\Services\Bonus\Operands;

class LessThanEqualOperand extends AbsOperand
{
    public function isStatisfied()
    {

        if (empty($this->resource[$this->field])) return false;
        return $this->resource[$this->field] <= (int)$this->value;
    }
}