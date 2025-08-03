<?php



namespace App\Http\Controllers;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class ListingController extends Controller
{
    // Show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    //Show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Create Form
    public function create() {
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth('web')->id();


        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing) {
        // Make sure logged in user is owner
        if($listing->user_id != auth('web')->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete Listing
    public function destroy(Listing $listing) {
        // Make sure logged in user is owner
        if($listing->user_id != auth('web')->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        if($listing->logo && Storage::disk('public')->exists($listing->logo)) {
            Storage::disk('public')->delete($listing->logo);
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    // Manage Listings
    public function manage() {
        return view('listings.manage', ['listings' => auth('web')->user()->listings()->get()]);
    }
}

/*class ListingController extends Controller
{//show all listings
    public function index(){
        return view('listings.index',[
        'listings'=>Listing::latest()->filter(request(['tag'],['search']))->paginate(/*specify a number for per page */ //)//this for sorting latest listings
    //]);
    //}
 //show single listing
  /*  public function show(Listing $listing){
        
      return view ('listings.show', [
            'listing' => $listing
        ]);
    }
    //show create form
  /*  public function create(){
        return view('listings.create');
    }
    
    //this store listing gigs
   /* public function store(Request $request){
        //validate form
        //use Rule::unique to validate unique company name
       $formFields = $request->validate([
            'title' => 'required',
            'location' => 'required',
            'company' => ['required', Rule::unique('listings','company')],
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
           ]);

           if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
           }
           $formFields['user_id'] = Auth::user()->id;
          // $formFields['user_id'] = Auth::check() ? Auth::id() : null;
          //$formFields['user_id'] = auth()->user()->id; 
           Listing::create($formFields);
        Session::flash('message', 'Listing created successfully');

        //another way to flash message is to use  return redirect()->with('message', 'Listing created successfully');  
        return redirect('/');
        }
   //show edit form
   /* public function edit(Listing $listing){
        return view('listings.edit', ['listing' => $listing]);
    }

    //update form
/*public function update(Request $request,Listing $listing){
        //validate form
        //use Rule::unique to validate unique company name
       $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required', 
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
           ]);

           if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
           }
           // Ensure the user_id is set to the authenticated user
        $listing->update($formFields);
        Session::flash('message', 'Listing updated successfully');

        //another way to flash message is to use  return redirect()->with('message', 'Listing created successfully');  
        return redirect('/');
        }

// delete form
/*public function destroy(Listing $listing){
        $listing->delete();
        Session::flash('message', 'Listing deleted successfully');

        //another way to flash message is to use  return redirect()->with('message', 'Listing created successfully');  
        return redirect('/');
     }
    }
}*/