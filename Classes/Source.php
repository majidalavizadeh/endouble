<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 7/24/19
 * Time: 1:40 AM
 */

namespace Classes;


/**
 * Class Source
 * This is a contract to use for developing a new source
 * @package Classes
 */
abstract class Source
{

    /**
     * @var array
     */
    protected $result = [];

    /**
     * @var
     */
    protected $year;

    /**
     * @var
     */
    protected $limit;

    /**
     * @var
     */
    protected $index;

    /**
     * Return the response of API
     * @return array
     */
    abstract public function getResponse(): array;

    /**
     * Source constructor.
     * @param $year
     * @param $limit
     */
    public function __construct($year, $limit)
    {
        $this->year = $year;
        $this->limit = $limit;
    }

    /**
     * @param $value
     */
    protected function setNumber($value)
    {
        $this->result[$this->index]['number'] = $value;
    }

    /**
     * @param $value
     */
    protected function setDate($value)
    {
        $this->result[$this->index]['date'] = $value;
    }

    /**
     * @param $value
     */
    protected function setName($value)
    {
        $this->result[$this->index]['name'] = $value;
    }

    /**
     * @param $value
     */
    protected function setLink($value)
    {
        $this->result[$this->index]['link'] = $value;
    }

    /**
     * @param $value
     */
    protected function setDetails($value)
    {
        $this->result[$this->index]['details'] = $value;
    }

}