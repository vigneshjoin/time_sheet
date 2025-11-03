@props([
    'title'   => null,
    'headers' => [],
    'fields'  => [],
    'rows'    => [],
    'module'  => '',   {{-- default value to avoid undefined variable --}}
    'edit'  => ''   ,
    'preview'  => '' , 
    'delete'  => ''   
])



<div class="card">
	<!-- <div class="card-header">
		<h5 class="card-title">{{ $title }}</h5>
	</div> -->
	<div class="card-body">
		<div class="table-responsive">
			<table id="{{ $tableId }}" class="datatable table table-bordered table-striped">
				<thead>
					<tr>
						@foreach($headers as $header)
							<th>{{ $header }}</th>
						@endforeach
					</tr>
				</thead>
				<tbody>
					@forelse($rows as $index => $row)
						<tr>
							<td>{{ $index + 1 }}</td>
							@foreach($fields as $field)
								@php
									$val = data_get($row, $field);
								@endphp
								<td>
									@if($field === 'actions')
										<div class="d-flex align-items-center gap-1">
                                           
                                                @if($edit === 'true')
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#model_item" class="edit-Id btn btn-icon btn-sm btn-info-light" data-bs-toggle="tooltip" title="Edit" data-user-id="{{ $row->id }}" >
                                                        <i class="ti ti-edit fs-14"></i>
                                                    </a>
                                                @endif

                                                @if($preview === 'true')
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#model_item" class="edit-Id btn btn-icon btn-sm btn-info-light" data-bs-toggle="tooltip" title="Preview" data-user-id="{{ $row->id }}" >
                                                        <i class="ti ti-eye fs-14"></i>
                                                    </a>
                                                @endif
                                            
                                            <!-- module -->
                                            @if(isset( $module ) && $module === 'users' && isset($delete) && $delete === 'true' )
                                                

                                                <form action="{{ route('admin.users.destroy', $row->id) }}" 
                                                  method="POST" 
                                                  class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-icon btn-sm btn-danger-light" 
                                                            data-bs-toggle="tooltip"
                                                            title="Delete"
                                                            type="button" onclick="event.preventDefault(); const form = this.closest('form'); Swal.fire({ title: 'Are you sure?', text: 'You won\'t be able to revert this!', icon: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Yes, delete it!' }).then((result) => { if (result.isConfirmed) { form.submit(); } });">
                                                        <i class="ti ti-trash fs-14"></i>
                                                    </button>
                                                </form>

                                                @elseif(isset( $module ) && $module === 'projects' && isset($delete) && $delete === 'true')
                                                    <form action="{{ route('admin.projects.destroy', $row->id) }}" method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-icon btn-sm btn-danger-light" 
                                                                data-bs-toggle="tooltip"
                                                                title="Delete"
                                                                type="button" onclick="event.preventDefault(); const form = this.closest('form'); Swal.fire({ title: 'Are you sure?', text: 'You won\'t be able to revert this!', icon: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Yes, delete it!' }).then((result) => { if (result.isConfirmed) { form.submit(); } });">
                                                            <i class="ti ti-trash fs-14"></i>
                                                        </button>
                                                    </form>

                                                @elseif(isset( $module ) && $module === 'timesheet'  && isset($delete) && $delete === 'true')
                                                    <form action="{{ route('admin.timesheet.destroy', $row->id) }}" method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-icon btn-sm btn-danger-light" 
                                                                data-bs-toggle="tooltip"
                                                                title="Delete"
                                                                type="button" onclick="event.preventDefault(); const form = this.closest('form'); Swal.fire({ title: 'Are you sure?', text: 'You won\'t be able to revert this!', icon: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Yes, delete it!' }).then((result) => { if (result.isConfirmed) { form.submit(); } });">
                                                            <i class="ti ti-trash fs-14"></i>
                                                        </button>
                                                    </form>
                                                
                                                @endif
                                            
                                        </div>
									@elseif($val instanceof \Illuminate\Support\Carbon)
										{{ $val->format('Y-m-d H:i') }}
									@else
										{{ $val }}
									@endif
								</td>
							@endforeach
						</tr>
					@empty
						<tr>
							<td colspan="{{ count($headers) }}" class="text-center">No records found.</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>

@push('scripts')
<script>
    jQuery(document).ready(function() {
		jQuery('.datatable').DataTable();
	});
</script>
@endpush
