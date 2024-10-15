<div class="text-center">
    {{--Update Button--}}
    <a href="{{ route('exports.edit', $export->id) }}" title="@lang('locale.Edit Export')" class="action-btn me-50 text-warning"><i class="fa fa-pencil"></i></a>

    {{--Delete Button--}}
    <a href="#" title="@lang('locale.Delete Export')" class="action-btn text-danger del-btn"><i class="fa fa-trash"></i></a>
    <form action="{{ route('exports.destroy', $export->id) }}" method="post" class="delete-btn-form d-inline">
        @method('DELETE')
        @csrf
    </form>
</div>
