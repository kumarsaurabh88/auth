<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CustomerEntry</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

    <div class="col-md-3 mt-3">
        <div class="form-group">
            <form action="{{ route('blogs.found') }}" method="get">
                @csrf
                <div class="input-group">
                    <input class="form-control" name="search" placeholder="search" value="{{ isset($search) ? $search : '' }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card bord-0 shadow-lg my-4">
                <div class="card-header bg-dark">
                    <h3 class="text-white">ProductsList</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            {{-- <th><input type="checkbox" name="select_all_aaa" id="select_all_ids"></th> --}}
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>price</th>
                            <th>Description</th>
                            
                            {{-- Add more headers here if needed --}}
                        </tr>
                        @if ($blogs->isNotEmpty())
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td>{{ $blog->name }}</td>
                                    <td>
                                        @if ($blog->image != "")
                                            <img src="{{ asset('images/' . $blog->image) }}" alt="Current Image" style="max-width: 50px; border-radius: 50%;">
                                            @else
                                            No image available
                                        
                                            @endif
                                    </td>
                                    <td>{{ $blog->price }}</td>
                                    <td>{{ $blog->description }}</td>
                                    {{-- Add more table cells here if needed --}}
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
