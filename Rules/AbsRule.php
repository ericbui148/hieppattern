<?php
namespace ThaoHR\Services\Bonus\Rules;

use ThaoHR\BonusFormula;
use ThaoHR\Services\Bonus\Operands\AndOperand;
use ThaoHR\Services\Bonus\Operands\EqualOperand;
use ThaoHR\Services\Bonus\Operands\GreaterThanOperand;
use ThaoHR\Services\Bonus\Operands\LessThanOperand;
use ThaoHR\Services\Bonus\Operands\LikeOperand;
use ThaoHR\Services\Bonus\Operands\NotEqualOperand;
use ThaoHR\Services\Bonus\Operands\NotLikeOperand;
use ThaoHR\SurveyResult;

abstract class AbsRule
{
    const RULE_NAMESPACE = '\\ThaoHR\\Services\\Bonus\\Rules';
    /**
     * @var array
     */
    protected $resource;

    /**
     * @var SurveyResult
     */
    protected $surveyResult;

    /**
     * @var array
     */
    protected $ruleSchema;


    /**
     * @var string
     */
    protected $type;
    

    public abstract function isStatisfied();

    public function __construct($surveyResult, $ruleSchema)
    {
        $this->surveyResult = $surveyResult;
        $this->resource = json_decode($surveyResult->json, true);
        $this->ruleSchema = $ruleSchema;
    }


    public static function getInstance($ruleName, $surveyResult, $ruleSchema)
    {   
        $clazz = self::RULE_NAMESPACE.'\\'.$ruleName;
        return new $clazz($surveyResult, $ruleSchema);
    }

    public function and(AbsRule $rule)
    {
        return new AndRule($this, $rule);
    }

    public function or(AbsRule $rule)
    {
        return new OrRule($this, $rule);
    }
}