<?php

namespace Isometriks\Bundle\RedditBotBundle\DependencyInjection\Definition;

use Symfony\Component\DependencyInjection\Definition;

class FeedDefinition extends Definition
{
    public function __construct($url, $subreddit, array $flair = array(), array $options = array())
    {
        parent::__construct('%isometriks_reddit_bot.model.feed.class%', array($url, $subreddit, $flair, $options));
    }
}
