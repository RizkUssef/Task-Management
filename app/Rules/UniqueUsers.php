<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use App\Models\User;

class UniqueUsers implements ValidationRule
{
    public function __construct(protected ?int $ignore_user_id = null){}
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $tenantId = app('currentTenant')->id;

        $exists = User::query()
            ->where('email', $value)
            ->where('tenant_id', $tenantId)
            ->when($this->ignore_user_id, fn ($query) => $query->where('id', '!=', $this->ignore_user_id))
            ->exists();

        if ($exists) {
            $fail('This email is already registered in this organization.');
        }
    }
}
