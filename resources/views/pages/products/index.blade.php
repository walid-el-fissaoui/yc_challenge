@extends("app")
@section("content")
<h1 class="mb-3">List of products</h1>
<form action="{{route('products.filter')}}" method="GET">
  <div class="row">
    <div class="col-sm-2">
      <h3>Filter by price</h3>
    </div>
    <div class="col-sm-2">
      <input type="number" step="0.01" class="form-control" name="mip" placeholder="min">
    </div>
    <div class="col-sm-2">
      <input type="number" step="0.01" class="form-control" name="map" placeholder="max">
    </div>
    <div class="col-sm-3">
      <select name="cat" class="form-control">
        <option value="0"></option>
        @foreach ($categories as $category)
        <option value="{{$category->getId()}}">{{$category->getName()}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-sm-2">
      <button type="submit" class="btn btn-primary">
        filter
      </button>
    </div>
  </div>
</form>
<table class="table">
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
    @foreach ($products as $product)
      <tr>
        <td>
          <img src="{{$product->getImage()}}" class="img-fluid" style="width: 50px" alt="product image">
        </td>
        <td>{{$product->getName()}}</td>
        <td>{{$product->getDescription()}}</td>
        <td>{{$product->getPrice()}}</td>
        <td>{{$product->getCategory()}}</td>
        <td>{{$product->getCreatedAt()}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection