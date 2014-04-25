<?php

namespace Isometriks\Bundle\RedditBotBundle\Model;

class Feed implements FeedInterface
{
    protected $url;
    protected $subreddit;
    protected $flair = array();
    protected $options = array();

    public function __construct($url, $subreddit, array $flair, array $options)
    {
        $this->url = $url;
        $this->subreddit = $subreddit;
        $this->flair = $flair;
        $this->options = $options;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getSubreddit()
    {
        return $this->subreddit;
    }

    public function setSubreddit($subreddit)
    {
        $this->subreddit = $subreddit;

        return $this;
    }

    public function getFlair()
    {
        return $this->flair;
    }

    public function setFlair(array $flair)
    {
        $this->flair = $flair;

        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    public function getOption($option)
    {
        if (!array_key_exists($option, $this->options)) {
            throw new \InvalidArgumentException(sprintf('Option "%s" does not exist', $option));
        }

        return $this->options[$option];
    }

    public function setOption($option, $value)
    {
        $this->options[$option] = $value;
    }
}
