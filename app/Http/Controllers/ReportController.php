<?php

namespace App\Http\Controllers;

use App\Reports\ReportGenerator;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private $reports;

    public function __construct(ReportGenerator $reports)
    {
        $this->reports = $reports;
    }

    public function index(Request $request)
    {
        if ($request->type) {
            $report = $this->reports
                ->ofType($request->type)
                ->fromDate($request->start)
                ->toDate($request->end);
        }

        return view('reports.index')->with([
            'types' => $this->reports->types(),
            'filters' => $request->input(),
            'results' => isset($report) ? $report->getResults() : [],
            'headings' => isset($report) ? $report->getHeadings() : []
        ]);
    }
}
