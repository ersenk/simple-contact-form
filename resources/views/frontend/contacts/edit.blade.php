@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.contact.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.contacts.update", [$contact->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="responsible_user_id">{{ trans('cruds.contact.fields.responsible_user') }}</label>
                            <select class="form-control select2" name="responsible_user_id" id="responsible_user_id">
                                @foreach($responsible_users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('responsible_user_id') ? old('responsible_user_id') : $contact->responsible_user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('responsible_user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('responsible_user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contact.fields.responsible_user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="first_name">{{ trans('cruds.contact.fields.first_name') }}</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" value="{{ old('first_name', $contact->first_name) }}" required>
                            @if($errors->has('first_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('first_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contact.fields.first_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="last_name">{{ trans('cruds.contact.fields.last_name') }}</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" value="{{ old('last_name', $contact->last_name) }}" required>
                            @if($errors->has('last_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contact.fields.last_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="country_id">{{ trans('cruds.contact.fields.country') }}</label>
                            <select class="form-control select2" name="country_id" id="country_id">
                                @foreach($countries as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : $contact->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contact.fields.country_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="phone">{{ trans('cruds.contact.fields.phone') }}</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', $contact->phone) }}" required>
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contact.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="meeting_date">{{ trans('cruds.contact.fields.meeting_date') }}</label>
                            <input class="form-control datetime" type="text" name="meeting_date" id="meeting_date" value="{{ old('meeting_date', $contact->meeting_date) }}" required>
                            @if($errors->has('meeting_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('meeting_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contact.fields.meeting_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.contact.fields.budget') }}</label>
                            <select class="form-control" name="budget" id="budget" required>
                                <option value disabled {{ old('budget', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Contact::BUDGET_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('budget', $contact->budget) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('budget'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('budget') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contact.fields.budget_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.contact.fields.number_of_bedrooms') }}</label>
                            <select class="form-control" name="number_of_bedrooms" id="number_of_bedrooms" required>
                                <option value disabled {{ old('number_of_bedrooms', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Contact::NUMBER_OF_BEDROOMS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('number_of_bedrooms', $contact->number_of_bedrooms) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('number_of_bedrooms'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('number_of_bedrooms') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contact.fields.number_of_bedrooms_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="team_id">{{ trans('cruds.contact.fields.team') }}</label>
                            <select class="form-control select2" name="team_id" id="team_id">
                                @foreach($teams as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('team_id') ? old('team_id') : $contact->team->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('team'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('team') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contact.fields.team_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection