<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Livewire\Component;

class DeleteMember extends Component
{
    public $memberId;

    public function mount($memberId)
    {
        $this->memberId = $memberId;
    }

    public function delete(): void
    {
        Member::destroy($this->memberId);

        session()->flash('success', '使用者資料已成功刪除！');

        $this->redirect('/show');
    }

    public function render()
    {
        return <<<'blade'
            <div class="mt-2">
                <button type="submit" wire:click="delete" class="btn btn-danger">刪除資料</button>
            </div>
        blade;
    }
}
