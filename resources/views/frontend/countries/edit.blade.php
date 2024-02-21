@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.country.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.countries.update", [$country->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="flag">{{ trans('cruds.country.fields.flag') }}</label>
                            <div class="needsclick dropzone" id="flag-dropzone">
                            </div>
                            @if($errors->has('flag'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('flag') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.flag_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone_code">{{ trans('cruds.country.fields.phone_code') }}</label>
                            <input class="form-control" type="text" name="phone_code" id="phone_code" value="{{ old('phone_code', $country->phone_code) }}">
                            @if($errors->has('phone_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.phone_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.country.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $country->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="short_code">{{ trans('cruds.country.fields.short_code') }}</label>
                            <input class="form-control" type="text" name="short_code" id="short_code" value="{{ old('short_code', $country->short_code) }}" required>
                            @if($errors->has('short_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('short_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.short_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.country.fields.active') }}</label>
                            <select class="form-control" name="active" id="active">
                                <option value disabled {{ old('active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Country::ACTIVE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('active', $country->active) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.active_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.flagDropzone = {
    url: '{{ route('frontend.countries.storeMedia') }}',
    maxFilesize: 20, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="flag"]').remove()
      $('form').append('<input type="hidden" name="flag" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="flag"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($country) && $country->flag)
      var file = {!! json_encode($country->flag) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="flag" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection