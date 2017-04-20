<?php

namespace smtech\StMarksSearch;

/**
 * An object representing a single search result
 *
 * @author Seth Battis <SethBattis@stmarksschool.org>
 */
class SearchResult
{
    use RequireParameter;

    /**
     * URL of the search result
     * @var string
     */
    protected $url;

    /**
     * Description of result's relevance
     * @var Relevance
     */
    protected $relevance;

    /**
     * Human-readable title
     * @var string
     */
    protected $title;

    /**
     * Human-readable description
     *
     * Ideally 20-100 words, may be HTML-formatted (although links should be
     * stripped out).
     * @var string
     */
    protected $description;

    /**
     * Simplified description of search domain source of the result
     * @var SearchSource
     */
    protected $source;

    /**
     * Construct a SearchResult
     *
     * Expects an associative parameter array:
     *
     * ```
     * [
     *   'url' => URL of the search result as a string,
     *   'title' => Title of the search result as a string,
     *   'relevance' => instance of `Relevance`,
     *   'source' => instance of `SearchSource`,
     *   'description' => Optional: search result descriptin as a string
     * ]
     * ```
     *
     * @param mixed[string] $params
     */
    public function __construct($params)
    {
        $this->requireParameter($params, 'url');
        $this->requireParameter($params, 'title');
        $this->requireParameter($params, 'relevance', Relevance::class);
        $this->requireParameter($params, 'source', SearchSource::class);

        $this->defaultParameter($params, 'description', '∅');

        $this->url = $params['url'];
        $this->title = $params['title'];
        $this->relevance = $params['relevance'];
        $this->source = $params['source'];
        $this->description = $params['description'];
    }

    /**
     * Summary of relevance information of the result
     *
     * @return Relevance
     */
    public function getRelevance()
    {
        return $this->relevance;
    }

    /**
     * Title of the search result
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Description of the search result
     *
     * Potentially HTML-formatted, ideally 20-100 words.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * URL of the search result
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Information about the source of the result
     *
     * @return SearchSource
     */
    public function getSource()
    {
        return $this->source;
    }
}
