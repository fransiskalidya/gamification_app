<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateBadgeSettingRequest;
use App\Http\Requests\UpdateBadgeSettingRequest;
use App\Repositories\BadgeSettingRepository;
use Flash;
use Illuminate\Http\Request;
use Response;

class LevelSettingController extends AppBaseController
{
    /** @var BadgeSettingRepository $badgeSettingRepository*/
    private $badgeSettingRepository;

    public function __construct(BadgeSettingRepository $badgeSettingRepo)
    {
        $this->badgeSettingRepository = $badgeSettingRepo;
    }

    /**
     * Display a listing of the BadgeSetting.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $badgeSettings = $this->badgeSettingRepository->paginate(10);

        return view('admin.badge_settings.index')
            ->with('badgeSettings', $badgeSettings);
    }

    /**
     * Show the form for creating a new BadgeSetting.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.badge_settings.create');
    }

    /**
     * Store a newly created BadgeSetting in storage.
     *
     * @param CreateBadgeSettingRequest $request
     *
     * @return Response
     */
    public function store(CreateBadgeSettingRequest $request)
    {
        $input = $request->all();

        $badgeSetting = $this->badgeSettingRepository->create($input);

        Flash::success('Badge Setting saved successfully.');

        return redirect(route('admin.badgeSettings.index'));
    }

    /**
     * Display the specified BadgeSetting.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $badgeSetting = $this->badgeSettingRepository->find($id);

        if (empty($badgeSetting)) {
            Flash::error('Badge Setting not found');

            return redirect(route('admin.badgeSettings.index'));
        }

        return view('admin.badge_settings.show')->with('badgeSetting', $badgeSetting);
    }

    /**
     * Show the form for editing the specified BadgeSetting.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $badgeSetting = $this->badgeSettingRepository->find($id);

        if (empty($badgeSetting)) {
            Flash::error('Badge Setting not found');

            return redirect(route('admin.badgeSettings.index'));
        }

        return view('admin.badge_settings.edit')->with('badgeSetting', $badgeSetting);
    }

    /**
     * Update the specified BadgeSetting in storage.
     *
     * @param int $id
     * @param UpdateBadgeSettingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBadgeSettingRequest $request)
    {
        $badgeSetting = $this->badgeSettingRepository->find($id);

        if (empty($badgeSetting)) {
            Flash::error('Badge Setting not found');

            return redirect(route('admin.badgeSettings.index'));
        }

        $badgeSetting = $this->badgeSettingRepository->update($request->all(), $id);

        Flash::success('Badge Setting updated successfully.');

        return redirect(route('admin.badgeSettings.index'));
    }

    /**
     * Remove the specified BadgeSetting from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $badgeSetting = $this->badgeSettingRepository->find($id);

        if (empty($badgeSetting)) {
            Flash::error('Badge Setting not found');

            return redirect(route('admin.badgeSettings.index'));
        }

        $this->badgeSettingRepository->delete($id);

        Flash::success('Badge Setting deleted successfully.');

        return redirect(route('admin.badgeSettings.index'));
    }
}
