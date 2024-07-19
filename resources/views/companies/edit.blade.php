@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Company</h1>
    <x-company-form :company="$company"/>
</div>
@endsection
