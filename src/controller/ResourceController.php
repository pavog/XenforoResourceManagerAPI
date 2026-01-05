<?php namespace XFRM\Controller;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Object\Pagination;
use XFRM\Object\Resource as Resource;
use XFRM\Util\RequestUtil as Req;

class ResourceController
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function listResources()
    {
        $resources = $this->database->listResources(Req::category(), Req::page());

        if (is_null($resources)) {
            return NULL;
        }

        $out = new \stdClass();
        $out->pagination = new Pagination(count($resources), 10, (Req::page() - 1) * 10);
        $out->result = [];

        foreach ($resources as $resource) {
            $out->result[] = new Resource($resource);
        }

        return $out;
    }

    public function getResource()
    {
        if (Req::checkIdParam()) {
            $resource = $this->database->getResource(Req::id());

            if (!is_null($resource) && $resource !== false) {
                return new Resource($resource);
            }
        }

        return NULL;
    }

    public function getResourcesByAuthor()
    {
        $out = new \stdClass();

        if (Req::checkIdParam()) {
            $resources = $this->database->getResourcesByUser(Req::id(), Req::page());

            if (is_null($resources)) {
                return NULL;
            }

            $out->pagination = new Pagination(count($resources), 10, (Req::page() - 1) * 10);
            $out->result = [];

            foreach ($resources as $resource) {
                $out->result[] = new Resource($resource);
            }
        }

        return $out;
    }
}
