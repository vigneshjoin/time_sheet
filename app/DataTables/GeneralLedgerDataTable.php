<?php

namespace App\DataTables;

use App\Models\GeneralLedger;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class GeneralLedgerDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query)//: EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('sub_class', function ($query) {
            return strtoupper($query->sub_class);
        })
        ->addColumn('type', function ($query) {
            return strtoupper($query->type);
        })
        ->addColumn('sub_class', function ($query) {
            $categories = [
                1 => 'ASSETS',
                2 => 'LIABILITY',
                3 => 'CAPITAL',
                4 => 'REVENUE',
                5 => 'EXPENSE',
                6 => 'CASH',
                7 => 'COUNTER',
                8 => 'BANK',
                9 => 'OTHER DRS',
                10 => 'OTHER CRS',
            ];
            return $categories[$query->sub_class] ?? '-';
        })

            // <span class="badge text-bg-success">Success</span>
            ->addColumn('status', function ($query) {
                $statusClass = ($query->status == 'active') ? 'bg-success' : 'bg-danger';
                return '<span class="badge ' . $statusClass . '">' . ucfirst($query->status) . '</span>';
            })
            
            ->addColumn('action', function($query){

                if($query->parent_id > 0){
                    $view = '<a href="'.route('general-ledger.view', $query->id).'" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>';
                    $edit = '<a href="'.route('general-ledger.edit', $query->id).'" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>';
                    $delete = '<a href="javascript:void(0)" data-url="'.route('general-ledger.destroy', $query->id).'" data-id="'.$query->id.'" class="ml-1 btn btn-sm btn-danger item-delete"><i class="fas fa-trash"></i></a>';
                    return $view.$edit.$delete;
                }else{
                    return '<span class="badge text-bg-warning"><i class="fas fa-lock"></i></span>';
                }
                
            })
            ->rawColumns(['status', 'action']); 
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(GeneralLedger $model): QueryBuilder
    {
         // Get results from stored procedure
            $masterLists = GeneralLedger::GetLedgerHierarchy();

             // Extract ordered account codes
            $accountCodes = collect($masterLists)->pluck('account_code')->toArray();

            // Maintain the same order using FIELD() function
            return GeneralLedger::whereIn('account_code', $accountCodes)
            ->orderByRaw("FIELD(account_code, '" . implode("','", $accountCodes) . "')");
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {

        return 
            $this->builder()
                ->setTableId('generalledger-table')
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
            Column::make('account_code')->title('Account Code'),
            Column::make('title')->title('Title of Account'),
            Column::make('sub_class')->title('Category'),                            
            Column::make('type')->title('Account Type'),
            Column::computed('status')->title('Status'),
            // Column::make('full_path'),
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
        return 'GeneralLedger_' . date('YmdHis');
    }
}
