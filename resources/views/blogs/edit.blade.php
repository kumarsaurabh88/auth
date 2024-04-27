<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>88gravityBlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark py-3">
    <h1 class="text-white text-center" >88gravity</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4" >
        <div class="col-md-10 d-flex justify-content-end" >
            <a href="{{route('blogs.index')}}" class="btn btn-dark " >Back</a>
        </div>
        </div>
       <div class="row d-flex justify-content-center" >
        <div class="col-md-10">
        <div class="card bord-0 shadow-lg my-4" >
            <div class="card-header bg-dark" >
                <h3 class="text-white" >EditBlog</h3>
            </div>
            <form action="{{route('blogs.update',$blog->id)}}" method="post"  enctype="multipart/form-data" >
            
                @method('put')
                @csrf
                
            <div class="card-body" >
                <div class="mb-3" >
                    <label for="name" class="form-label h5" >Name:</label>
                    <input value="{{old('name',$blog->name)}}" type="text" class=" @error('name') is-invalid @enderror form-control form-control-lg"
                     name="name"
                     placeholder="enterName" >
                     @error('name')
                        <p class="invalid-feedback" >{{$message}}</p>
                     @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if ($blog->image)
                    <img src="{{ asset('images/' . $blog->image) }}" alt="Current Image" style="max-width: 50px; border-radius: 50%;">

                    {{-- <img src="{{ asset( $blog->image) }}" alt="Current Image" style="max-width: 50px; border-radius: 50%;"> --}}
                    
        
                    {{-- <img src="{{ asset('images/) }}" alt="Current Image" style="max-width: 50px; border-radius: 50%;"> --}}

                    @else
                    No image available
                    @endif
                </div>

                {{-- <div class="mb-3">
                    <label for="current_image" class="form-label h5">Current Image:</label>
                    @if($blog->image)
                        <img src="{{ asset($blog->image) }}" alt="Blog Image" class="img-fluid">
                    @else
                        <p>No image available</p>
                    @endif
                </div> --}}


                {{-- <div class="card-body">
                    <div class="mb-3">
                        <label for="image" class="form-label h5">Image:</label>
                        <input type="file" class="@error('image') is-invalid @enderror form-control form-control-lg"
                            name="image"
                            placeholder="Enter Image">
                        @error('image')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                </div> --}}



                <div class="mb-3" >
                    <label for="price" class="form-label h5" >Price:</label>
                    <input value="{{old('price',$blog->price)}}" type="text" class=" @error('price') is-invalid @enderror form-control form-control-lg"
                     name="price"
                     placeholder="enterPrice" >
                     @error('price')
                        <p class="invalid-feedback" >{{$message}}</p>
                     @enderror
                </div>

                {{-- <div class="mb-3" >
                    <label for="email" class="form-label h5" >Email:</label>
                    <input value="{{old('email',$blog->email)}}" type="text" class=" @error('name') is-invalid @enderror form-control form-control-lg"
                     name="email"
                     placeholder="enterEmail" >

                     @error('email')
                        <p class="invalid-feedback" >{{$message}}</p>
                     @enderror
                     
                </div> --}}

                <div class="mb-3">
                    <label for="" class="form-label h5" >Description:</label>
                    <textarea name="description" placeholder="someIntresting" 
                    class="form-control form-control-lg"  id="" cols="30" rows="2">{{old('Description',$blog->description)}}</textarea>
                    
                </div>

                <div class="d-grid" >
                <button  type="submit" class="btn btn-lg btn-primary" >update</button>
                </div>

            </div>
            </form>
        </div>
        
        </div>
        
       </div> 
    </div>
      </body>
</html>