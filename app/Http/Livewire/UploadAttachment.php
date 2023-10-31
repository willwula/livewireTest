<?php

namespace App\Http\Livewire;

use App\Models\Attachment;
use App\Models\Member;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadAttachment extends Component
{
    use WithFileUploads;

    public $image;
    public $images;
    public $memberId; //從SaveMember帶過來的參數
    public $illustrate;
    public $attachment;
    protected $listeners = ['saveAttachment'];

    public function saveAttachment($memberId)
    {
        $this->validate([
            'images' => 'image|mimes:jpg,pdf|max:10240',
        ]);
        $uuid = Str::uuid()->toString();
        if ($this->images) {
            $imagePath = $this->images->store('images', 'public');
        } else {
            $imagePath = null;
        }

        $attachment = Attachment::create([
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

        $this->reset();
        $this->redirect('/show');
    }

    public function render()
    {
        return view('livewire.upload-attachment');
    }
}
