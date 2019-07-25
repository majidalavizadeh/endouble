<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 7/24/19
 * Time: 1:01 AM
 */

namespace Classes;

use Carbon\Carbon;
use Utils\Response;

/**
 * Class Api
 * @package Classes
 */
class Api
{

    /**
     * @var
     */
    private $source;

    /**
     * @var
     */
    private $limit;

    /**
     * @var
     */
    private $year;

    /**
     * @var string
     */
    protected $sourceClassesNamespace = "\Sources";

    /**
     * @param $source
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @param $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param $year
     * @return $this
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * Show result as JSON
     */
    public function getJson()
    {
        // check for source is exists or not
        if (!class_exists($this->getClassName($this->source))) {
            Response::json('Source does not exists', 404);
            return;
        }

        // get the result from sources
        $result = $this->getInstance($this->getClassName($this->source))->getResponse();

        // json response
        Response::json([
            'meta' => [
                "request" => [
                    "sourceId" => $this->source,
                    "year" => $this->year,
                    "limit" => $this->limit
                ],
                "timestamp" => Carbon::now()
            ],
            'data' => $result
        ]);

    }

    /**
     * return the class name with namespace
     * @param $type
     * @return string
     */
    public function getClassName($type)
    {
        return $this->sourceClassesNamespace . '\\' . ucwords($type);
    }

    /**
     * return the instance of source object
     * @param $class
     * @return mixed
     */
    public function getInstance($class)
    {
        return new $class($this->year, $this->limit);
    }
}