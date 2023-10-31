<div class="container">
    <div class="row">
        <div class="col-md-5">
            @if ($editing)
                <form wire:submit.prevent="updateMember">
                    <div class="col-8">
                        <label for="name">姓名：</label>
                        <input type="text" wire:model.lazy="name" id="name" class="form-control">
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4 col-8">
                        <label for="birth">生日：</label>
                        <input type="date" wire:model="birth" id="birth" class="form-control">
                        @error('birth') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4 col-8">
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
                    </div>
                    <div class="mt-4 col-8">
                        <label for="images">附件：</label>
                        <input type="file" wire:model="images" id="images" class="form-control"
                               onchange="previewImage(event)">
                        @error('images') <span class="error">{{ $message }}</span> @enderror

                        @if ($previewImageUrl)
                            <div class="mt-2">
                                <img src="{{ $previewImageUrl }}" alt="預覽圖片" width="200">
                            </div>
                        @endif
                    </div>
                </form>
            @else
                <form wire:submit.prevent="createMember">
                    <div class="mt-4 col-8">
                        {{--            @dump("$this->name, $this->birth")--}}
                        <label for="name">姓名：</label>
                        <input type="text" wire:model.lazy="name" id="name" class="form-control">
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4 col-8">
                        <label for="birth">生日：</label>
                        <input type="date" wire:model="birth" id="birth" class="form-control">
                        @error('birth') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4 col-8">
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
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {{--                    <div class="mt-4 col-6">--}}
                            <label for="images">附件：</label>
                            <input type="file" wire:model="images" id="images" class="form-control"
                                   onchange="previewImage(event)">
                            @error('images') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="illustrate">說明：</label>
                            <input type="text" wire:model.lazy="" id="illustrate" class="form-control">
                            @error('illustrate') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    @if ($previewImageUrl)
                        <div class="mt-2">
                            <img src="{{ $previewImageUrl }}" alt="預覽圖片" width="200">
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 d-flex mt-3 justify-content-end">
                            <button type="submit" class="btn btn-primary">儲存</button>
                        </div>
                    </div>

                </form>

                <script>
                    function previewImage(event) {
                        const input = event.target;
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                // 更新圖片預覽的 URL
                                Livewire.emit('updatePreviewImageUrl', e.target.result);
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>

                @endif
                </form>
        </div>

        <div class="col-md-7">
            <table class="table table-striped" style="width: 100%;">
                <thead>
                <tr>
                    <th class="pl-4">姓名</th>
                    <th class="pl-4">生日</th>
                    <th class="pl-4">專長</th>
                    <th class="pl-4">動作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($members as $member)
                    <tr>
                        <td class="pl-3">{{ $member->name }}</td>
                        <td class="pl-3">{{ $member->birth }}</td>
                        <td class="pl-3">{{ json_encode($member->skills) }}</td>
                        <td class="pl-4 text-left">
                            <div col-6>
                                <button type="submit" wire:click="editMember({{ $member->id }})" class="btn btn-warning"
                                        wire:model="editing">
                                    修改資料
                                </button>

                                <button type="submit" wire:click="deleteMember({{ $member->id }})"
                                        class="btn btn-danger">
                                    刪除資料
                                </button>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
