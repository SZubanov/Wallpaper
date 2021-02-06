<div class="btn-group btn-group-sm">
    <a href="{{ route('users.edit', $user) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
        <button type="button" class="btn btn-danger"
                data-route="{{ route('users.destroy', $user) }}"
                data-message="{{ __('users.table.delete', ['name' => $user->name]) }}"
                data-success-message="{{ __('users.table.deleted', ['name' => $user->name]) }}"
                onclick="DatatableHelper.deleteButton(this)">
            <i class="fas fa-times"></i>
        </button>
</div>
