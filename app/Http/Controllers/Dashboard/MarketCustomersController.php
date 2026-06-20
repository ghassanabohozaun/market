<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MarketCustomerRequest;
use App\Services\Dashboard\MarketCustomerService;
use Illuminate\Http\Request;
use App\Exceptions\DeleteRestrictionException;

class MarketCustomersController extends Controller
{
    protected $marketCustomerService;

    // __construct
    public function __construct(MarketCustomerService $marketCustomerService)
    {
        $this->marketCustomerService = $marketCustomerService;
    }

    // index
    public function index(Request $request)
    {
        $title = __('market.customers');
        $filters = $request->all();
        $market_customers = $this->marketCustomerService->getMarketCustomers($filters);

        if ($request->ajax()) {
            return view('dashboard.market_customers.partials._table', compact('market_customers'))->render();
        }

        return view('dashboard.market_customers.index', compact('title', 'market_customers'));
    }

    // create
    public function create()
    {
        $title = __('market.create_new_customer');
        return view('dashboard.market_customers.create', compact('title'));
    }

    // store
    public function store(MarketCustomerRequest $request)
    {
        $data = $request->only(['name', 'phone', 'balance']);
        $customer = $this->marketCustomerService->storeMarketCustomer($data);
        if (!$customer) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $customer], 200);
    }

    //show
    public function show(string $id)
    {
        //
    }

    //edit
    public function edit(string $id)
    {
        $title = __('market.update_customer');
        $market_customer = $this->marketCustomerService->getMarketCustomer($id);
        if (!$market_customer) {
            flash()->error(__('general.no_record_found'));
            return redirect()->back();
        }
        return view('dashboard.market_customers.edit', compact('title', 'market_customer'));
    }

    // update
    public function update(MarketCustomerRequest $request, string $id)
    {
        $customer = $this->marketCustomerService->getMarketCustomer($id);
        if (!$customer) {
            flash()->error(__('general.no_record_found'));
            return redirect()->back();
        }

        $data = $request->only(['name', 'phone', 'balance']);
        $customer = $this->marketCustomerService->updateMarketCustomer($data, $id);
        if (!$customer) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $customer], 200);
    }

    // destroy
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            try {
                $status = $this->marketCustomerService->destroyMarketCustomer($request->id);
                if ($status === 'success') {
                    return response()->json(['status' => true], 200);
                } elseif ($status === 'not_found') {
                    return response()->json(['status' => false, 'message' => __('general.no_record_found')], 404);
                }
                return response()->json(['status' => false, 'message' => __('general.error')], 500);
            } catch (DeleteRestrictionException $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 422);
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
            }
        }
    }
}
