<div>
    <table class="table table-bordered" id="companies-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

@push('scripts')
<script>

$('#companies-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route('companies.index') }}',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'logo', name: 'logo'},
        { data: 'website', name: 'website' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});
</script>
@endpush
