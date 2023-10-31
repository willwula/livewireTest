<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Livewire\Component;

class SaveMember extends Component
{
    public $memberId;
    public $name;
    public $birth;
    public $selectedDate;
    public $skills;
    public $skillslist = ['PHP', 'JAVA', 'C++'];
    public $selectedSkills = [];
    public $listeners = ['dateSelected']; //一定要記得listen啊～～～～～
    protected $rules = [
        'name'           => 'required |min:3',
        'birth'          => 'required',
        'selectedSkills' => 'required|array',
    ];

    public function mount()
    {
        $this->birth = now()->format('Y-m-d');
    }

    public function dateSelected($selectedDate)
    {
//        dd($selectedDate);
        $this->birth = $selectedDate;
    }

    public function saveMember()
    {
        $validatedData = $this->validate();

        $member = Member::create([
            'name'   => $validatedData['name'],
            'birth'  => $validatedData['birth'],
            'skills' => $validatedData['selectedSkills'],
        ]);
        //觸發另一個component的方法並將目前component的變數帶過去。
        $memberId = $member->id;
        $this->emit('saveAttachment', $memberId);

        $this->reset();

        session()->flash('success', '使用者資料已成功新增！');

        $this->redirect('/show');
    }

    public function render()
    {
        return view('livewire.save-member');
    }
}
