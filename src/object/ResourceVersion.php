<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

class ResourceVersion
{
    public $id;
    public $resource_id;
    public $update_id;
    public $version;
    public $download_count;
    public $release_date;
    public $external_download_url;

    public function __construct($version)
    {
        $this->id = $version['resource_version_id'];
        $this->resource_id = $version['resource_id'];
        // NULL for versions without a visible update (e.g. created without an update message)
        $this->update_id = $version['resource_update_id'];
        $this->version = $version['version_string'];
        $this->download_count = $version['download_count'];
        $this->release_date = $version['release_date'];
        $this->external_download_url = $version['download_url'];
    }
}
