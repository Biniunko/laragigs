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
        
      return view ('listings.show', [
            'listing' => $listing
        ]);
    }
    //show create form
    public function create(){
        return view('listings.create');
    }
    //this store listing gigs
    public function store(Request $request){
        //validate form
        //use Rule::unique to validate unique company name
       $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => ['required', Rule::unique('listings','company')],
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
           ]);

           if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
           }
           Listing::create($formFields);
        Session::flash('message', 'Listing created successfully');

        //another way to flash message is to use  return redirect()->with('message', 'Listing created successfully');  
        return redirect('/');
        }
   //show edit form
    public function edit(Listing $listing){
        return view('listings.edit', ['listing' => $listing]);
    }

    //update form
public function update(Request $request,Listing $listing){
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
        $listing->update($formFields);
        Session::flash('message', 'Listing updated successfully');

        //another way to flash message is to use  return redirect()->with('message', 'Listing created successfully');  
        return redirect('/');
        }

// delete form
public function destroy(Listing $listing){
        $listing->delete();
        Session::flash('message', 'Listing deleted successfully');

        //another way to flash message is to use  return redirect()->with('message', 'Listing created successfully');  
        return redirect('/');
     }
}