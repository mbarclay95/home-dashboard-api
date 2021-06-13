<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SiteImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $file = $request->file('file');
        $path = Storage::disk('s3')->put('site-images', $file);

        return new JsonResponse(['imagePath' => $path]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $siteId
     * @return StreamedResponse
     * @throws FileNotFoundException
     */
    public function show(int $siteId): StreamedResponse
    {
        /** @var Site $site */
        $site = Site::query()->find($siteId);

        $file = Storage::disk('s3')->get($site->s3_path);

        return response()->stream(function () use ($file) {
            echo $file;
        }, 200, ['Content-Type' => 'image/png']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
