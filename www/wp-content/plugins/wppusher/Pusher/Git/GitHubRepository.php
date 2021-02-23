<?php

namespace Pusher\Git;

use Exception;

class GitHubRepository extends Repository
{
    public $code = 'gh';

    public function getZipUrl()
    {
        $url = 'https://api.github.com/repos/' . $this->handle . '/zipball/' . urlencode($this->getBranch()) . '?dir=/wppusher';

        if (! $this->isPrivate()) {
            return  $url;
        }

        add_filter('http_request_args', array($this, 'gitHubTokenAuth'), 10, 2 );

        return $url;
    }

    public function gitHubTokenAuth($args, $url)
    {
        $token = get_option('gh_token');

        if ( is_string($token) && $token === '')
            throw new Exception('No GitHub token stored.');

        $args['headers']['Authorization'] = "token {$token}";

        return $args;
    }
}
