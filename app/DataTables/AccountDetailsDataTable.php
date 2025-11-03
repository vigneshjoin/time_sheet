<?php

namespace App\DataTables;

use App\Models\Accounts;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AccountDetailsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){

                $view = '<a href="'.route('account-party-ledger.view', $query->id).'" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>';

                $edit = '<a href="'.route('account-party-ledger.edit', $query->id).'" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>';

                $delete = '<a href="javascript:void(0)" data-url="'.route('account-party-ledger.destroy', $query->id).'" data-id="'.$query->id.'" class="ml-1 btn btn-sm btn-danger item-delete"><i class="fas fa-trash"></i></a>';


                return $view.$edit.$delete;
            })
            ->addColumn('created_at', function($query){
                return date("d-m-Y", strtotime($query->created_at));
            })
            ->addColumn('updated_at', function($query){
                return date("d-m-Y", strtotime($query->updated_at));
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Accounts $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('accounts-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
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
            Column::make('classification'),
            Column::make('account_no'),
            Column::make('name'),
            Column::make('name_in_raf'),
            Column::make('full_name'),
            // Column::make('cb_group'),
            // Column::make('dr_posting_ac'),
            // Column::make('cr_posting_ac'),
            // Column::make('iwt_entry'),
            // Column::make('type'),
            Column::make('status'),
            Column::computed('action')
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
        return 'AccountDetails_' . date('YmdHis');
    }
}