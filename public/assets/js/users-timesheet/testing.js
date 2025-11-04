$(document).on('click', '#refreshBtn', function() {
    console.info('Refresh clicked');
    
    try {
        var table = $('.datatable').DataTable();
        if (table) {
            // Clear any search/filter
            table.search('').columns().search('');
            // Reload and redraw
            table.ajax.reload();
            console.info('DataTable refreshed successfully');
        }
    } catch (e) {
        console.error('Error refreshing table:', e);
        // Only reload page if table refresh fails completely
        window.location.reload();
    }
});

// Initialize DataTable with AJAX source
$(document).ready(function() {
    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.location.pathname + '/list',
        dom: 'lrtip', // Remove 'f' to hide duplicate search
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        language: {
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            lengthMenu: "_MENU_ records per page",
            paginate: {
                previous: "<i class='ti ti-chevron-left'></i>",
                next: "<i class='ti ti-chevron-right'></i>"
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false },
            { data: 'project_id', name: 'project_id' },
            { data: 'staff_id', name: 'staff_id' },
            { data: 'entry_date', name: 'entry_date' },
            { data: 'hours_spent', name: 'hours_spent' },
            { data: 'status', name: 'status' },
            { 
                data: 'id',
                name: 'actions',
                orderable: false,
                searchable: false,
                render: function(data) {
                    return `
                        <div class="d-flex gap-2">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#model_item" class="edit-Id btn btn-sm btn-info" data-user-id="${data}">
                                <i class="ti ti-edit"></i>
                            </a>
                            <form action="/admin/timesheet/${data}" method="POST" class="d-inline">
                                <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </form>
                        </div>
                    `;
                }
            }
        ]
    });
});