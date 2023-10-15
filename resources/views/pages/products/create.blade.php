@extends("app")
@section("content")
  <h1 class="mb-3">Create new product</h1>
  <form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" id="nameField" placeholder="Name" class="form-control mb-3">
    <input type="number" name="price" id="priceField" placeholder="Price" class="form-control mb-3">
    <input type="file" name="image" id="imageField" placeholder="Image" class="form-control mb-3">
    <textarea name="description" id="descriptionField" placeholder="Description" class="form-control mb-3" cols="30" rows="5"></textarea>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection