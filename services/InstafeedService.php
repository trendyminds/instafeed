<?php
/**
 * Instafeed plugin for Craft CMS
 *
 * Instafeed Service
 *
 * @author    TrendyMinds
 * @copyright Copyright (c) 2018 TrendyMinds
 * @link      https://trendyminds.com
 * @package   Instafeed
 * @since     1.0.0
 */

namespace Craft;

class InstafeedService extends BaseApplicationComponent
{
    protected $oauthToken;
    protected $cacheDuration;

    private function fetch($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);

        if ($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            throw new Exception("There was an error with your cURL request! ({$errno}):\n {$error_message}");
        }

        curl_close($ch);

        return $output;
    }

    public function __construct()
    {
        $settings = craft()->plugins->getPlugin('instafeed')->getSettings();

        if (!$settings->oauthToken) {
            throw new Exception('You have not setup an OAuth token in the Instafeed plugin settings. Please use a valid token to fetch Instagram API data.');
        }

        $this->oauthToken = $settings->oauthToken;
        $this->cacheDuration = $settings->cacheDuration;
    }

    public function getPosts()
    {
        if (craft()->cache->get('posts')) {
            $posts = craft()->cache->get('posts');
        } else {
            $response = $this->fetch("https://api.instagram.com/v1/users/self/media/recent/?access_token=$this->oauthToken");
            $response = json_decode($response);

            if ($response->meta->code != 200) {
                throw new Exception("The following error was encountered when fetching your Instagram data:\n" . $response->meta->error_type . ": " . $response->meta->error_message);
            }

            $posts = $response->data;
            craft()->cache->set('posts', $posts, $this->cacheDuration);
        }

        return $posts;
    }
}
