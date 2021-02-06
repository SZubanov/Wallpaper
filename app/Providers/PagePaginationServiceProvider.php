<?php


namespace App\Providers;

use App\Components\PagePaginator;
use App\Components\OffsetPaginator;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\ServiceProvider;

class PagePaginationServiceProvider extends ServiceProvider
{
    private $maxSize = 50;
    private $defaultSize = 15;
    private $sizeParam = 'size';
    private $pageParam = 'page';

    public function boot()
    {
        $this->registerMacro();
    }

    /**
     * Create Macros for the Builders.
     */
    public function registerMacro()
    {
        $maxTotal = $this->maxSize;
        $defaultLimit = $this->defaultSize;
        $limit = $this->sizeParam;
        $pageParam = $this->pageParam;
        $macro = function ($perPage = null, $columns = ['*'], array $options = [])
        use ($maxTotal, $defaultLimit, $limit, $pageParam) {
            if (!$perPage) {
                $perPage = (int)(request($limit) ?? $defaultLimit);
            }
            $perPage = $perPage > $maxTotal ? $maxTotal : $perPage;
            $page = (int)request($pageParam) ?? 0;
            $page = ($page < 1) ? 1 : $page;
            $options['page'] = $page;
            $offset = ($page - 1) * $perPage;
            // Limit results
            $this->skip($offset)->limit($perPage);
            $total = $this->toBase()->getCountForPagination();
            return new PagePaginator($this->get($columns), $perPage, $total, $options);
        };
        // Register macros
        QueryBuilder::macro('pagePaginate', $macro);
        EloquentBuilder::macro('pagePaginate', $macro);
    }
}
