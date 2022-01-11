<?php

namespace Delphiki\TogglPlan\Client\Trait;

trait TasksTrait
{
    public function getTasks(int $workspaceId, array $filters = []): array
    {
        return $this->get(sprintf('%d/tasks/timeline%s',
            $workspaceId,
            count($filters) > 0 ? '?'.http_build_query($filters) : ''
        ));
    }

    public function addTask(int $workspaceId, array $fields): array
    {
        return $this->post(sprintf('%d/tasks', $workspaceId), $fields);
    }

    public function getTask(int $workspaceId, int $taskId): array
    {
        return $this->get(sprintf('%d/tasks/%d', $workspaceId, $taskId));
    }

    public function updateTask(int $workspaceId, int $taskId, array $fields): array
    {
        return $this->put(sprintf('%d/tasks/%d', $workspaceId, $taskId), $fields);
    }

    public function removeTask(int $workspaceId, int $taskId): array
    {
        return $this->delete(sprintf('%d/tasks/%d', $workspaceId, $taskId));
    }
}