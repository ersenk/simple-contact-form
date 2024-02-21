<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySendEmailRequest;
use App\Http\Requests\StoreSendEmailRequest;
use App\Http\Requests\UpdateSendEmailRequest;
use App\Models\Contact;
use App\Models\EmailTemplate;
use App\Models\SendEmail;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SendEmailController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('send_email_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sendEmails = SendEmail::with(['user', 'contact', 'email_template', 'team'])->get();

        return view('admin.sendEmails.index', compact('sendEmails'));
    }

    public function create()
    {
        abort_if(Gate::denies('send_email_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contacts = Contact::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $email_templates = EmailTemplate::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sendEmails.create', compact('contacts', 'email_templates', 'users'));
    }

    public function store(StoreSendEmailRequest $request)
    {
        $sendEmail = SendEmail::create($request->all());

        return redirect()->route('admin.send-emails.index');
    }

    public function edit(SendEmail $sendEmail)
    {
        abort_if(Gate::denies('send_email_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contacts = Contact::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $email_templates = EmailTemplate::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sendEmail->load('user', 'contact', 'email_template', 'team');

        return view('admin.sendEmails.edit', compact('contacts', 'email_templates', 'sendEmail', 'users'));
    }

    public function update(UpdateSendEmailRequest $request, SendEmail $sendEmail)
    {
        $sendEmail->update($request->all());

        return redirect()->route('admin.send-emails.index');
    }

    public function show(SendEmail $sendEmail)
    {
        abort_if(Gate::denies('send_email_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sendEmail->load('user', 'contact', 'email_template', 'team');

        return view('admin.sendEmails.show', compact('sendEmail'));
    }

    public function destroy(SendEmail $sendEmail)
    {
        abort_if(Gate::denies('send_email_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sendEmail->delete();

        return back();
    }

    public function massDestroy(MassDestroySendEmailRequest $request)
    {
        $sendEmails = SendEmail::find(request('ids'));

        foreach ($sendEmails as $sendEmail) {
            $sendEmail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
