<?php
namespace ThaoHR\Services\Bonus\Operands;
abstract class AbsOperand
{
    /**
     * @var array
     */
    protected $resource;

    /**
     * @var string
     */
    protected $field;

    /**
     * @var mix
     */
    protected $value;

    /**
     * Checking Operand is statisfied
     */
    public abstract function isStatisfied();

    public function __construct($resource, $field, $value)
    {
        $this->resource = $resource;
        $this->field = $field;
        $this->value = $value;
    }
}