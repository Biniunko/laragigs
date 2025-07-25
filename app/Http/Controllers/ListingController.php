<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;


class ListingController extends Controller
{//show all listings
    public function index(){
        return view('listings.index',[
        'listings'=>Listing::latest()->filter(request(['tag'],['search']))->paginate(/*specify a number for per page */ )//this for sorting latest listings
    ]);
    }
    //show single listing
    public function show(Listing $listing){
        
      return view ('listing.show', [
            'listing' => $listing
        ]);
    }
    //show create form
    public function create(){
        return view('listings.create');
    }
    //this store listing gigs
    public function store(Request $request){
       $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => ['required', Rule::unique('listings','company')],
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
           ]);
           Listing::create($formFields);
        Session::flash('message', 'Listing created successfully');
        //another way to flash message is to use  return redirect()->with('message', 'Listing created successfully');  
        return redirect('/');
        }
}
