<?php
namespace ThaoHR\Services\Bonus\Rules;

use ThaoHR\Services\Bonus\Operands\EqualOperand;
use ThaoHR\Services\Bonus\Operands\NotEqualOperand;
use ThaoHR\Services\Bonus\Operator;
use ThaoHR\Survey;
use ThaoHR\SurveyStatus;

class StatusApplicantRule extends AbsRule implements IMetaData
{
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
            "value" => 'StatusApplicantRule',
            "operators" => [
                "==" => "Bằng",
                "!=" => "Khác",
            ],
            "name" => __('Trạng thái hồ sơ'),
            "fields" => ['type', 'operator', 'value'],
        ];
    }

    protected function createOperand()
    {
        $statusRecord = SurveyStatus::where('name', $this->ruleSchema['value'])->first();
        $operator = $this->ruleSchema['operator'];
        $resource = [
            'status' => $this->surveyResult->status
        ];
        if ($operator == Operator::EQUAL) {
            return new EqualOperand($resource, 'status', $statusRecord->id);
        } elseif ($operator == Operator::NOT_EQUAL) {
            return new NotEqualOperand($resource, 'status', $statusRecord->id);
        } 
    }

    public function isStatisfied()
    {
        $operand = $this->createOperand();
        return $operand->isStatisfied();
    }
}