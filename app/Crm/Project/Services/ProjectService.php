<?php

namespace Crm\Project\Services;

use Crm\Project\Events\ProjectCreation;
use Crm\Project\Models\Project;
use Crm\Project\Requests\CreateProject;

class ProjectService
{

    public function createProject(CreateProject $request, int $customerId)
    {
        $project = new Project();
        $project->project_name = $request->project_name;
        $project->status = (bool)$request->status;
        $project->customer_id = $customerId;
        $project->project_cost = (float)$request->status;
        $project->save();

        event(new ProjectCreation($project));
        return $project;
    }
}
