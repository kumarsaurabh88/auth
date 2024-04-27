<?php

namespace App\Http\Controllers;



use App\models\blog;
use Faker\Core\File;
// use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\support\facades\validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\RedirectResponse;
class blogController extends Controller

{
    //this mathod will show blog page

    public function index(){
        // dd('aaa');
        $blogs = Blog::orderBy('created_at','DESC')->get();
        return view('blogs.list',[
            'blogs' => $blogs
        ]);
    }

    //this method will show for customer
    public function customerBlogs(Request $request){
        // dd($request->all());
        // $blogs = Blog::where('blog', true)->get();
        $blogs = Blog::all();
        
        return view('blogs.customerBlogs', compact('blogs'));

    }

    //this mathod will show create page

    public function create(){
        return view('blogs.create');
    }

    //  //this mathod will store blog page

    //  public function store(Request $request){
    //     // dd($request->all());
    //       //here will be insert blogs in db
    //     $blog = new blog();
    //     $blog->name = $request->name;
    //     $blog->email = $request->email;
    //     $blog->blog = $request->Blog;
    //     $blog->image = $request->image;
    //     $blog->save();

    //     return redirect()->route('blogs.index')->with('success','blog add successfully');

    //  } 

     //this mathod will store blog page
     public function store(Request $request){
        // Validate the request
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string',
            'Description' => 'required|string',
            'price' => 'required|string',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000', // Adjust the validation rules as per your requirements
        ]);
    
        // Create a new blog instance
        $blog = new Blog();
        $blog->name = $validatedData['name'];
        $blog->price = $validatedData['price'];
        $blog->description = $validatedData['Description'];
    
        
        if ($request->hasFile('image')) {

            
            
            foreach ($request->file('image') as $image){
            
            // Check if the uploaded file is indeed an image
            if ($image->isValid()) {
                $imageName = time().'.'.$image->getClientOriginalExtension(); // Get the file extension
                $image->move(public_path('images/'), $imageName);
                // $blog->image = 'images/'.$imageName; // Save the image path in the database
                $blog->image = $imageName; // Save the image path in the database
               
            } else {
            
                // Handle invalid image file
                return redirect()->back()->withInput()->withErrors(['image' => 'The image field must be an image file.']);
            }
            }
        // $blog->image = json_encode($imageNames); // Save the image paths in JSON format  
    }
    // if ($request->hasFile('images')) {
    //     $imagePaths = [];
    //     foreach ($request->file('images') as $image) {
    //         if ($image->isValid()) {
    //             $imageName = time() . '_' . $image->getClientOriginalName();
    //             $image->move(public_path('images/'), $imageName);
    //             $imagePaths[] = 'images/' . $imageName;
    //         } else {
    //             return redirect()->back()->withInput()->withErrors(['image' => 'The image field must be an image file.']);
    //         }
    //     }
    //     $blog->images = json_encode($imagePaths); // Store image paths in the database
    // }
    
    
        // Save the blog instance
        $blog->save();
    
        return redirect()->route('blogs.index')->with('success', 'Blog added successfully');
    }
        
    

    
    

     //this mathod will show blog page

     public function edit($id){
        $blog = Blog::findOrFail($id);
        // return view('blogs.edit',[
        //     'blog' => $blog
        // ]);
        return view('blogs.edit', compact('blog'));
     }

     //this mathod will update a blog page
     

     public function update($id, Request $request) {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:50000',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('blogs.edit', $id)->withInput()->withErrors($validator);
        }
    
        // Find the blog post to update
        $blog = Blog::findOrFail($id);
        $blog->name = $request->name;
        $blog->price = $request->price;
        $blog->description = $request->description;
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Validate and process image
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('images'), $imageName);
    
            // Delete the old image if it exists
            if ($blog->image) {
                // $oldImagePath = public_path('images/'. $blog->image);
                $oldImagePath = public_path($blog->image);

                
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            // Update the image name in the database
            $blog->image = $imageName;
            // $blog->image = 'images/'.$imageName; // Save the image path in the database
                            

        }
    
        // Save the updated blog post
        $blog->save();
    
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }
    


     //this mathod will destroy blog 

     public function destroy($id){
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success','blog deleted successfully');

     }

     public function bulkDelete(Request $request){
       
        $ids = explode(',', $request->input('ids')[0]);
      // dd($ids,$request->all());
        if (!empty($ids)) {
            try {
            blog::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', 'Selected blogs deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete selected blogs.');
        }
        } else {
            return redirect()->back()->with('error', 'No blogs selected for deletion.');
        }

     }

     public function search(Request $request)
    {
    $search = $request->search;
    //dd($search);
    $formattedDate = date('Y-m-d', strtotime($search));
    
    $blogs = Blog::where('name', 'like', "%$search%")
                // ->orWhere('email', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('ID', 'like', "%$search%")
                // ->orWhere('id', $search) // Exact match for id
                // ->orWhere(function ($query) use ($search) {
                 ->orWhere(function ($query) use ($formattedDate) {

                    // $query->whereDate('created_at', '=', date('Y-M-d', strtotime($search)))
                     $query->whereDate('created_at', '=', $formattedDate);
                    // ->orWhere('created_at', 'like', "%$search%");       
                })
                     ->orWhere('created_at', 'like', "%$search%")
                     ->get();
    
    return view('blogs.list', compact('blogs', 'search'));
}

public function customerDashboard()
{
    // Logic to retrieve data for the customer dashboard
    $user = Auth::user(); // Get the authenticated user
    
    // You can add more logic here to fetch data for the dashboard
    
    // Return the view with any necessary data
    return view('blogs.list', ['user' => $user]);
}


// public function profile()
// {
//     if(Auth::check()) // Check if a user is authenticated
//     {
//         $role = Auth::user()->role; // Access the user's role

//         if($role == 'admin')
//         {
//             return view('blogs.list');
//         }
//         else if($role == 'customer')
//         {
//             return view('blogs.customerBlogs');
//         }
//     }
//     else
//     {
//         return redirect()->back()->with('error', 'Unauthorized access'); // Redirect back with an error message for unauthorized access
//     }
//    }

public function profile()
{
    // Logic to retrieve data for the user profile
    $user = Auth::user(); // Get the authenticated user
    
    // You can add more logic here to fetch additional user data
    
    // Return the view with any necessary data
    return view('user.profile', ['user' => $user]);
}


      public function found(Request $request){
    //dd($search);
    $search = $request->search;

    $blogs = Blog::where('name', 'like', "%$search%")
                // ->orWhere('email', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('ID', 'like', "%$search%")

                ->get();

                return view('blogs.customerBlogs', compact('blogs', 'search'));
    }


   }














