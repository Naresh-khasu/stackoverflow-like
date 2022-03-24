<div class="form-group">
    <label for="question" class="col-md-12">Tags</label>

    <input wire:keydown.space.prevent="addTag" wire:model="keyword" type="text" class="form-control form-control-user" minlength="1" list="tags">
    <datalist id="tags">
    @foreach($tagList as $list)
    <option value={{$list->title}}></option>
    @endforeach

    </datalist>
    <div class="row">
        <div class="col-11">
            @if (count($selectedTags))
                <span class="badge badge-success mr-4">Selected Tags:</span>
                @foreach ($selectedTags as $key => $item)
                    <span class="badge badge-pill badge-dark" wire:click='deleteTag({{ $key }})'
                        wire:key="{{ $key }}" style="cursor: pointer">#{{ $item }}</span>
                @endforeach
            @endif
        </div>
        <input type="text" wire:model='tagId' name="tags" readonly hidden>
    </div>
</div>
