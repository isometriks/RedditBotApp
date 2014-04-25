<?php

namespace Isometriks\Bundle\RedditBotBundle\Model;

class FeedResult implements \IteratorAggregate, \Countable
{
    protected $feed;
    protected $results;

    function __construct(FeedInterface $feed, $results)
    {
        $this->feed = $feed;
        $this->results = $results;
    }

    /**
     * @return FeedInterface
     */
    public function getFeed()
    {
        return $this->feed;
    }

    public function getResults()
    {
        return $this->results;
    }

    public function setResults($results)
    {
        $this->results = $results;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->results);
    }

    public function count()
    {
        return count($this->results);
    }
}
