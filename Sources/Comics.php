<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 7/25/19
 * Time: 1:37 PM
 */

namespace Sources;

use Classes\Source;
use Goutte\Client as GoutteClient;
use GuzzleHttp\Client;

/**
 * Class Comics
 * @package Sources
 */
class Comics extends Source
{

    /**
     * Return the response of api
     * @return array
     */
    public function getResponse(): array
    {
        $records = $this->getPostDetails($this->crawlArchive());

        foreach ($records as $index => $record) {
            $this->index = $index;
            $this->setNumber($record['num']);
            $this->setDate($index,
                $record['day'] . '-' . $record['month'] . '-' . $record['year']);
            $this->setName($record['safe_title']);
            $this->setLink($record['link']);
            $this->setDetails($record['alt']);
        }

        return $this->result;
    }

    /**
     * Crawl XKCD.com archive page to get list of posts
     * @return array
     */
    public function crawlArchive()
    {
        $post_ids = [];
        $client = new GoutteClient();
        $response = $client->request('GET', 'https://xkcd.com/archive');
        $response->filter('#middleContainer > a[title]')->each(function ($node) use (&$post_ids) {
            if (substr($node->attr('title'), 0, 4) == $this->year) {
                if (--$this->limit < 0) {
                    return;
                }
                $post_ids[] = trim($node->attr('href'), '/');
            }
        });

        return $post_ids;
    }

    /**
     * get details of posts from api
     * @param $ids
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPostDetails($ids)
    {
        $client = new Client();

        $details = [];

        foreach ($ids as $id) {
            $res = $client->request('GET',
                'https://xkcd.com/' . $id . '/info.0.json', [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-type' => 'application/json'
                    ]
                ]);

            $details[] = json_decode($res->getBody(), true);

        }
        return $details;
    }
}