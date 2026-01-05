<?php namespace XFRM\Controller;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Object\Pagination;
use XFRM\Object\ResourceUpdate as ResourceUpdate;
use XFRM\Util\RequestUtil as Req;

class ResourceUpdateController
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getResourceUpdate()
    {
        if (Req::checkIdParam()) {
            $update = $this->database->getResourceUpdate($_GET['id']);
            if (!is_null($update) && $update !== false) {
                return new ResourceUpdate($update);
            }
        }

        return NULL;
    }

    public function getResourceUpdates()
    {
        $out = new \stdClass();

        if (Req::checkIdParam()) {
            $updates = $this->database->getResourceUpdates($_GET['id'], Req::page());

            if (is_null($updates)) {
                return NULL;
            }

            $out->pagination = new Pagination(count($updates), 10, (Req::page() - 1) * 10);
            $out->result = [];

            foreach ($updates as $update) {
                $out->result[] = new ResourceUpdate($update);
            }
        }

        return $out;
    }
}
