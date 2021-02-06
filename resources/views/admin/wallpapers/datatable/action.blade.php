<div class="btn-group btn-group-sm">
    <a href="{{ route('wallpapers.edit', $wallpaper) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
        <button type="button" class="btn btn-danger"
                data-route="{{ route('wallpapers.destroy', $wallpaper) }}"
                data-message="{{ __('wallpapers.table.delete', ['name' => $wallpaper->caption_ru]) }}"
                data-success-message="{{ __('wallpapers.table.deleted', ['name' => $wallpaper->caption_ru]) }}"
                onclick="DatatableHelper.deleteButton(this)">
            <i class="fas fa-times"></i>
        </button>
</div>
