<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBadgeSettingAPIRequest;
use App\Http\Requests\API\UpdateBadgeSettingAPIRequest;
use App\Models\BadgeSetting;
use App\Repositories\BadgeSettingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BadgeSettingController
 * @package App\Http\Controllers\API
 */

class BadgeSettingAPIController extends AppBaseController
{
    /** @var  BadgeSettingRepository */
    private $badgeSettingRepository;

    public function __construct(BadgeSettingRepository $badgeSettingRepo)
    {
        $this->badgeSettingRepository = $badgeSettingRepo;
    }

    /**
     * Display a listing of the BadgeSetting.
     * GET|HEAD /badgeSettings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $badgeSettings = $this->badgeSettingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($badgeSettings->toArray(), 'Badge Settings retrieved successfully');
    }

    /**
     * Store a newly created BadgeSetting in storage.
     * POST /badgeSettings
     *
     * @param CreateBadgeSettingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBadgeSettingAPIRequest $request)
    {
        $input = $request->all();

        $badgeSetting = $this->badgeSettingRepository->create($input);

        return $this->sendResponse($badgeSetting->toArray(), 'Badge Setting saved successfully');
    }

    /**
     * Display the specified BadgeSetting.
     * GET|HEAD /badgeSettings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var BadgeSetting $badgeSetting */
        $badgeSetting = $this->badgeSettingRepository->find($id);

        if (empty($badgeSetting)) {
            return $this->sendError('Badge Setting not found');
        }

        return $this->sendResponse($badgeSetting->toArray(), 'Badge Setting retrieved successfully');
    }

    /**
     * Update the specified BadgeSetting in storage.
     * PUT/PATCH /badgeSettings/{id}
     *
     * @param int $id
     * @param UpdateBadgeSettingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBadgeSettingAPIRequest $request)
    {
        $input = $request->all();

        /** @var BadgeSetting $badgeSetting */
        $badgeSetting = $this->badgeSettingRepository->find($id);

        if (empty($badgeSetting)) {
            return $this->sendError('Badge Setting not found');
        }

        $badgeSetting = $this->badgeSettingRepository->update($input, $id);

        return $this->sendResponse($badgeSetting->toArray(), 'BadgeSetting updated successfully');
    }

    /**
     * Remove the specified BadgeSetting from storage.
     * DELETE /badgeSettings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var BadgeSetting $badgeSetting */
        $badgeSetting = $this->badgeSettingRepository->find($id);

        if (empty($badgeSetting)) {
            return $this->sendError('Badge Setting not found');
        }

        $badgeSetting->delete();

        return $this->sendSuccess('Badge Setting deleted successfully');
    }
}
