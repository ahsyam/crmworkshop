<?php

namespace Crm\Customer\Listeners;

use Crm\Customer\Events\CustomerCreation;

class NotifySalesOnCustomerCreation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Crm\Customer\Events\CustomerCreation  $event
     * @return void
     */
    public function handle(CustomerCreation $event)
    {
        $customer = $event->getCustomer();
    }
}
