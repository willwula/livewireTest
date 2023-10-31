<?php

namespace App\Http\Livewire;

use App\Models\Attachment;
use App\Models\Member;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditAttachment extends Component
{
    use WithFileUploads;

    public $image;
    public $images;
    public $memberId; //從EditMember帶過來的參數
    public $illustrate;
    public $attachments;
    protected $listeners = ['updateAttachment'];  //監聽EditMember.php過來的參數，並執行updateAttachment 這個method

    public function updateAttachment($memberId)
    {
        $this->validate([
            'images' => 'image|mimes:jpg,pdf|max:10240',
            'illustrate' => 'required',
        ]);
        $uuid = Str::uuid()->toString();
        if ($this->images) {
            $imagePath = $this->images->store('images', 'public');
        } else {
            $imagePath = null;
        }
        $attachment = Attachment::find($memberId);

        $attachment->update([
            'attachmentable_id'    => $memberId,
            'attachmentable_type'  => Member::class,
            'attachmentable_field' => 'images',
            'images'               => $imagePath,
            'original_name'        => $this->images->getClientOriginalName(),
            'mime_type'            => $this->images->getClientMimeType(),
            'illustrate'           => $this->illustrate,
            'uuid'                 => $uuid,
            'size'                 => $this->images->getSize(),
        ]);

//        refresh after update
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.edit-attachment');
    }
}
