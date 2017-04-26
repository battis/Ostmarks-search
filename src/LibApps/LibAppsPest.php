<?php
/** LibApps class */

namespace smtech\StMarksSearch\LibApps;

use Battis\Educoder\PestJSON;

/**
 * LibApps API wrapper object
 *
 * @author Seth Battis <SethBattis@stmarksschool.org>
 */
class LibAppsPest extends PestJSON
{
    /**
     * LibApps site ID
     * @var string|integer
     */
    private $site_id;

    /**
     * LibApps API access key
     * @var string
     */
    private $key;

    /**
     * Construct a LibAppsPest object
     *
     * @param string|integer $site_id
     * @param string $key
     */
    public function __construct($site_id, $key)
    {
        parent::__construct("https://lgapi-us.libapps.com/1.1");
        $this->site_id = $site_id;
        $this->key = $key;
    }

    /**
     * Prepend `site_id` and `key` to all API requests
     *
     * @param array $data
     * @return string
     */
    protected function http_build_query($data)
    {
        $data['site_id'] = $this->site_id;
        $data['key'] = $this->key;
        return http_build_query($data);
    }
}
