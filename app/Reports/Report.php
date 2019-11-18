<?php

namespace App\Reports;

use Rap2hpoutre\FastExcel\FastExcel;

abstract class Report
{
    protected $query;
    protected $results;

    public function __construct()
    {
        $this->query = $this->query();
    }

    abstract protected function query();

    abstract public function forCampus($campus, $all, $permission_all);

    abstract public function fromDate($value);

    abstract public function toDate($value);
    
    abstract protected function filename();

    abstract public function mapValues($row);

    abstract public function getHeadings();

    public function isEmpty()
    {
        return $this->getResults()->isEmpty();
    }

    public function getResults()
    {
        if (!isset($this->results)) {
            $this->results = $this->query->get()->map([$this, 'mapValues']);
        }
        return $this->results;
    }

    public function getExcel()
    {
        $results = $this->getResults();

        return (new FastExcel($results))->download($this->filename());
    }
}
