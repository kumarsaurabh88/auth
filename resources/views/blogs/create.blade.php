<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>88gravityProduct</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark py-3">
    <h1 class="text-white text-center" >88gravity</h1>
    </div>
    <div class="container">
        <div class="col-md-10 d-flex justify-content-end" >
            <a href="{{route('blogs.index')}}" class="btn btn-dark " >Back</a>
        </div>
       <div class="row d-flex justify-content-center" >
        <div class="col-md-10">
        <div class="card bord-0 shadow-lg my-4" >
            <div class="card-header bg-dark" >
                @if (session('status'))
                    
                <div class="alert alert-success" >{{ session('status') }}</div>  
                @endif

                <h3 class="text-white" >createProducts</h3>
            </div>
            <form action="{{route('blogs.store')}}" method="POST"  enctype="multipart/form-data" >
                @csrf
            <div class="card-body" >
                <div class="mb-3" >
                    <label for="name" class="form-label h5" >ProductName:</label>
                    <input value="{{old('name')}}" type="text" class=" @error('name') is-invalid @enderror form-control form-control-lg"
                     name="name"
                     placeholder="enterName" >
                     @error('name')
                        <p class="invalid-feedback" >{{$message}}</p>
                     @enderror
                </div>

                <div class="mb-3" >
                    <label for="image" class="form-label h5" >Upload Image(max:20 images only) Image:</label>
                    <input value="{{old('image')}}" type="file" class=" @error('image.*') is-invalid @enderror form-control form-control-lg"
                      placeholder="enterImage" name="image[]" multiple>
                    
                     @error('image.*')
                        <p class="invalid-feedback" >{{$message}}</p>
                     @enderror
                </div>

                <div class="mb-3" >
                    <label for="price" class="form-label h5" >ProductPrice:</label>
                    <input value="{{old('price')}}" type="text" class=" @error('price') is-invalid @enderror form-control form-control-lg"
                     name="price"
                     placeholder="enterPrice" >
                     @error('price')
                        <p class="invalid-feedback" >{{$message}}</p>
                     @enderror
                </div>

                {{-- <div class="mb-3" >
                    <label for="email" class="form-label h5" >Email:</label>
                    <input  type="text" class=" form-control form-control-lg"
                     name="email"
                     placeholder="enterEmail" >
                     
                </div> --}}

                <div class="mb-3" >
                    <label for="" class="form-label h5" >Description:</label>
                    <textarea name="Description" placeholder="someIntresting" class="form-control form-control-lg" id="" cols="30" rows="2"></textarea>
                </div>

                <div class="d-grid" >
                <button class="btn btn-lg btn-primary" >submit</button>
                </div>

            </div>
            </form>
        </div>
        
        </div>
        
       </div> 
    </div>
      </body>
</html>