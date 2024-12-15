<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $csvcontacts = Contact::with('category')->get();
        $contacts = Contact::with('category')->Paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts','categories','csvcontacts'));
    }

    public function search(Request $request)
    {
        $filters = $request->only(['seach-text', 'gender', 'inquiry_type', 'date']);
        $csvcontacts = Contact::search($filters)->with('category')->get();
        $contacts = Contact::search($filters)->with('category')->Paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts','categories','csvcontacts'));
    }

    public function create() {
        $categories = Category::all();
        $contact = session('contact_data', []);
        return view('index', compact('contact','categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel','address',
                                    'building','detail', 'inquiry-type', 'inquiry-content', 'category_id',
                                    'tel_item1','tel_item2','tel_item3']);
                                    
        if (isset($contact['inquiry-type'])) {
            $category = Category::find($contact['inquiry-type']);
            $contact['inquiry_type_content'] = $category ? $category->content : null;
        }
     
        session(['contact_data' => $contact]);
        return view('confirmation', compact('contact'));
    }

    public function store(request $request)
    {
        $contact = $request->only(['first_name','last_name','gender','email','tel','address',
                                    'building','detail','category_id','inquiry-content']);

        Contact::create($contact);
        session()->forget('contact_data');
        return view('thanks');
    }

    public function destroy($contactId)
    {
        $contact = Contact::findOrFail($contactId);
        $contact->delete();
        return redirect('/admin');
    }
}
