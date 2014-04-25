<?php

namespace Isometriks\Bundle\RedditBundle\Reddit;

class RedditWrapper
{
    protected $factory;
    protected $client;

    public function __construct($user, $password)
    {
        $this->factory = new \Reddit\Api\Client\Factory();
        $this->client = $this->factory->createClient();

        // Login
        $login = $this->client->getCommand('Login', array(
            'api_type'  => 'json',
            'user'      => $user,
            'passwd'    => $password,
        ));

        $result = $login->execute();

        if (count($result['json']['errors'])) {
            throw new \Exception(print_r($result['json']['errors'], true));
        }
    }

    public function getClient()
    {
        return $this->client;
    }

    public function call($command, $arguments)
    {
        $request = $this->getClient()->getCommand($command, $arguments);

        return $request->execute();
    }
}
