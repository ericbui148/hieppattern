<?php
namespace ThaoHR\Services\Bonus\Rules;

interface ILogicalOperator
{
    /**
     * And operator
     */
    public function and(AbsRule $rule);

    /**
     * Or operator
     */
    public function or(AbsRule $rule);
}