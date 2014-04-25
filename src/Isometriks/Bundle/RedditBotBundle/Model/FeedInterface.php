<?php

namespace Isometriks\Bundle\RedditBotBundle\Model;

interface FeedInterface
{
    public function getUrl();
    public function setUrl($url);

    public function getFlair();
    public function setFlair(array $flair);

    public function getSubreddit();
    public function setSubreddit($subreddit);

    public function getOptions();
    public function setOptions(array $options);
    public function getOption($option);
    public function setOption($option, $value);
}
