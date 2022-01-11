<?php

namespace Delphiki\TogglPlan\Client\Trait;

trait UserProfileTrait
{
    public function getMe(): array
    {
        return $this->get('me');
    }

    public function updateProfile(array $fields): array
    {
        return $this->put('me', $fields);
    }
}