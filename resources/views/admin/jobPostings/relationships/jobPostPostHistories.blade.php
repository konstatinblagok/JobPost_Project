@can('post_history_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.post-histories.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.postHistory.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.postHistory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-jobPostPostHistories">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.postHistory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.postHistory.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.postHistory.fields.job_post') }}
                        </th>
                        <th>
                            {{ trans('cruds.postHistory.fields.post_location') }}
                        </th>
                        <th>
                            {{ trans('cruds.postHistory.fields.url') }}
                        </th>
                        <th>
                            {{ trans('cruds.postHistory.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($postHistories as $key => $postHistory)
                        <tr data-entry-id="{{ $postHistory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $postHistory->id ?? '' }}
                            </td>
                            <td>
                                {{ $postHistory->title ?? '' }}
                            </td>
                            <td>
                                {{ $postHistory->job_post->title ?? '' }}
                            </td>
                            <td>
                                {{ $postHistory->post_location->url ?? '' }}
                            </td>
                            <td>
                                {{ $postHistory->url ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\PostHistory::STATUS_SELECT[$postHistory->status] ?? '' }}
                            </td>
                            <td>
                                @can('post_history_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.post-histories.show', $postHistory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('post_history_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.post-histories.edit', $postHistory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('post_history_delete')
                                    <form action="{{ route('admin.post-histories.destroy', $postHistory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('post_history_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.post-histories.massDestroy') }}",
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
  let table = $('.datatable-jobPostPostHistories:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection