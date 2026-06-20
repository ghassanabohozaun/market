<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\NotificationRequest;
use App\Http\Resources\NotificationResource;
use App\Services\Api\NotificationService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    use ApiResponse;

    protected $notificationService;
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    // get notifications
    public function notifications()
    {
        $notifications = $this->notificationService->getNotifications();
        $data = ['notifications' => NotificationResource::collection($notifications)];
        return $this->ApiResponse($data, true, __('general.data_fetch_successfully'), 200);
    }

    public function store(NotificationRequest $request)
    {
        $notification = $this->notificationService->store($request->validated());
        $data = ['notification' => new NotificationResource($notification)];
        return $this->ApiResponse($data, true, __('general.add_success_message'), 200);
    }
}
