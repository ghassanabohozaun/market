<?php

namespace App\Repositories\Dashboard;

use App\Models\Testimonial;

class TestimonialRepository
{
    public function getTestimonial($id)
    {
        return Testimonial::find($id);
    }

    public function getTestimonials($filters = [])
    {
        return Testimonial::when(!empty($filters['search_term']), function ($query) use ($filters) {
                $query->where(function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['search_term'] . '%')
                        ->orWhere('title', 'like', '%' . $filters['search_term'] . '%')
                        ->orWhere('content', 'like', '%' . $filters['search_term'] . '%');
                });
            })
            ->when(isset($filters['status']) && $filters['status'] !== '', function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function storeTestimonial($data)
    {
        return Testimonial::create($data);
    }

    public function updateTestimonial($testimonial, $data)
    {
        return $testimonial->update($data);
    }

    public function destroyTestimonial($testimonial)
    {
        return $testimonial->delete();
    }

    public function changeStatusTestimonial($testimonial, $status)
    {
        return $testimonial->update([
            'status' => $status,
        ]);
    }
}
