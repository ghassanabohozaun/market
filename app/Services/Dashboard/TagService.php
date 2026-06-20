<?php

namespace App\Services\Dashboard;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class TagService
{
    protected $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function getTags($filters = [])
    {
        return $this->tag->query()
            ->when(!empty($filters['search_term']), function ($query) use ($filters) {
                $query->where(function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['search_term'] . '%')
                      ->orWhere('slug', 'like', '%' . $filters['search_term'] . '%');
                });
            })
            ->when(isset($filters['status']) && $filters['status'] !== '', function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->latest()
            ->paginate(10);
    }

    public function getAll()
    {
        return $this->tag->active()->get();
    }

    public function getTag($id)
    {
        return $this->tag->find($id);
    }

    public function store(array $data)
    {
        try {
            $data['status'] = !empty($data['status']) ? 1 : 0;
            
            // Set translatable slug based on name
            $data['slug'] = [];
            foreach (['ar', 'en'] as $lang) {
                if (isset($data['name'][$lang])) {
                    $data['slug'][$lang] = Str::slug($data['name'][$lang]);
                }
            }

            return $this->tag->create($data);
        } catch (\Exception $e) {
            Log::error('Tag store error: ' . $e->getMessage());
            return false;
        }
    }

    public function update(array $data)
    {
        try {
            $tag = $this->getTag($data['id']);
            if (!$tag) return false;

            $data['status'] = !empty($data['status']) ? 1 : 0;
            
            // Update translatable slug based on name
            $data['slug'] = [];
            foreach (['ar', 'en'] as $lang) {
                if (isset($data['name'][$lang])) {
                    $data['slug'][$lang] = Str::slug($data['name'][$lang]);
                }
            }

            $tag->update($data);
            return $tag;
        } catch (\Exception $e) {
            Log::error('Tag update error: ' . $e->getMessage());
            return false;
        }
    }

    public function destroy($id)
    {
        $tag = $this->getTag($id);
        if (!$tag) return 'not_found';

        // Check for restrictive relations (throws DeleteRestrictionException if blocked)
        if (method_exists($tag, 'checkRestrictiveRelations')) {
            $tag->checkRestrictiveRelations();
        }
        
        $result = $tag->delete();
        return $result ? 'success' : 'failed';
    }

    public function changeStatus($id, $status)
    {
        try {
            $tag = $this->getTag($id);
            if (!$tag) return false;

            $tag->update(['status' => $status]);
            return $tag;
        } catch (\Exception $e) {
            return false;
        }
    }
}
