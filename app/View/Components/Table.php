<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    public $title;
    public $headers;
    public $fields;
    public $rows;
    public $tableId;
    public $options;

    public function __construct($title = '', $headers = [], $fields = [], $rows = [], $tableId = null, $options = [])
    {
        $this->title = $title;
        $this->headers = $headers;
        $this->fields = $fields;
        // primary data collection for the table
        $this->rows = $rows;
        // generate a unique id if not provided so multiple tables can be rendered on same page
        $this->tableId = $tableId ?: 'datatable_' . uniqid();
        // default DataTables options can be overridden by passing $options
        $this->options = array_merge([
            'pageLength' => 25,
            'lengthChange' => true,
            'searching' => true,
            'order' => [[0, 'desc']],
        ], (array) $options);
    }

    public function render()
    {
        return view('components.table');
    }
}
