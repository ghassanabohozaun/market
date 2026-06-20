<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\GovernorateRequest;
use App\Services\Dashboard\GovernorateService;
use App\Services\Dashboard\CountryService;
use Illuminate\Http\Request;
use App\Exceptions\DeleteRestrictionException;

class GovernoratesController extends Controller
{
    protected $governorateService, $countryService;

    public function __construct(GovernorateService $governorateService, CountryService $countryService)
    {
        $this->governorateService = $governorateService;
        $this->countryService = $countryService;
    }

    // index
    public function index(Request $request)
    {
        $title = __('addresses.governorates');
        $filters = $request->all();
        $governorates = $this->governorateService->getGovernorates($filters);
        $countries = $this->countryService->getAllCountriesWithoutRelations();

        if ($request->ajax()) {
            return view('dashboard.addresses.governorates.partials._table', compact('governorates'))->render();
        }

        return view('dashboard.addresses.governorates.index', compact('title', 'governorates', 'countries'));
    }

    // create
    public function create()
    {
        $title = __('addresses.create_new_governorate');
        return view('dashboard.addresses.governorates.create', compact('title'));
    }

    // store
    public function store(GovernorateRequest $request)
    {
        $governorate = $this->governorateService->storeGovernorate($request);
        if (!$governorate) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $governorate], 200);
    }

    // show
    public function show(string $id)
    {
        //
    }

    // edit
    public function edit(string $id)
    {
        $title = __('addresses.update_governorate');
        $governorate = $this->governorateService->getGovernorate($id);
        if (!$governorate) {
            flash()->error(__('general.no_record_found'));
            return redirect()->back();
        }
        $countries = $this->countryService->getCountries();
        return view('dashboard.addresses.governorates.edit', compact('title', 'governorate', 'countries'));
    }

    // update
    public function update(GovernorateRequest $request, string $id)
    {
        $governorate = $this->governorateService->getGovernorate($id);

        $governorate = $this->governorateService->updateGovernorate($request, $id);
        if (!$governorate) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $governorate], 201);
    }

    // destroy
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            try {
                $status = $this->governorateService->destroyGovernorate($request->id);
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

    // governorate change status
    public function changeStatus(Request $request)
    {
        $governorate = $this->governorateService->changeStatus($request->id, $request->statusSwitch);

        if (!$governorate) {
            return response()->json(['status' => false], 500);
        }
        $governorate = $this->governorateService->getGovernorate($request->id);
        return response()->json(['status' => true, 'data' => $governorate], 200);
    }

    // autocomplete Governorate
    public function autocompleteGovernorate(Request $request)
    {
        $data = $this->governorateService->autocompleteGovernorate($request->get('q'), $request->get('country_id'));
        return response()->json($data);
    }
}
