@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Employee</h1>
    <x-employee-form :employee="$employee"/>
</div>
@endsection
