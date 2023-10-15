@extends("app")
@section("content")
<h1 class="mb-3">List of products</h1>
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Description</th>
      <th>Price</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $product)
      <tr>
        <td>
          <img src="{{$product->getImage()}}" class="img-fluid" style="width: 50px" alt="product image">
        </td>
        <td>{{$product->name}}</td>
        <td>{{$product->description}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->created_at->diffForHumans()}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection