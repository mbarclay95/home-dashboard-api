<?php

namespace App\Http\Controllers;

use App\Models\ApiModels\FolderApiModel;
use App\Models\Folder;
use App\Models\Site;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FoldersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        /** @var Folder[] $folders */
        $folders = Folder::query()
                         ->get();

        return new JsonResponse(FolderApiModel::fromEntities($folders));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $maxSort = (Folder::query()->max('sort')) ?? 0;

        $folder = new Folder([
            'name' => $request->post('name'),
            'sort' => $maxSort + 1,
            'show' => true
        ]);
        $folder->user()->associate(1);
        $folder->save();

        return new JsonResponse(FolderApiModel::fromEntity($folder));
    }

    /**
     * Display the specified resource.
     *
     * @param Folder $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Folder $folder
     * @return JsonResponse
     */
    public function update(Request $request, Folder $folder): JsonResponse
    {
        $folder->name = $request->post('name');
        $folder->show = $request->post('show');
        $folder->save();

        return new JsonResponse(FolderApiModel::fromEntity($folder));
    }

    public function updateFolderSorts(Request $request): JsonResponse
    {
        $data = $request->post('data');

        foreach ($data as $movedSort) {
            Folder::query()
                  ->where('id', '=', $movedSort['id'])
                  ->update(['sort' => $movedSort['sort']]);
        }

        return new JsonResponse(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Folder $folder
     * @return JsonResponse
     */
    public function destroy(Folder $folder): JsonResponse
    {
        $updateSortFolders = Folder::query()
                                   ->where('sort', '>', $folder->sort)
                                   ->get();

        /** @var Folder $updateSortFolder */
        foreach ($updateSortFolders as $updateSortFolder) {
            $updateSortFolder->sort -= 1;
            $updateSortFolder->save();
        }

        $folder->delete();

        return new JsonResponse(['success' => true]);
    }
}
