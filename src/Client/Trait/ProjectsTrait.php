<?php

namespace Delphiki\TogglPlan\Client\Trait;

trait ProjectsTrait
{
    public function getProjects(int $workspaceId): array
    {
        return $this->get(sprintf('%d/projects', $workspaceId));
    }

    public function addProject(int $workspaceId, array $fields): array
    {
        return $this->post(sprintf('%d/projects', $workspaceId), $fields);
    }

    public function getProject(int $workspaceId, int $projectId): array
    {
        return $this->get(sprintf('%d/projects/%d', $workspaceId, $projectId));
    }

    public function updateProject(int $workspaceId, int $projectId, array $fields): array
    {
        return $this->put(sprintf('%d/projects/%d', $workspaceId, $projectId), $fields);
    }

    public function removeProject(int $workspaceId, int $projectId): array
    {
        return $this->delete(sprintf('%d/projects/%d', $workspaceId, $projectId));
    }
}