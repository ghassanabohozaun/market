<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdminRequest;
use App\Services\Dashboard\AdminService;
use App\Services\Dashboard\RoleService;
use Illuminate\Http\Request;
use App\Exceptions\DeleteRestrictionException;

class AdminsController extends Controller
{
    protected $adminService, $roleService;
    //  __construct
    public function __construct(AdminService $adminService, RoleService $roleService)
    {
        $this->adminService = $adminService;
        $this->roleService = $roleService;
    }

    //  admin index
    public function index(Request $request)
    {
        $title = __('admins.admins');
        $filters = $request->all();
        $admins = $this->adminService->getAdmins($filters);
        $roles = $this->roleService->getRoles();

        if ($request->ajax()) {
            return view('dashboard.admins.partials._table', compact('admins'))->render();
        }

        return view('dashboard.admins.index', compact('title', 'admins', 'roles'));
    }

    //  admin create
    public function create()
    {
        $title = __('admins.create_new_admin');
        $roles = $this->roleService->getRoles();
        return view('dashboard.admins.create', compact('title', 'roles'));
    }

    //  admin store
    public function store(AdminRequest $request)
    {
        $data = $request->except(['_token', '_method']);
        $admin = $this->adminService->storeAdmin($data);
        if (!$admin) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $admin], 200);
    }

    //  admin show
    public function show(string $id)
    {
        //
    }

    //  admin edit
    public function edit(string $id)
    {
        $title = __('admins.update_admin');
        $admin = $this->adminService->getAdmin($id);
        $roles = $this->roleService->getRoles();
        if (!$admin) {
            flash()->error(__('general.no_record_found'));
            return redirect()->route('dashboard.admins.index');
        }
        return view('dashboard.admins.edit', compact('title', 'admin', 'roles'));
    }

    //  admin update
    public function update(AdminRequest $request, string $id)
    {
        $data = $request->except(['_token', '_method']);
        $admin = $this->adminService->updateAdmin($data);
        if (!$admin) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $admin], 201);
    }

    //  admin destroy
    public function destroy(Request $request)
    {
        try {
            $admin = $this->adminService->destroyAdmin($request->id);
            if (!$admin) {
                return response()->json(['status' => false], 500);
            }

            return response()->json(['status' => true], 200);
        } catch (DeleteRestrictionException $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['status' => false], 500);
        }
    }

    // admin change status
    public function changeStatus(Request $request)
    {
        $admin = $this->adminService->changeStatusAdmin($request->id, $request->statusSwitch);

        if (!$admin) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $admin], 200);
    }



}
