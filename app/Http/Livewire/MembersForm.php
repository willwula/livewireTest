<?php

namespace App\Http\Livewire;

use App\Models\Attachment;
use App\Models\Member;
use Livewire\Component;
use Livewire\WithFileUploads;

class MembersForm extends Component
{
    use WithFileUploads;

    public $images;
    public $previewImageUrl;
    public $illustrate;
    protected $listeners = ['updatePreviewImageUrl'];
    public $name;
    public $birth;
    public $skills;
    public $skillslist = ['PHP', 'JAVA', 'C++'];
    public $selectedSkills = [];
    public $members = [];
    public $editing;
    protected $rules = [
        'name'   => 'required |min:3',
        'birth'  => 'required',
        'images' => 'nullable',
//        'selectedSkills' => 'array',
    ];

    public function mount()
    {
//        dump(123);
        $this->refreshData();
    }

    public function refreshData()
    {
        $this->members = Member::all();
    }

    public function updated()
    {
//        dd('oh...動了');
//        dump($this->name, $this->birth);
    }

    public function createMember(): void
    {
//        dd(123);
        $validatedData = $this->validate();

        $member = Member::create([
            'name'   => $validatedData['name'],
            'birth'  => $validatedData['birth'],
            'skills' => $this->selectedSkills,
        ]);

        $memberId = $member->id;

        if ($this->images) {
            $imagePath = $this->images->store('images', 'public');
        } else {
            $imagePath = null;
        }

        $attachment = Attachment::create([
            'attachmentable_id'    => $memberId,
            'attachmentable_type'  => Member::class,
            'attachmentable_field' => 'images',
            'images' => $imagePath,
            'original_name'        => $this->images->getClientOriginalName(),
            'file_name'            => $imagePath,
            'mime_type'            => $this->images->getClientMimeType(),
            'illustrate'           => $this->illustrate,
            'uuid'                 => $this->images->hashName(),
            'size'                 => $this->images->getSize(),
        ]);

        $this->name = '';
        $this->birth = '';
        $this->skills = '';
        $this->images = null;
        $this->illustrate = '';
        $this->refreshData();
    }


    public function editMember($memberId)
    {
        $member = Member::find($memberId);
//        dd($memberId);
        $this->name = $member->name;
        $this->birth = $member->birth;
        $this->skills = $member->skills;

        $this->selectedMemberId = $memberId;
        $this->editing = true;
    }

    public function updateMember()
    {
        $member = Member::find($this->selectedMemberId);
        $validatedData = $this->validate();
//        dd($member);
        $member->update([
            'name'   => $validatedData['name'],
            'birth'  => $validatedData['birth'],
            'skills' => $this->selectedSkills,
        ]);

        $this->members = Member::all();

        $this->name = '';
        $this->birth = '';
        $this->selectedSkills = '';
        $this->selectedMemberId = null;
        $this->refreshData();
    }

    public function deleteMember($memberId)
    {
        Member::destroy($memberId);

        $this->members = Member::all();
    }


    public function updatePreviewImageUrl($imageUrl)
    {
        $this->previewImageUrl = $imageUrl;
    }

    public function render()
    {
        return view('livewire.members-form');
    }
}
