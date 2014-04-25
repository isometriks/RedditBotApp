<?php

namespace Isometriks\Bundle\RedditBotBundle\Reddit;

use Isometriks\Bundle\RedditBotBundle\Model\FeedResult;
use Isometriks\Bundle\RedditBundle\Reddit\RedditWrapper;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class FeedPoster
{
    protected $wrapper;
    protected $accessor;

    public function __construct(RedditWrapper $wrapper)
    {
        $this->wrapper = $wrapper;
    }

    public function postFeedResults(array $results)
    {
        array_map(array($this, 'postFeed'), $results);
    }

    protected function postFeed(FeedResult $feedResults)
    {
        $feed = $feedResults->getFeed();
        $titleKey = $feed->getOption('title');
        $linkKey = $feed->getOption('link');
        $accessor = $this->getPropertyAccesor();

        foreach ($feedResults as $result) {
            $title = (string)$accessor->getValue($result, $titleKey);
            $link = (string)$accessor->getValue($result, $linkKey);

            $result = $this->wrapper->call('Submit', array(
                'sr' => $feed->getSubreddit(),
                'kind' => 'link',
                'title' => $title,
                'url' => $link,
            ));
        }
    }

    /**
     * @return PropertyAccessor
     */
    protected function getPropertyAccesor()
    {
        if ($this->accessor === null) {
            $this->accessor = PropertyAccess::createPropertyAccessor();
        }

        return $this->accessor;
    }
}
