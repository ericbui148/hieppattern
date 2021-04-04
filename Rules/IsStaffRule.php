<?php
namespace ThaoHR\Services\Bonus\Rules;

use ThaoHR\Role;
use ThaoHR\User;

class IsStaffRule extends AbsRule implements IMetaData
{
    static public function getMetadata() {
        return [
            "value" => 'IsStaffRule',
            "name" => __('Là nhân viên'),
            "fields" => ['type'],
        ];
    }

    public function isStatisfied()
    {
        $affiliateId = $this->surveyResult->affiliate_id;
        $user = User::find($affiliateId);
        $role = Role::where('name', 'Affiliate')->first();
        return $user->role_id != $role->id;
    }
}