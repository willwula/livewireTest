<?php

namespace App\Http\Livewire;

use App\Models\Attachment;
use Livewire\Component;

class DownloadAttachment extends Component
{
    public $uuid;
    public $memberId;
    public $attachments;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function download()
    {
        $attachment = Attachment::where('uuid', $this->uuid)->firstOrFail();
        $filePath = storage_path('app/public/' . $attachment->images);
        $fileName = $attachment->original_name;

        return response()->download($filePath, $fileName);
    }

    public function render()
    {
        return <<<'blade'
            <div class="mt-2">
                  <button type="submit" wire:click="download" class="btn btn-success">下載附件</button>
            </div>
        blade;
    }
}
