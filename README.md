/r/symfony Bot
=========

Right now it's really only useful for RSS feeds, here's the configuration:

```yaml
# Reddit Wrapper Config
isometriks_reddit:
    user: %bot_user%
    password: %bot_password%

# Bot RSS Config
isometriks_reddit_bot:
    feeds:
        symfony2_blog:
            url: http://feeds.feedburner.com/symfony/blog
            subreddit: symfony
            flair:
                - news
            options:
                link: publicId
        symfony2_community:
            url: http://feeds.feedburner.com/symfony/planet?format=xml
            subreddit: symfony
            flair:
                - community
            options:
                link: publicId
```

The `%bot_user%` and `%bot_password%` will come from paramenters.yml and are set
in parameters.yml.dist if you use composer. You can use a cron job to make the
command run every hour by default or send an argument after:

    0 * * * * php /home/symfonybot/app/console reddit:bot:rss

You can send arguments after to tell the bot how long to check:

    php app/console reddit:bot:rss 5 hours ago

*Please note that you cannot use something like "-5 hours" as a command.
The Symfony command component tries to recognize it as a flag. We're using
an input as an array and then imploding on a space " " to turn it into a string.

TODO
=====

- Add Flair after post is submitted