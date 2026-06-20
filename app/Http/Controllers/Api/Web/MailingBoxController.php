<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\MailingBoxRequest;
use App\Http\Resources\MailingBoxResource;
use App\Services\Api\MailingBoxService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class MailingBoxController extends Controller
{
    use ApiResponse;

    protected $mailingBoxService;

    public function __construct(MailingBoxService $mailingBoxService)
    {
        $this->mailingBoxService = $mailingBoxService;
    }

    // get mailing list
    public function mailingList()
    {
        $mailingList = $this->mailingBoxService->getMailingList();
        $data = ['mailing_list' => MailingBoxResource::collection($mailingList)];
        return $this->ApiResponse($data, true, __('general.data_fetch_successfully'), 200);
    }

    // store email
    public function store(MailingBoxRequest $request)
    {
        $mailing = $this->mailingBoxService->store($request->validated());
        $data = ['mailing' => new MailingBoxResource($mailing)];
        return $this->ApiResponse($data, true, __('general.add_success_message'), 200);
    }
}
