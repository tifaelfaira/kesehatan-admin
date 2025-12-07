<?php

namespace App\Http\Controllers;

use App\Models\Multipleuploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MultipleuploadsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'required',
            'filename.*' => 'mimes:doc,docx,pdf,jpg,jpeg,png|max:2000',
            'ref_table' => 'required|string',
            'ref_id' => 'required|integer'
        ]);

        if ($request->hasfile('filename')) { 
            $files = [];
            foreach ($request->file('filename') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    $file->move(public_path('images'), $filename);                    
                    $files[] = [
                        'filename' => 'images/'.$filename,
                        'ref_table' => $request->ref_table,
                        'ref_id' => $request->ref_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            Multipleuploads::insert($files);            
            return back()->with('success', 'Files uploaded successfully!');
        }else{
            return back()->with('error', 'File upload failed!');
        }
    }

    public function destroy($id)
    {
        $file = Multipleuploads::findOrFail($id);
        
        // Hapus file dari storage
        if (file_exists(public_path($file->filename))) {
            unlink(public_path($file->filename));
        }
        
        $file->delete();
        
        return back()->with('success', 'File deleted successfully!');
    }
}