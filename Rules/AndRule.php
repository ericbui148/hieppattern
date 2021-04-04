<?php
namespace ThaoHR\Services\Bonus\Rules;

class AndRule extends AbsRule
{
    /**
     * @var AbsRule
     */
    protected $rule;

    /**
     * @var AbsRule
     */
    protected $andRule;

    public function __construct(AbsRule $rule, AbsRule $andRule)
    {
        $this->rule = $rule;
        $this->andRule = $andRule;
    }

    public function isStatisfied()
    {
        return $this->rule->isStatisfied() && $this->andRule->isStatisfied();
    }
}