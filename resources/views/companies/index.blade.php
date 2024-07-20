@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Companies</h1>
    <a href="{{ route('companies.create') }}" class="btn btn-primary">Add Company</a>
    <x-company-table/>
</div>
@endsection

