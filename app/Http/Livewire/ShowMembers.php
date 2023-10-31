<?php

namespace App\Http\Livewire;

use App\Models\Attachment;
use App\Models\Member;
use Livewire\Component;

class ShowMembers extends Component
{
    public $members = [];
    public $attachments = [];
    public $memberId;
    public $uuid;
    public function mount()
    {
        $this->members = Member::all();
        $this->attachments = Attachment::all();
    }

    public function editMember($memberId)
    {
        return redirect()->route('edit-member', ['memberId' => $memberId]);
    }

    public function render()
    {
        return view('livewire.show-members');
    }
}
