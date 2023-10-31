<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-6">
                <label for="images">附件：</label>
                <input type="file" accept="image/jpeg, application/pdf" wire:model="images" id="images"
                       class="form-control">
                <div class="mt-2 ">
                    @if ($images)
                        <label for="preview">預覽：</label>
                        <img src="{{ $images->temporaryUrl() }}" alt="預覽圖片" width="300">
                    @endif
                </div>
                @error('images') <span class="error">{{ $message }}</span> @enderror
            </div>

{{--            @dump(get_defined_vars())--}}
            <div class="col-md-6">
                <label for="illustrate">說明：</label>
                <input type="text" wire:model.lazy="illustrate" id="illustrate" class="form-control">
                @error('illustrate') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
</div>
