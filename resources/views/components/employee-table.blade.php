<div>
    <table class="table table-bordered" id="employees-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

@push('scripts')
<script>
$(function() {
    $('#employees-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('employees.index') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'company.name', name: 'company.name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
   
});
</script>
@endpush
