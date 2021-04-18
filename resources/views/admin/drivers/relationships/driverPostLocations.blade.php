@can('post_location_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.post-locations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.postLocation.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.postLocation.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-driverPostLocations">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.postLocation.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.postLocation.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.postLocation.fields.url') }}
                        </th>
                        <th>
                            {{ trans('cruds.postLocation.fields.driver') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($postLocations as $key => $postLocation)
                        <tr data-entry-id="{{ $postLocation->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $postLocation->id ?? '' }}
                            </td>
                            <td>
                                {{ $postLocation->title ?? '' }}
                            </td>
                            <td>
                                {{ $postLocation->url ?? '' }}
                            </td>
                            <td>
                                {{ $postLocation->driver->name ?? '' }}
                            </td>
                            <td>
                                @can('post_location_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.post-locations.show', $postLocation->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('post_location_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.post-locations.edit', $postLocation->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('post_location_delete')
                                    <form action="{{ route('admin.post-locations.destroy', $postLocation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('post_location_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.post-locations.massDestroy') }}",
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
  let table = $('.datatable-driverPostLocations:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection