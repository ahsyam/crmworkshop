<?php

namespace App\Http\Controllers;

use Crm\Base\ResponseBuilder;
use Crm\Customer\Requests\CreateCustomer;
use Crm\Customer\Services\CustomerExportService;
use Crm\Customer\Services\CustomerService;
use Crm\Customer\Services\Export\ExportFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    private CustomerService $customerService;
    private CustomerExportService $customerExportService;

    public function __construct(CustomerService $customerService, CustomerExportService $customerExportService)
    {
        $this->customerService = $customerService;
        $this->customerExportService = $customerExportService;
    }

    public function index(Request $request)
    {
        $customer = $this->customerService->index($request);
        return reponseBuilder()
            ->setData($customer)
            ->response();
    }

    public function show($id)
    {
        $customer = $this->customerService->show($id);
        if(!$customer) {
            return reponseBuilder()
                ->setStatusCode(JsonResponse::HTTP_NOT_FOUND)
                ->setErrors(['generic' => 'Customer not found'])
                ->response();
        }
        return reponseBuilder()
            ->setData($customer)
            ->response();
    }

    public function create(CreateCustomer $request)
    {
        return $this->customerService->create($request->name);
    }


    public function update(Request $request, $id)
    {
        return $this->customerService->update($request, $id);
    }


    public function delete(Request $request, $id)
    {
        return $this->customerService->delete($request, (int) $id);
    }

    public function export(Request $request)
    {
        $format = $request->get('format','json');
        $exporter = ExportFactory::instance($format);
        $this->customerExportService->export($exporter);
    }

}
