@extends('layouts.layout')

@section('title', 'Home')

@section('content')
    <p class="dark:text-[#FDFDFC]">{{ app('currentTenant')->name }}</p>
@endsection
