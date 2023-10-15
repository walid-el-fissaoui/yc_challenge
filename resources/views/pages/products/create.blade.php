@extends("app")
@section("content")
  <h1 class="mb-3">Create new product</h1>
  <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" id="nameField" placeholder="Name" class="form-control mb-3 @error('name') is-invalid @enderror" value="{{old('name')}}">
    @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input type="number" step="0.01" name="price" id="priceField" placeholder="Price" class="form-control mb-3 @error('price') is-invalid @enderror" value="{{old('price')}}">
    @error('price')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input type="file" accept="image/*" name="image" id="imageField" placeholder="Image" class="form-control mb-3">
    <textarea name="description" id="descriptionField" placeholder="Description" class="form-control mb-3 @error('description') is-invalid @enderror" value="{{old('description')}}" cols="30" rows="5" ></textarea>
    @error('description')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection