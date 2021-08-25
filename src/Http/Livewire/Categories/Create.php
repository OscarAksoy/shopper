<?php

namespace Shopper\Framework\Http\Livewire\Categories;

use Livewire\WithFileUploads;
use Shopper\Framework\Traits\WithUploadProcess;
use Shopper\Framework\Http\Livewire\AbstractBaseComponent;
use Shopper\Framework\Repositories\Ecommerce\CategoryRepository;

class Create extends AbstractBaseComponent
{
    use WithFileUploads;
    use WithUploadProcess;

    public string $name = '';
    public ?int $parent_id = null;
    public ?string $description = null;
    public bool $is_enabled = true;

    public function rules(): array
    {
        return [
            'name' => 'required|max:150|unique:' . shopper_table('categories'),
            'file' => 'nullable|image|max:1024',
        ];
    }

    public function store(): void
    {
        $this->validate($this->rules());

        $category = (new CategoryRepository())->create([
            'name' => $this->name,
            'slug' => $this->name,
            'parent_id' => $this->parent_id,
            'description' => $this->description,
            'is_enabled' => $this->is_enabled,
        ]);

        if ($this->file) {
            $this->uploadFile('category', $category->id);
        }

        session()->flash('success', __('Category successfully added!'));

        $this->redirectRoute('shopper.categories.index');
    }

    public function render()
    {
        return view('shopper::livewire.categories.create', [
            'categories' => (new CategoryRepository())
                ->makeModel()
                ->scopes('enabled')
                ->select('name', 'id')
                ->get(),
        ]);
    }
}
