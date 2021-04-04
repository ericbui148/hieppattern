<?php
namespace ThaoHR\Services\Bonus\Rules;

use PHPUnit\Framework\Constraint\GreaterThan;
use ThaoHR\Services\Bonus\Operands\EqualOperand;
use ThaoHR\Services\Bonus\Operands\GreaterThanEqualOperand;
use ThaoHR\Services\Bonus\Operands\LessThanEqualOperand;
use ThaoHR\Services\Bonus\Operands\LessThanOperand;
use ThaoHR\Services\Bonus\Operands\LikeOperand;
use ThaoHR\Services\Bonus\Operands\NotEqualOperand;
use ThaoHR\Services\Bonus\Operands\NotLikeOperand;
use ThaoHR\Services\Bonus\Operator;

class AdvanceRule extends AbsRule implements IMetaData
{
    /**
     * @var
     */
    public $field;

    /**
     * @var
     */
    public $value;

    /**
     * @var
     */
    public $operator;

    static public function getMetadata() {
        return [
            "value" => 'AdvanceRule',
            "name" => __('Nâng cao'),
            "fields" => ['type', 'field', 'value', 'operator'],
        ];
    }

    protected function createOperand()
    {
        $operator = $this->ruleSchema['operator'];
        if ($operator == Operator::EQUAL) {
            return new EqualOperand($this->resource, $this->ruleSchema['field'], $this->ruleSchema['value']);
        } elseif ($operator == Operator::NOT_EQUAL) {
            return new NotEqualOperand($this->resource, $this->ruleSchema['field'], $this->ruleSchema['value']);
        } elseif ($operator == Operator::CONTAIN) {
            return new LikeOperand($this->resource, $this->ruleSchema['field'], $this->ruleSchema['value']);
        } elseif ($operator == Operator::NOT_CONTAIN) {
            return new NotLikeOperand($this->resource, $this->ruleSchema['field'], $this->ruleSchema['value']);
        } elseif ($operator == Operator::GREATER_THAN) {
            return new GreaterThan($this->resource, $this->ruleSchema['field'], $this->ruleSchema['value']);
        } elseif ($operator == Operator::GREATER_THAN_EQUAL) {
            return new GreaterThanEqualOperand($this->resource, $this->ruleSchema['field'], $this->ruleSchema['value']);
        } elseif ($operator == Operator::LESS_THAN) {
            return new LessThanOperand($this->resource, $this->ruleSchema['field'], $this->ruleSchema['value']);
        } elseif ($operator == Operator::LESS_THAN_EQUAL) {
            return new LessThanEqualOperand($this->resource, $this->ruleSchema['field'], $this->ruleSchema['value']);
        }
    }

    public function isStatisfied()
    {
        $operand = $this->createOperand();
        return $operand->isStatisfied();
    }
}