<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Wallpaper;
use App\Services\MediaService;
use Illuminate\Console\Command;

class SetBase64PreviewWallpaper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wallpaper:preview-generate {--refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate preview images';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): bool
    {
        $refresh = $this->option('refresh');
        Wallpaper::when(!$refresh, fn($query) => $query->whereNull('preview_base64'))
            ->chunkById(10, function ($items) {
                $items->map(function ($item) {
                    MediaService::setBase64Preview($item);
                });
            });

        echo 'finish';
        return true;
    }
}
