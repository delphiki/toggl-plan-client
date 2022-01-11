<?php

namespace Delphiki\TogglPlan\Client\Trait;

trait MilestonesTrait
{
    public function getMilestones(int $workspaceId): array
    {
        return $this->get(sprintf('%d/milestones', $workspaceId));
    }

    public function addMilestone(int $workspaceId, array $fields): array
    {
        return $this->post(sprintf('%d/milestones', $workspaceId), $fields);
    }

    public function getMilestone(int $workspaceId, int $milestoneId): array
    {
        return $this->get(sprintf('%d/milestones/%d', $workspaceId, $milestoneId));
    }

    public function updateMilestone(int $workspaceId, int $milestoneId, array $fields): array
    {
        return $this->put(sprintf('%d/milestones/%d', $workspaceId, $milestoneId), $fields);
    }

    public function removeMilestone(int $workspaceId, int $milestoneId): array
    {
        return $this->delete(sprintf('%d/milestones/%d', $workspaceId, $milestoneId));
    }
}