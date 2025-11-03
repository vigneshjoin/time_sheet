<?php

namespace App\DataTables;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ContactDataTable extends DataTable
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
                $edit = '<a href="'.route('contact-party-ledger.edit', $query->id).'" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>';
                $view = '<a href="'.route('contact-party-ledger.view', $query->id).'" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>';
                $delete = '<a href="javascript:void(0)" data-url="'.route('contact-party-ledger.destroy', $query->id).'" data-id="'.$query->id.'" class="ml-1 btn btn-sm btn-danger item-delete"><i class="fas fa-trash"></i></a>';

                return $view.$edit.$delete;
            })
            ->addColumn('created_at', function($query){
                return date("d-m-Y", strtotime($query->created_at));
            })
            ->addColumn('updated_at', function($query){
                return date("d-m-Y", strtotime($query->updated_at));
            })
            ->editColumn('active', function($query){
                $status =  $query->active ? 'Active' : 'Inactive';
                return $status;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Contact $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return 
            $this->builder()
                ->setTableId('contact')
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
            Column::make('company_name'),
            Column::make('address'),
            Column::make('email'),
            Column::make('contact_no'),
            Column::make('designation'),
            Column::make('active')->title('Status'),
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
        return 'ContactMaster' . date('YmdHis');
    }
}