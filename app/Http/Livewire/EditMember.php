<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Livewire\Component;

class EditMember extends Component
{
    public $memberId;
    public $member;
    public $name;
    public $birth;
    public $attachment;
    public $skills;
    public $skillslist = ['PHP', 'JAVA', 'C++'];
    public $selectedSkills = [];
    public $listeners = ['dateSelected'];
    protected $rules = [
        'name'           => 'required |min:3',
        'birth'          => 'required',
        'selectedSkills' => 'array',
    ];

    public function mount($memberId)
    {
        $member = Member::find($memberId);
        // 將資料存入變數帶至前端
        $this->name = $member->name;
        $this->birth = $member->birth;
        $this->selectedSkills = $member->skills;
    }

    public function dateSelected($selectedDate)
    {
        $this->birth = $selectedDate;
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'name'           => 'min:3',
            'birth'          => 'required',
            'selectedSkills' => 'required',
        ]);
    }

    public function updateMember()
    {
        $validatedData = $this->validate([
            'name'           => 'required|min:3',
            'birth'          => 'required',
            'selectedSkills' => 'required',
        ]);

        $member = Member::find($this->memberId);

        $member->update([
            'name'   => $validatedData['name'],
            'birth'  => $validatedData['birth'],
            'skills' => $validatedData['selectedSkills'],
        ]);
        //觸發另一個component的方法並將目前component的變數帶過去。(送到EditAttachment.php)
        $memberId = $member->id;
        $this->emit('updateAttachment', $memberId);

        session()->flash('success', '使用者資料已成功修改！');

        return redirect()->route('show-members');
    }

    public function render()
    {
        return view('livewire.edit-member');
    }
}
