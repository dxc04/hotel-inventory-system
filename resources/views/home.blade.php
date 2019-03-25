@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <dashboard-page :room-statuses="{{ json_encode($data) }}"></dashboard-page>
</div>
@endsection
