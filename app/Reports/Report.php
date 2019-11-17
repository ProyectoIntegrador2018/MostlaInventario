<?php

namespace App\Reports;

abstract class Report
{
    protected $query;

    abstract public function fromDate($value);

    abstract public function toDate($value);

    abstract public function getExcel();

    abstract public function getHeadings();

    public function getResults()
    {
        return $this->query->get();
    }
}
