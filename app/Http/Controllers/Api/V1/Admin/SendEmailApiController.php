<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSendEmailRequest;
use App\Http\Requests\UpdateSendEmailRequest;
use App\Http\Resources\Admin\SendEmailResource;
use App\Models\SendEmail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SendEmailApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('send_email_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SendEmailResource(SendEmail::with(['user', 'contact', 'email_template', 'team'])->get());
    }

    public function store(StoreSendEmailRequest $request)
    {
        $sendEmail = SendEmail::create($request->all());

        return (new SendEmailResource($sendEmail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SendEmail $sendEmail)
    {
        abort_if(Gate::denies('send_email_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SendEmailResource($sendEmail->load(['user', 'contact', 'email_template', 'team']));
    }

    public function update(UpdateSendEmailRequest $request, SendEmail $sendEmail)
    {
        $sendEmail->update($request->all());

        return (new SendEmailResource($sendEmail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SendEmail $sendEmail)
    {
        abort_if(Gate::denies('send_email_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sendEmail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
