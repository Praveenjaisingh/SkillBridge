<?php

namespace App\Http\Controllers\Bookmark;

use App\Http\Controllers\Controller;
use App\Services\Bookmark\BookmarkInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class BookmarkController extends Controller
{
    protected $bookmarkInterface;
    public function __construct(BookmarkInterface $bookmarkInterface) 
    {
        $this->bookmarkInterface == $bookmarkInterface;
    }

    public function index(Request $request): Response
    {
        try {
            $bookmarks = $this->bookmarkInterface->paginate($request->only(['search', 'user_id', 'bookmarkable_type']),PaginationHelper::perPage($request));
            return Inertia::render('Bookmark/Index', [
                'bookmarks' => $bookmarks,
                'filters' => $request->only(['search', 'user_id', 'bookmarkable_type']),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Bookmark/Index', [
                'bookmarks' => [],
                'filters' => [],
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function create(): Response
    {
        try {
            return Inertia::render('Bookmark/Create', [
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Bookmark/Create', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->validate([
            'user_id' => 'required|integer',
            'bookmarkable_id' => 'required|integer',
            'bookmarkable_type' => 'required|string|max:255',
            ]);

            $this->bookmarkInterface->create($data);
            return redirect()->route('bookmarks.index')->with('success', 'Bookmark created successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(string $id): Response
    {
        try {
            $bookmark = $this->bookmarkInterface->find((int) $id);

            return Inertia::render('Bookmark/Show', [
                'bookmark' => $bookmark,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Bookmark/Show', [
                'bookmark' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }
    public function edit(string $id): Response
    {
        try {
            $bookmark = $this->bookmarkInterface->find((int) $id);

            return Inertia::render('Bookmark/Edit', [
                'bookmark' => $bookmark,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Bookmark/Edit', [
                'bookmark' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }
    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $data = $request->validate([
            'user_id' => 'sometimes|required|integer',
            'bookmarkable_id' => 'sometimes|required|integer',
            'bookmarkable_type' => 'sometimes|required|string|max:255',
            ]);

            $this->bookmarkInterface->update((int) $id, $data);

            return redirect()->route('bookmarks.index')->with('success', 'Bookmark updated successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->bookmarkInterface->delete((int) $id);

            return redirect()->route('bookmarks.index')->with('success', 'Bookmark deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
