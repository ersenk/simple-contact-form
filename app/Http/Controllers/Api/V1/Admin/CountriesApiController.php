<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Resources\Admin\CountryResource;
use App\Models\Country;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountriesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('country_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CountryResource(Country::all());
    }

    public function store(StoreCountryRequest $request)
    {
        $country = Country::create($request->all());

        if ($request->input('flag', false)) {
            $country->addMedia(storage_path('tmp/uploads/' . basename($request->input('flag'))))->toMediaCollection('flag');
        }

        return (new CountryResource($country))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Country $country)
    {
        abort_if(Gate::denies('country_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CountryResource($country);
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->update($request->all());

        if ($request->input('flag', false)) {
            if (! $country->flag || $request->input('flag') !== $country->flag->file_name) {
                if ($country->flag) {
                    $country->flag->delete();
                }
                $country->addMedia(storage_path('tmp/uploads/' . basename($request->input('flag'))))->toMediaCollection('flag');
            }
        } elseif ($country->flag) {
            $country->flag->delete();
        }

        return (new CountryResource($country))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Country $country)
    {
        abort_if(Gate::denies('country_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $country->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
