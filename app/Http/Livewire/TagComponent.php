<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;

class TagComponent extends Component
{
    public $keyword;
    public $selectedTags = [];
    public $tagId = [];
    public $tagList = [];
    public function mount($tags)
    {
        $this->selectedTags = $tags ? Tag::whereIn('id', $tags->pluck('id')->toArray())->get()->map(fn ($tag) => $tag->title)->toArray() : [];
        $this->tagId = $tags ? $tags->pluck('id')->toArray() : [];
        $this->tagList = Tag::select('title','id')->get();
    }
    public function addTag()
    {
        if ($this->keyword != "" && !in_array($this->keyword, $this->selectedTags)) {
            $available = Tag::where('title', 'like',  '%' . $this->keyword . '%')->first();
            if (!$available) {
                $title = $this->keyword;
                $available = Tag::create(['title' => $title, 'slug' => $this->getSlug($this->keyword)]);
            }
            array_push($this->selectedTags, $this->keyword);
            array_push($this->tagId, $available->id);
            $this->keyword = "";
        }
    }
    public function deleteTag($key)
    {

        $id = Tag::where('title', 'like',  '%' . $this->selectedTags[$key] . '%')->first()->id ?? 0;

        if (($key = array_search($id,$this->tagId)) !== false) {
            unset($this->tagId[$key]);
        }
        unset($this->selectedTags[$key]);
    }
    public function render()
    {
        return view('livewire.tag-component');
    }
    protected function getSlug($title, $iteration = 0)
    {
        $slug = Str::slug($title) . Str::random($iteration);
        if (Tag::firstWhere('slug', $slug)) {
            return $this->getSlug($title, $iteration + 1);
        }
        return $slug;
    }
}
