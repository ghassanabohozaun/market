<?php

namespace App\Repositories\Dashboard;

use App\Models\Page;

class PageRepository
{
    // get page
    public function getPage($id)
    {
        return Page::find($id);
    }

    // get pages
    public function getPages()
    {
        return Page::latest()->get();
    }

    // get pages paginated
    public function getPagesPaginated($filters = [], $perPage = 10)
    {
        return Page::query()
            ->when(!empty($filters['search_term']), function ($q) use ($filters) {
                $q->where('title->ar', 'like', '%' . $filters['search_term'] . '%')
                  ->orWhere('title->en', 'like', '%' . $filters['search_term'] . '%');
            })
            ->when(isset($filters['status']) && $filters['status'] !== '', function ($q) use ($filters) {
                $q->where('status', $filters['status']);
            })
            ->latest()
            ->paginate($perPage);
    }

    // store page
    public function store($data)
    {
        return Page::create($data);
    }

    // update page
    public function update($page, $data)
    {
        return $page->update($data);
    }

    //destroy page
    public function destroy($page)
    {
        return $page->forceDelete();
    }

    public function changeStatus($page, $status)
    {
        $page->update([
            'status' => $status,
        ]);
        return $page;
    }


}
