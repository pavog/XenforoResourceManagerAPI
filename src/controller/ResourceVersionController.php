<?php namespace XFRM\Controller;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Object\ResourceVersion as ResourceVersion;
use XFRM\Util\RequestUtil as Req;

class ResourceVersionController
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getResourceVersion()
    {
        if (Req::checkIdParam()) {
            $version = $this->database->getResourceVersion($_GET['id']);
            if (!is_null($version) && $version !== false) {
                return new ResourceVersion($version);
            }
        }

        return NULL;
    }

    public function getResourceVersions()
    {
        $out = [];

        if (Req::checkIdParam()) {
            $versions = $this->database->getResourceVersions($_GET['id'], Req::page(), Req::order(), Req::direction());
            if (is_null($versions)) return NULL;

            foreach ($versions as $version) {
                $out[] = new ResourceVersion($version);
            }
        }

        return $out;
    }
}
