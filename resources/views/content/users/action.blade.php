<div class="text-center">
    @can ('update-user', $user)
        {{--Password Update Button--}}
        <a href="{{ route('users.reset.password', $user->id) }}" title="@lang('locale.Change Password')" class="action-btn me-50 text-dark"><i class="fa fa-key"></i></a>
        {{--Update Button--}}
        <a href="{{ route('users.edit', $user->id) }}" title="@lang('locale.Edit User')" class="action-btn me-50 text-warning"><i class="fa fa-pencil"></i></a>
    @endif

    {{--Delete Button--}}
    @can ('delete-user', $user)
        <a href="#" title="@lang('locale.Delete User')" class="action-btn text-danger del-btn"><i class="fa fa-trash"></i></a>
        <form action="{{ route('users.destroy', $user->id) }}" method="post" class="delete-btn-form d-inline">
            @method('DELETE')
            @csrf
        </form>
    @endif
</div>
