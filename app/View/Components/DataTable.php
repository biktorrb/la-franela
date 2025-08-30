<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    public $headers;
    public $data;
    public $rows;
    public $striped;
    public $hoverable;

    public function __construct($headers, $data, $rows = [], $striped = false, $hoverable = false)
    {
        $this->headers = $headers;
        $this->data = $data;
        $this->rows = $rows;
        $this->striped = $striped;
        $this->hoverable = $hoverable;
    }

    public function render()
    {
        return view('components.data-table')->with([
            'headers' => $this->headers,
            'data' => $this->data,
            'rows' => $this->rows,
            'striped' => $this->striped,
            'hoverable' => $this->hoverable,
        ]);
    }
}
