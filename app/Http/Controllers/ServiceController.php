<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ManagesResource;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ManagesResource;

    protected function getStoragePath(): string
    {
        return 'services';
    }

    protected function getIndexRoute(): string
    {
        return 'services.index';
    }

    protected function getShowRoute(): string
    {
        return 'services.show';
    }

    protected function getResourceName(): string
    {
        return 'Service';
    }

    public function index(Request $request)
    {
        $query = Service::where('status', 'active')->with('user', 'category');

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        if ($request->filled('price_type')) {
            $query->where('price_type', $request->price_type);
        }
        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', $search)
                  ->orWhere('description', 'like', $search);
            });
        }

        $services = $query->latest()->paginate(12);
        $categories = Category::where('type', 'service')->get();

        return view('services.index', compact('services', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('type', 'service')->get();
        return view('services.create', compact('categories'));
    }

    public function store(StoreServiceRequest $request)
    {
        return $this->storeResource($request, $request->validated(), 'services');
    }

    public function show(Service $service)
    {
        $service->load('user', 'category', 'reviews.user');
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $this->authorize('update', $service);
        $categories = Category::where('type', 'service')->get();
        return view('services.edit', compact('service', 'categories'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        return $this->updateResource($request, $service, $request->validated());
    }

    public function destroy(Service $service)
    {
        return $this->destroyResource($service);
    }
}
