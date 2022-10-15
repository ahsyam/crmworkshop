<?php

namespace App\Http\Controllers;

use Crm\Customer\Services\CustomerService;
use Crm\Project\Requests\CreateProject;
use Crm\Project\Services\ProjectService;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    private ProjectService $projectService;
    private CustomerService $customerService;

    public function __construct(ProjectService $projectService,CustomerService $customerService)
    {
        $this->projectService = $projectService;
        $this->customerService = $customerService;
    }


    public function createProject(CreateProject $request, $customerId)
    {
        $customer = $this->customerService->show($customerId);
        if( !$customer ) {
            return response()->json(['status'=> 'Customer Not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->projectService->createProject($request, $customerId);
    }

}
