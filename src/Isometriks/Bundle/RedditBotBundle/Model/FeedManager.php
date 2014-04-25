<?php

namespace Isometriks\Bundle\RedditBotBundle\Model;

use Debril\RssAtomBundle\Protocol\FeedReader;
use Isometriks\Bundle\RedditBotBundle\Model\FeedResult;

class FeedManager
{
    protected $reader;
    protected $feeds;

    public function __construct(FeedReader $reader, array $feeds)
    {
        $this->reader = $reader;
        $this->feeds = $feeds;
    }

    /**
     * @return FeedInterface
     */
    public function getFeeds()
    {
        return $this->feeds;
    }

    /**
     * @return FeedResult
     */
    public function getFeedResults($dateOrOffset = null)
    {
        if ($dateOrOffset instanceof \DateTime) {
            $date = $dateOrOffset;
        } elseif (is_string($dateOrOffset)) {
            $date = new \DateTime();
            $date->modify($dateOrOffset);
        } elseif ($dateOrOffset === null) {
            $date = new \DateTime();
            $date->modify('-1 hours');
        } else {
            throw new \InvalidArgumentException('Invalid date or offset');
        }

        $results = array();

        foreach ($this->getFeeds() as $feed) {
            $feedData = $this->reader->getFeedContent($feed->getUrl(), $date);
            $results[] = new FeedResult($feed, $feedData->getItems());
        }

        return $results;
    }
}
