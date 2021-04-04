<?php
namespace ThaoHR\Services\Bonus\Rules;

use PHPUnit\Framework\Constraint\GreaterThan;
use ThaoHR\Services\Bonus\Operands\EqualOperand;
use ThaoHR\Services\Bonus\Operands\GreaterThanEqualOperand;
use ThaoHR\Services\Bonus\Operands\GreaterThanOperand;
use ThaoHR\Services\Bonus\Operands\LessThanEqualOperand;
use ThaoHR\Services\Bonus\Operands\LessThanOperand;
use ThaoHR\Services\Bonus\Operands\NotEqualOperand;
use ThaoHR\Services\Bonus\Operator;
use ThaoHR\SurveyResult;
use ThaoHR\SurveyStatus;

class MonthlyApplicantRule extends AbsRule implements IMetaData
{
    /**
     * @var
     */
    public $status_value;

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
            "value" => 'MonthlyApplicantRule',
            "operators" => [
                ">=" => "Lớn hơn bằng",
                "<=" => "Nhỏ hơn bằng",
                "==" => "Bằng",
                ">" => "Lớn hơn",
                "<" => "Nhỏ hơn",
            ],
            "name" => __('Số hồ sơ trong tháng'),
            "fields" => ['type', 'operator', 'value', 'status_value'],
        ];
    }

    protected function createOperand($total)
    {
        $resource = [
            'total' => $total
        ];
        $operator = $this->ruleSchema['operator'];
        if ($operator == Operator::EQUAL) {
            return new EqualOperand($resource, 'total', $this->ruleSchema['value']);
        } elseif ($operator == Operator::NOT_EQUAL) {
            return new NotEqualOperand($resource, 'total', $this->ruleSchema['value']);
        } elseif ($operator == Operator::GREATER_THAN) {
            return new GreaterThanOperand($resource, 'total', $this->ruleSchema['value']);
        } elseif ($operator == Operator::GREATER_THAN_EQUAL) {
            return new GreaterThanEqualOperand($resource, 'total', $this->ruleSchema['value']);
        } elseif ($operator == Operator::LESS_THAN) {
            return new LessThanOperand($resource, 'total', $this->ruleSchema['value']);
        } elseif ($operator == Operator::LESS_THAN_EQUAL) {
            return new LessThanEqualOperand($resource, 'total', $this->ruleSchema['value']);
        }
    }

    public function isStatisfied()
    {
        $statusRecord = SurveyStatus::where('id', $this->ruleSchema['status_value'])->first();
        if (!empty($statusRecord)) {
            $total = SurveyResult::where('affiliate_id',$this->surveyResult->affiliate_id)->where('status', $statusRecord->id)->where('survey_id', $this->surveyResult->survey_id)->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')->count();
            $operand = $this->createOperand($total);
            return $operand->isStatisfied();
        }

        return false;

    }
}