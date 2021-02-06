<div class="btn-group btn-group-sm">
    <a href="{{ route('categories.edit', $category) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
        <button type="button" class="btn btn-danger"
                data-route="{{ route('categories.destroy', $category) }}"
                data-message="{{ __('categories.table.delete', ['name' => $category->name_ru]) }}"
                data-success-message="{{ __('categories.table.deleted', ['name' => $category->name_ru]) }}"
                onclick="DatatableHelper.deleteButton(this)">
            <i class="fas fa-times"></i>
        </button>
</div>
