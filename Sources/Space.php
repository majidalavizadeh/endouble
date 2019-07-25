<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 7/24/19
 * Time: 1:24 AM
 */

namespace Sources;

use Carbon\Carbon;
use Classes\Source;
use GuzzleHttp\Client;

/**
 * Class Space
 * @package Sources
 */
class Space extends Source
{

    /**
     * Return response of api
     * @return array
     */
    public function getResponse(): array
    {
        $records = $this->fetchRecords();
        foreach ($records as $index => $record) {
            $this->index = $index;
            $this->setNumber($record['flight_number']);
            $this->setDate(Carbon::parse($record['launch_date_unix'])->format('Y-m-d'));
            $this->setName($record['mission_name']);
            $this->setLink($record['links']['wikipedia']);
            $this->setDetails($record['details']);
        }

        return $this->result;
    }


    /**
     * fetch the records from SpaceX API
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetchRecords()
    {
        $client = new Client();

        $res = $client->request('GET',
            'https://api.spacexdata.com/v2/launches?launch_year=' . $this->year . '&limit=' . $this->limit, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json'
                ]
            ]);

        return json_decode($res->getBody(), true);
    }
}