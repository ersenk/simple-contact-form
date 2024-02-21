@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('contact_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.contacts.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.contact.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.contact.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Contact">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contact.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contact.fields.responsible_user') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contact.fields.first_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contact.fields.last_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contact.fields.country') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contact.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contact.fields.meeting_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contact.fields.budget') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contact.fields.number_of_bedrooms') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $key => $contact)
                                    <tr data-entry-id="{{ $contact->id }}">
                                        <td>
                                            {{ $contact->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contact->responsible_user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contact->first_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contact->last_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contact->country->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contact->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contact->meeting_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Contact::BUDGET_SELECT[$contact->budget] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Contact::NUMBER_OF_BEDROOMS_SELECT[$contact->number_of_bedrooms] ?? '' }}
                                        </td>
                                        <td>
                                            @can('contact_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.contacts.show', $contact->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('contact_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.contacts.edit', $contact->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('contact_delete')
                                                <form action="{{ route('frontend.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('contact_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.contacts.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Contact:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
