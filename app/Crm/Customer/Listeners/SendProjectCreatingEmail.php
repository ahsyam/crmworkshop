<?php

namespace Crm\Customer\Listeners;

use Crm\Customer\Services\CustomerService;
use Crm\Project\Events\ProjectCreation;

class SendProjectCreatingEmail
{
    private CustomerService $customerService;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(ProjectCreation $event)
    {
        $project = $event->getProject();

        $customer = $this->customerService->show($project->customer_id);


    }
}
