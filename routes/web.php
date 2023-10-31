<?php

use App\Http\Livewire\EditMember;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/member', \App\Http\Livewire\SaveMember::class)->name('save-member');

Route::get('/show', \App\Http\Livewire\ShowMembers::class)->name('show-members');

Route::get('/edit/member/{memberId}', EditMember::class)->name('edit-member');

//Route::get('/download/attachment/{uuid}', [\App\Http\Livewire\DownloadAttachment::class, 'download'])->name('download-attachment');
