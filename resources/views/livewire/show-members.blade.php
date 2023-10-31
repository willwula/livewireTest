<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{--修改刪除新稱成功訊息 --}}
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <h1>使用者資料清單</h1>
            <table class="table table-striped" style="width: 100%;">
                <thead>
                <tr>
                    <th class="pl-4">姓名</th>
                    <th class="pl-4">生日</th>
                    <th class="pl-4">專長</th>
                    <th class="pl-4">附件</th>
                    <th class="pl-4">說明</th>
                    <th class="pl-4">動作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($members as $member)
                    <tr>
                        <td class="pl-3">{{ $member->name }}</td>
                        <td class="pl-3">{{ $member->birth }}</td>
                        <td class="pl-3">
                            @foreach ($member->skills as $key => $skill)
                                {{ $skill }}   {{--  {{$key +1}}: {{$skill}}   原本設計--}}
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($member->attachments as $attachment)
                                @if($attachment->images)  {{--多張圖片--}}
                                    @foreach (explode(',', $attachment->images) as $image)
                                        <img src="{{ asset('storage/' . trim($image)) }}" alt="預覽圖片" width="100">
                                    @endforeach
                                @else
                                    <span>無附件</span>
                                @endif
                            @endforeach
                        </td>
                        @foreach($member->attachments as $attachment )
                            <td class="pl-3">{{ $attachment->illustrate }}</td>
                        <td class="pl-4 text-left">
                            <div>
                                <button type="button" wire:click="editMember({{ $member->id }})"
                                        class="btn btn-warning">
                                    修改資料
                                </button>
                                @livewire('delete-member', ['memberId' => $member->id])
{{--                                @dump(get_defined_vars())--}}
{{--                                @dump($attachment->uuid)--}}
                                @livewire('download-attachment', ['uuid' => $attachment->uuid])
                            </div>
                        </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

