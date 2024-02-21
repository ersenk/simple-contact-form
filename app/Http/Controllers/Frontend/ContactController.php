<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContactRequest;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contact_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contacts = Contact::with(['responsible_user', 'country', 'team'])->orderBy('created_at','DESC')->get();

        return view('frontend.contacts.index', compact('contacts'));
    }

    public function create()
    {
        abort_if(Gate::denies('contact_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsible_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.contacts.create', compact('countries', 'responsible_users', 'teams'));
    }

    public function store(StoreContactRequest $request)
    {
        $contact = Contact::create($request->all());
        return redirect()->route('frontend.contacts.index');
    }
    public function storepublic(StoreContactRequest $request)
    {
        // Concatenate country code and mobile number
        $updatedMobile = $request->input('country_code') . $request->input('phone');
        // Update the request data with the concatenated mobile number
        $request->merge([
            'phone' => $updatedMobile,
        ]);
        // Update the request data with the default team id to 1
        // By default we hide all forms from members.
        // Unless they are in default team called "Simple Team"
        $request->merge([
            'team_id' => 1,
        ]);

        $contact = Contact::create($request->all());
        return redirect()->back()->with('message', 'Your form reached us successfully! We will back you soon');
    }

    public function edit(Contact $contact)
    {
        abort_if(Gate::denies('contact_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsible_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contact->load('responsible_user', 'country', 'team');

        return view('frontend.contacts.edit', compact('contact', 'countries', 'responsible_users', 'teams'));
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->all());

        return redirect()->route('frontend.contacts.index');
    }

    public function show(Contact $contact)
    {
        abort_if(Gate::denies('contact_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact->load('responsible_user', 'country', 'team', 'contactSendEmails');

        return view('frontend.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        abort_if(Gate::denies('contact_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactRequest $request)
    {
        $contacts = Contact::find(request('ids'));

        foreach ($contacts as $contact) {
            $contact->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
