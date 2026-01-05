<?php

namespace XFRM\Object;

defined('_XFRM_API') or exit('No direct script access allowed here.');

class Pagination
{
    public $count;
    public $limit;
    public $offset;

    /**
     * @param int $count
     * @param int $limit
     * @param int $offset
     */
    public function __construct($count, $limit, $offset)
    {
        $this->count = $count;
        $this->limit = $limit;
        $this->offset = $offset;
    }
}
