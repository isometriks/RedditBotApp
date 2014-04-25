<?php

namespace Isometriks\Bundle\RedditBotBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PostFeedsCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName('reddit:bot:rss')
            ->setDescription('Post configured feeds to Reddit')
            ->addArgument('dateOffset', InputArgument::IS_ARRAY, 'A string for \DateTime->modify(), eg "-1 days", "-1 hours" etc')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $offset = implode(' ', $input->getArgument('dateOffset'));

        $feedManager = $this->getContainer()->get('isometriks_reddit_bot.feed_manager');
        $feedPoster = $this->getContainer()->get('isometriks_reddit_bot.feed_poster');

        $results = $feedManager->getFeedResults($offset);
        $feedPoster->postFeedResults($results);

        foreach ($results as $feedResult) {
            $output->writeln(sprintf('Posted %d items from %s to: /r/%s', count($feedResult), $feedResult->getFeed()->getUrl(), $feedResult->getFeed()->getSubreddit()));
        }
    }
}
