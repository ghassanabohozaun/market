<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CityRequest;
use App\Services\Dashboard\CityService;
use App\Services\Dashboard\GovernorateService;
use Illuminate\Http\Request;
use App\Exceptions\DeleteRestrictionException;

class CitiesController extends Controller
{
    protected $cityService, $governorateService;

    public function __construct(CityService $cityService, GovernorateService $governorateService)
    {
        $this->cityService = $cityService;
        $this->governorateService = $governorateService;
    }
    // index
    public function index(Request $request)
    {
        $title = __('addresses.cities');
        $filters = $request->all();
        $cities = $this->cityService->getCities($filters);
        $governorates = $this->governorateService->getAllGovernoratesWithoutRelation();

        if ($request->ajax()) {
            return view('dashboard.addresses.cities.partials._table', compact('cities'))->render();
        }

        return view('dashboard.addresses.cities.index', compact('title', 'cities', 'governorates'));
    }

    // create
    public function create()
    {
        $title = __('addresses.create_new_city');
        return view('dashboard.addresses.cities.create', compact('title'));
    }

    // store
    public function store(CityRequest $request)
    {
        $city = $this->cityService->storeCity($request);
        if (!$city) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $city], 200);
    }

    // show
    public function show(string $id)
    {
        //
    }

    // edit
    public function edit(string $id)
    {
        $title = __('addresses.update_city');
        $city = $this->cityService->getCity($id);
        if (!$city) {
            flash()->error(__('general.no_record_found'));
            return redirect()->back();
        }
        $governorates = $this->governorateService->getAllGovernoratesWithoutRelation();
        return view('dashboard.addresses.cities.edit', compact('title', 'city', 'governorates'));
    }

    // update
    public function update(CityRequest $request, string $id)
    {
        $city = $this->cityService->getCity($id);

        $city = $this->cityService->updateCity($request, $id);
        if (!$city) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $city], 201);
    }

    // destroy
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            try {
                $status = $this->cityService->destroyCity($request->id);
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

    // city change status
    public function changeStatus(Request $request)
    {
        $city = $this->cityService->changeStatus($request->id, $request->statusSwitch);

        if (!$city) {
            return response()->json(['status' => false], 500);
        }
        $city = $this->cityService->getCity($request->id);
        return response()->json(['status' => true, 'data' => $city], 200);
    }

    // autocomplete City
    public function autocompleteCity(Request $request)
    {
        $data = $this->cityService->autocompleteCity($request->get('q'), $request->get('governorate_id') ?: $request->get('country_id'));
        return response()->json($data);
    }
}
