<?php
namespace ThaoHR\Services\Bonus\Rules;

class OrRule extends AbsRule
{
    /**
     * @var AbsRule
     */
    protected $rule;

    /**
     * @var AbsRule
     */
    protected $orRule;

    public function __construct(AbsRule $rule, AbsRule $orRule)
    {
        $this->rule = $rule;
        $this->orRule = $orRule;
    }

    public function isStatisfied()
    {
        return $this->rule->isStatisfied() || $this->orRule->isStatisfied();
    }
}