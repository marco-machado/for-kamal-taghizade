<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreItemRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        /** @var Item $item */
        $item = App::make(Item::class);
        $item->name = $request->string('name');
        $item->description = $request->string('description');
        $item->type = $request->integer('type');
        $item->file = $request->file('file')->store('files');
        $item->save();

        return response(new ItemResource($item), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $temporaryUrl = URL::temporarySignedRoute('items.file', now()->addMinutes(10), ['item' => $item]);

        $resource = new ItemResource($item);
        $resource->temporary_url = $temporaryUrl;

        return response($resource);
    }

    /**
     * @param Item $item
     * @return BinaryFileResponse
     */
    public function getFile(Item $item)
    {
        return response()->download($item->file);
    }
}
