<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AuthEntry</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
  <body>
    <div class="bg-dark py-3">
    <h3 class="text-white text-center" >88gravity</h3>
    
    </div>
    <div class="container">
        <!-- <h1 class="text-center text-danger pt-4" >Delete Multipal records using checkbox</h1>  -->
       <div class="row d-flex justify-content-center mt-4" >
        <div class="col-md-10 d-flex justify-content-end" >
            <form action="{{ route('blogs.bulk-delete') }}" method="post" id="deleteForm" >
            
                @csrf
                @method('DELETE')
                
                <input type="hidden" name="ids[]" id="bulk_delete" value=""/>
            <!-- <a href="{{ route('blogs.bulk-delete') }}" class="btn btn-danger" id="deleteAllselectRecord" >Delete All</a> -->
        <button  type="submit"  class="btn btn-danger" id="deleted_all_seleced_record" >DeleteAll</button>
             <!-- <a href="#" class="btn btn-danger" id="deleteAllselectRecord" onclick="event.preventDefault(); document.getElementById('deleteForm').submit();">Delete All</a> -->
                    
        </form>

        {{-- <div class="col-md-3" >
            <div class="form-group" >
                <form action="{{ route('blogs.search') }}" method="get"  >
                    <div class="input-group" >
                        <input class="form-control" name="search" placeholder="search"  value="{{ isset($search) ? search : '' }}" >
                        <button type="search" class="btn btn-primary" >search</button>
                    </div>
         
        </form>
    </div>
</div> --}}

<div class="col-md-3">
    <div class="form-group">
        <form action="{{ route('blogs.search') }}" method="get">
            @csrf
            <div class="input-group">
                <input class="form-control" name="search" placeholder="search" value="{{ isset($search) ? $search : '' }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
</div>


        <a href="{{ route('blogs.create') }}" class="btn btn-dark" >create</a>
        </div>  
</div>
<div class="row d-flex justify-content-center" >
    
            </div>
            <div class="col-md-10" >
        <div class="card bord-0 shadow-lg my-4" >
            <div class="card-header bg-dark" >
                <h3 class="text-white" >Products</h3>
                
            </div>

            <div class="card-body" >
                <table class="table" >
                    <tr>
                        <th><input type="checkbox" name="select_all_aaa" id="select_all_ids" ></th>
                        <th>ID</th>
                        <th>name</th>
                        <th>image</th>
                        {{-- <th>email</th> --}}
                        <th>price</th>
                        <th>description</th>
                        {{-- <th>created_at</th> --}}
                        <th>action</th>

                        
                    </tr>
                    @if ($blogs->isNotEmpty())
                    @foreach ($blogs as $blog )
                    
                    <!-- <tr id="blog_ids{{$blog->id}}" > -->
                        <tr>
                            <td><input type="checkbox" name="ids" class="select-checkbox checkbox_ids" id="" value="{{$blog->id}}" ></td>
                            <td>{{ $blog->id }}</td>
                            <td>{{ $blog->name }}</td>
                            <td>
                                @if ($blog->image != "")
                                <img src="{{ asset('images/' . $blog->image) }}" alt="Current Image" style="max-width: 50px; border-radius: 50%;">
                                @else
                                No image available
                                @endif
                                
                            </td>

                            {{-- //this td for multipal image 
                            @if ($blog->image)
      @php
        $imagePaths = json_decode($blog->image, true);
        if ($imagePaths === null && json_last_error() !== JSON_ERROR_NONE) {
            $imagePaths = []; // Set to empty array if decoding failed
        }
    @endphp
    @foreach ($blogs as $blog)
        <img src="{{ asset('images/' . $blog->image) }}" alt="Image">
    @endforeach
@else
    No images available
@endif --}}

                            

                            <td>{{ $blog->price }}</td>
                            {{-- <td>{{ $blog->image }}</td> --}}
                            {{-- <td>{{ $blog->email }}</td> --}}
                            <td>{{ $blog->description }}</td>
                            {{-- <td>{{ \carbon\carbon::parse($blog->created_at)->format('Y-M-d') }}</td> --}}
                            <td>
                                <a href="{{route('blogs.edit',$blog->id)}}" class="btn btn-dark" >Edit</a>
                                <!-- <a href="#" onclick="deleteBlog({{ $blog->id }});" -->
                                 <!-- class="btn btn-danger" >Delete</a> -->
                                <form id="delete-blog-form-{{$blog->id}}" action="{{route('blogs.destroy',$blog->id)}}" method="post">
                                 @csrf
                                 @method('DELETE')
                                 
                                 <button  type="submit"  class="btn btn-danger" >Delete</button>
                                
                                </form>
                                
                            </td>
                            
                    </tr>
                        @endforeach

                    @endif
                    
                </table>
                


            </div>

            </div>
        
        </div>
        
       </div> 
    </div>

<!-- 
    @push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get select all checkbox
        var selectAllCheckbox = document.getElementById('select-all');
        // Get all individual checkboxes
        var checkboxes = document.querySelectorAll('.select-checkbox');

        // Add click event listener to select all checkbox
        selectAllCheckbox.addEventListener('click', function () {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        // Add click event listener to individual checkboxes
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('click', function () {
                // If any individual checkbox is unchecked, uncheck the select all checkbox
                if (!checkbox.checked) {
                    selectAllCheckbox.checked = false;
                }
            });
        });
    });
</script>
@endpush -->


      </body>
</html>
<script>
    $(document).ready(function() {
        $('#select_all_ids').click(function() {
            $(".checkbox_ids").prop("checked",$(this).prop("checked"))
        });

        $('#deleted_all_seleced_record').click(function() {
            let all_ids = [];
            
            $('input[type="checkbox"][name="ids"]:checked').each(function (){
                all_ids.push($(this).val());
            });
            console.log(all_ids)
            $('#bulk_delete').val(all_ids);
        });
    });
</script>
<script>
    function deleteblog(id){
        if(confirm("you want to delete?")){
            document.getElementById("delete-blog-form-"+id).submit();
        }
    }
</script>




