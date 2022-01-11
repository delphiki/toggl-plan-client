<?php

namespace Delphiki\TogglPlan\Client\Trait;

trait GroupsTrait
{
    public function getGroups(int $workspaceId, array $filters = []): array
    {
        return $this->get(sprintf('%d/groups%s',
            $workspaceId,
            count($filters) > 0 ? '?'.http_build_query($filters) : ''
        ));
    }

    public function addGroup(int $workspaceId, array $fields): array
    {
        return $this->post(sprintf('%d/groups', $workspaceId), $fields);
    }

    public function getGroup(int $workspaceId, int $groupId): array
    {
        return $this->get(sprintf('%d/groups/%d', $workspaceId, $groupId));
    }

    public function updateGroup(int $workspaceId, int $groupId, array $fields): array
    {
        return $this->put(sprintf('%d/groups/%d', $workspaceId, $groupId), $fields);
    }

    public function removeGroup(int $workspaceId, int $groupId): array
    {
        return $this->delete(sprintf('%d/groups/%d', $workspaceId, $groupId));
    }

    public function getGroupMemberships(int $workspaceId, int $groupId): array
    {
        return $this->get(sprintf('%d/groups/%d/memberships', $workspaceId, $groupId));
    }

    public function addUserToGroup(int $workspaceId, int $groupId, array $userData): array
    {
        return $this->post(sprintf('%d/groups/%d/memberships', $workspaceId, $groupId), $userData);
    }

    public function removeGroupMembership(int $workspaceId, int $groupId, int $membershipId): array
    {
        return $this->delete(sprintf('%d/groups/%d/memberships/%d', $workspaceId, $groupId, $membershipId));
    }
}