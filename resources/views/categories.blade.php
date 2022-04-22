@extends('layouts/base')
@section('title', 'Категории')
@section('page-title', 'Все категории')
@section('content')

<div class="section">
    <!-- container -->
    <div class="container">

    <div class="content">
<div class="row">
    @foreach ($categories as $category)
        @include('includes/category_card')
    @endforeach
</div>
</div>
</div>
</div>
@endsection
