<div class="container">
    <div class="row">
        <div class="mt-4 col-8">
            <h1>修改使用者資料</h1>
            <form wire:submit.prevent="updateMember" value="memberID">
                <div class="mt-4 col-5">
                    <label for="name">姓名：</label>
                    <input type="text" wire:model="name" id="name" class="form-control">
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4 col-6">
                    <label for="datepicker">生日：</label>
                    <input type="text" class="form-control" id="datepicker" wire:model="birth">
                    @error('birth') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4 col-5">
                    <label for="skill">專長：</label>
                    <ul>
                        @foreach($skillslist as $skill)
                            <li>
                                <label>
                                    <input type="checkbox" wire:model="selectedSkills" value="{{ $skill }}">
                                    {{ $skill }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    @error('selectedSkills') <span class="error">{{ $message }}</span> @enderror
                </div>
                {{--               @dump(get_defined_vars())--}}
                {{--                這裡要記得帶入變數$memberId--}}
                @livewire('edit-attachment', ['memberId' =>$memberId])

                <div class="col-10 d-flex mt-3 justify-content-end">
                    <button type="submit" class="btn btn-primary">儲存</button>
                </div>
            </form>
        </div>
    </div>
</div>
