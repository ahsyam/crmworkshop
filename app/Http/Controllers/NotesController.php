<?php

namespace App\Http\Controllers;

use App\Crm\Customer\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotesController extends Controller
{

    public function index(Request $request, $customerId)
    {
        return Note::where('customer_id',$customerId)->get();
    }

    public function show($id)
    {
        return Note::find($id) ?? response()->json(['status'=> 'Not found'], Response::HTTP_NOT_FOUND);
    }

    public function create(Request $request, $customerId)
    {
        $note = new Note();
        $note->note = $request->get('note');
        $note->customer_id = $customerId;
        $note->save();

        return $note;
    }


    public function update(Request $request, $customerId, $id)
    {
        $note = Note::find($id);

        if(!$note) {
            return response()->json(['status'=> 'Not found'], Response::HTTP_NOT_FOUND);
        }
        $customerId = (int)$customerId;

        if($note->customer_id !== $customerId) {
            return response()->json(['status'=> 'Invalid Data'], Response::HTTP_BAD_REQUEST);
        }

        $note->note = $request->get('note');
        $note->save();

        return $note;
    }


    public function delete(Request $request,$customerId, $id)
    {
        $note = Note::find($id);

        if(!$note) {
            return response()->json(['status'=> 'Not found'], Response::HTTP_NOT_FOUND);
        }

        $customerId = (int)$customerId;
        if($note->customer_id !== $customerId) {
            return response()->json(['status'=> 'Invalid Data'], Response::HTTP_BAD_REQUEST);
        }
        $note->delete();

        return response()->json(['status'=> 'deleted'], Response::HTTP_OK);
    }

}
