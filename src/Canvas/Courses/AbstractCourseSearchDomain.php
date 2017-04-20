<?php

namespace smtech\StMarksSearch\Canvas\Courses;

use Exception;
use smtech\CanvasPest\CanvasPest;
use smtech\StMarksSearch\Canvas\AbstractCanvasSearchDomain;

/**
 * Parent object for Canvas course searches
 *
 * @author Seth Battis <SethBattis@stmarksschool.org>
 */
abstract class AbstractCourseSearchDomain extends AbstractCanvasSearchDomain
{
    /**
     * Localize the general Canvas URL to a particular course (if necessary)
     *
     * Will "localize" the `url` parameter after initialization -- i.e. if the
     * URL of the search domain is `https://canvas.instructure.com` and the ID
     * is 43, the URL will be localized to
     * `https://canvas.instructure.com/courses/43`
     *
     * @return void
     * @throws Exception if `id` param does not result in valid Canvas course
     */
    protected function localizeUrl()
    {
        if (!preg_match('%.*/courses/\d+$%', $this->getUrl())) {
            $id = $this->getId();
            if (!is_numeric($id)) {
                $course = $this->getApi()->get("/courses/$id");
                if (!isset($course['id'])) {
                    throw new Exception("Unknown course `id` parameter: '$id'");
                }
                $id = $course['id'];
            }
            $this->setUrl($this->getUrl() . "/courses/{$id}");
        }
    }
}
