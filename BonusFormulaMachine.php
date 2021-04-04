<?php
namespace ThaoHR\Services\Bonus;


use ThaoHR\BonusFormula;
use ThaoHR\Services\Bonus\Rules\AbsRule;
use ThaoHR\Survey;
use ThaoHR\SurveyResult;

class BonusFormulaMachine {
    /**
     * @var BonusFormula
     */
    private $bonusFormula;
    /**
     * @var SurveyResult
     */
    private $surveyResult;

    public function __construct(SurveyResult $surveyResult, BonusFormula $bonusFormula)
    {
        $this->bonusFormula = $bonusFormula;
        $this->surveyResult = $surveyResult;
    }


    public function isMatched()
    {
        $rule = null;
        $ruleSchemas = json_decode($this->bonusFormula->if_clause, true);
        foreach ($ruleSchemas as $ruleSchema) {
            if (is_null($rule)) {
                $rule = AbsRule::getInstance($ruleSchema['type'], $this->surveyResult, $ruleSchema);
            } else {
                $tmpRule = AbsRule::getInstance($ruleSchema['type'], $this->surveyResult, $ruleSchema);
                if ($ruleSchema['logic_condition'] == 'and') {
                    $rule = $rule->and($tmpRule);
                } elseif ($ruleSchema['logic_condition'] == 'or') {
                    $rule = $rule->or($tmpRule);
                }
            }

        }
        return !empty($rule) && $rule->isStatisfied();
    }
}
