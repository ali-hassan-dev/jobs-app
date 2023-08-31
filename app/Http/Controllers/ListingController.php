<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Show all listings
    public function index() {
        return view('listings.index',[
            'listings' => Listing::latest()->filter(request(['tag','search']))->paginate(4)
        ]); //we can also use simplePaginate() method
    }

    //Show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing'=> $listing
        ]); //we can also use findOrFail method
    }

    //Show create form
    public function create() {
        return view('listings.create');
    }

    //Show edit form
    public function edit(Listing $listing) {
        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

    //Store listing data
    public function store(Request $req) {
        $formFields = $req->validate([
            'title' => 'required',
            'email' => ['required', 'email'],
            'company' => ['required', Rule::unique('listings','company')],
            'description' => 'required',
            'website' => 'required',
            'tags' => 'required',
            'location' => 'required'
        ]);

        if($req->hasFile('logo')) {
            $formFields['logo'] = $req->file('logo')->store('logos','public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);
        //Session::flash('message','Listing created successfully');
        return redirect('/')->with('message','Listing created successfully!');
    }

    //Update listing data
    public function update(Request $req, Listing $listing) {
        //Make sure logged in user is the owner of the listing
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $formFields = $req->validate([
            'title' => 'required',
            'email' => ['required', 'email'],
            'company' => ['required'],
            'description' => 'required',
            'website' => 'required',
            'tags' => 'required',
            'location' => 'required'
        ]);

        if($req->hasFile('logo')) {
            $formFields['logo'] = $req->file('logo')->store('logos','public');
        }

        $listing->update($formFields);
        //Session::flash('message','Listing created successfully');
        return back()->with('message','Listing updated successfully!');
    }

    //Delete listing
    public function destroy(Listing $listing) {
        //Make sure logged in user is the owner of the listing
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    //Manage listings
    public function manage() {
        return view('listings.manage', [
            'listings' => auth()->user()->listings]);
    }
}
