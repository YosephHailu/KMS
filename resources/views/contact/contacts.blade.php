@extends('layouts.public_app')

@section('content')

	<!-- Side Bar -->

	{{-- @include('layouts.public_sidebar')         --}}
	<!-- /Side Bar -->

	<!-- Main content -->
	<div class="content row mt-2">
			<!-- Search results -->
				<div class="col-md-8">
					<div class="card pt-2">
						<table class="table table-togglable table-hover datatable-scroll-y" width="100%" id="myTable">
							<thead class="bg-blue">
								<tr>
									<th>Id</th>
									<th>Office</th>
									<th data-toggle="true">Manager</th>
									<th data-hide="phone,tablet">Phone</th>
									<th data-hide="phone,tablet">Fax</th>
									<th data-hide="phone,tablet">Remark</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>

				<div class="col-md-4">
					Hello
				</div>
				
		</div>

@endsection

@section('script')
	<script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>     
	<script src="{{ asset('global_assets/js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>     
	<script src="{{ asset('global_assets/js/demo_pages/datatables_responsive.js')}}"></script> 

<script>
	var serviceID = 0;
	var token = '{{Session::token()}}';

	$(document).ready( function () {
		let table = $('#myTable').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! url('contactTableData') !!}',
			columns: [
				{ data: 'id', name: 'id' },
				{ data: 'office', name: 'office' },
				{ data: 'manager', name: 'manager' },
				{ data: 'phone', name: 'phone' },
				{ data: 'fax', name: 'fax' },
				{ data: 'remark', name: 'remark' },
				
			]
		});
		
		function loadTable(){
			table.ajax.reload();
		}
		
        // Initialize
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
	});
</script>
@endsection