<div class="text-center">
        {{--Update Button--}}
        <a href="{{ route('references.edit', $reference->id) }}" title="@lang('locale.Edit Reference')" class="action-btn me-50 text-warning"><i class="fa fa-pencil"></i></a>

    {{--Delete Button--}}
        <a href="#" title="@lang('locale.Delete Reference')" class="action-btn text-danger del-btn"><i class="fa fa-trash"></i></a>
        <form action="{{ route('references.destroy', $reference->id) }}" method="post" class="delete-btn-form d-inline">
            @method('DELETE')
            @csrf
        </form>
</div>
