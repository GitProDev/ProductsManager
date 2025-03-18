<?php

namespace Inovector\ProductManager\Events;

use Illuminate\Queue\SerializesModels;

class FiltersApplied
{
    use SerializesModels;

    public $userId;
    public $filters;

    public function __construct($userId, array $filters)
    {
        $this->userId = $userId;
        $this->filters = $filters;
    }
}
