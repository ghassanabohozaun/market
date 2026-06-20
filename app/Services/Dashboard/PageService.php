<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\PageRepository;
use App\Utils\ImageManagerUtils;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PageService
{
    protected $pageRepository, $imageManagerUtils;

    // __construct
    public function __construct(PageRepository $pageRepository, ImageManagerUtils $imageManagerUtils)
    {
        $this->pageRepository = $pageRepository;
        $this->imageManagerUtils = $imageManagerUtils;
    }

    // get page
    public function getPage($id)
    {
        $page = $this->pageRepository->getPage($id);
        if (!$page) {
            return false;
        }
        return $page;
    }

    // get pages
    public function getPages()
    {
        return $this->pageRepository->getPages();
    }

    // get pages paginated
    public function getPagesPaginated($filters = [], $perPage = 10)
    {
        return $this->pageRepository->getPagesPaginated($filters, $perPage);
    }


    // store page
    public function store($data)
    {
        if (array_key_exists('photo', $data) && $data['photo'] != null) {
            $photo_name = $this->imageManagerUtils->saveResizeImage($data['photo'], 'pages', 1700, 1000);
            $data['photo'] = $photo_name;
        }

        $data['slug'] = [
            'ar' => slug($data['title']['ar']),
            'en' => slug($data['title']['en']),
        ];

        $page = $this->pageRepository->store($data);
        if (!$page) {
            return false;
        }
        return $page;
    }

    // update page
    public function update($data)
    {
        $page = self::getPage($data['id']);

        if (array_key_exists('photo', $data) && $data['photo'] != null) {
            //remove old photo
            $this->imageManagerUtils->removeImageFromLocal($page->photo, 'pages');
            $photo_name = $this->imageManagerUtils->saveResizeImage($data['photo'], 'pages', 1700, 1000);
            $data['photo'] = $photo_name;
        }

        $data['slug'] = [
            'ar' => slug($data['title']['ar']),
            'en' => slug($data['title']['en']),
        ];

        $page = $this->pageRepository->update($page, $data);
        if (!$page) {
            return false;
        }
        return $page;
    }

    //destroy page
    public function destroy($id)
    {
        $page = self::getPage($id);

        //remove old photo
        if ($page->photo != null) {
            $this->imageManagerUtils->removeImageFromLocal($page->photo, 'pages');
        }

        $page = $this->pageRepository->destroy($page);
        if (!$page) {
            return false;
        }
        return $page;
    }

    // change status
    public function changeStatus($id, $status)
    {
        $page = self::getPage($id);
        $result = $this->pageRepository->changeStatus($page, $status);
        if (!$result) {
            return false;
        }
        return $page->refresh();
    }


}
