<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use App\Models\RateOfExchangeModel;


//RateOfExchangeDataTable.php
class RateOfExchangeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->rawColumns([]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(RateOfExchangeModel $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('rate-exchange-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            // Column::make('base')->title('Base Currency'),
            // Column::make('fetching_date')->title('Fetching Date'),
            Column::make('rates_of_exchange_currency_code')->title('FCy'),
            Column::make('rates_of_exchange_currency_name')->title('Currency'),
            // Column::make('rates_of_exchange_currency_rate')->title('Currency Rate'),
            Column::make('cash_buy')->title('Cash Buy'),
            Column::make('cash_buy_from')->title('Cash Buy From'),
            Column::make('cash_buy_upto')->title('Cash Buy UpTo'),
            Column::make('cash_sell')->title('Cash Sell'),
            Column::make('cash_sell_from')->title('Cash Sell From'),
            Column::make('cash_sell_upto')->title('Cash Sell UpTo')
            // Column::computed('status')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'RateOfExchange_' . date('YmdHis');
    }
}
