<?php

namespace Delphiki\TogglPlan\Client\Trait;

trait MembersTrait
{
    public function addMember(int $workspaceId, array $memberData): array
    {
        return $this->post(sprintf('%d/dummy_users', $workspaceId), $memberData);
    }

    public function updateDummyMember(int $workspaceId, int $memberId, array $memberData): array
    {
        return $this->put(sprintf('%d/dummy_users/%d', $workspaceId, $memberId), $memberData);
    }

    public function getMembers(int $workspaceId): array
    {
        return $this->get(sprintf('%d/members', $workspaceId));
    }

    public function getMember(int $workspaceId, int $memberId): array
    {
        return $this->get(sprintf('%d/members/%d', $workspaceId, $memberId));
    }

    public function updateMember(int $workspaceId, int $memberId, array $fields): array
    {
        return $this->put(sprintf('%d/members/%d', $workspaceId, $memberId), $fields);
    }

    public function removeMember(int $workspaceId, int $memberId): array
    {
        return $this->delete(sprintf('%d/members/%d', $workspaceId, $memberId));
    }

}