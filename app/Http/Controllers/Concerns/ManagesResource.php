<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ManagesResource
{
    abstract protected function getStoragePath(): string;

    abstract protected function getIndexRoute(): string;

    abstract protected function getShowRoute(): string;

    abstract protected function getResourceName(): string;

    protected function processImageUpload(Request $request, ?string $oldImage = null): ?string
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        if ($oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return $request->file('image')->store($this->getStoragePath(), 'public');
    }

    protected function deleteResourceImage(?string $image): void
    {
        if ($image) {
            Storage::disk('public')->delete($image);
        }
    }

    protected function storeResource(Request $request, array $validated, string $relation): \Illuminate\Http\RedirectResponse
    {
        if ($request->hasFile('image')) {
            $validated['image'] = $this->processImageUpload($request);
        }

        $request->user()->{$relation}()->create($validated);

        return redirect()->route($this->getIndexRoute())
            ->with('success', "{$this->getResourceName()} created successfully!");
    }

    protected function updateResource(Request $request, $model, array $validated): \Illuminate\Http\RedirectResponse
    {
        if ($request->hasFile('image')) {
            $validated['image'] = $this->processImageUpload($request, $model->image);
        }

        $model->update($validated);

        return redirect()->route($this->getShowRoute(), $model)
            ->with('success', "{$this->getResourceName()} updated!");
    }

    protected function destroyResource($model): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('delete', $model);

        $this->deleteResourceImage($model->image);
        $model->delete();

        return redirect()->route($this->getIndexRoute())
            ->with('success', "{$this->getResourceName()} deleted!");
    }
}
