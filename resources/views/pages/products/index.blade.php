@extends('app')
@section('content')
    <h1 class="mb-3">List of products</h1>
    <form action="{{ route('products.filter') }}" method="GET" id="filter-by-category">
        <div class="row">
            <div class="col-sm-9">
                <select name="cat" class="form-control">
                    <option value="0"></option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->getId() }}">{{ $category->getName() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary">
                    filter
                </button>
            </div>
        </div>
    </form>
    <div id="sort-by-price" class="my-2">
        <div class="row">
            <div class="col-sm-9">
                <select name="sort" class="form-control">
                    <option value="asc">ASC</option>
                    <option value="desc">DESC</option>
                </select>
            </div>
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary">
                    Sort
                </button>
            </div>
        </div>
    </div>
    <table class="table" data-fetch="{{ route('products.list') }}">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
