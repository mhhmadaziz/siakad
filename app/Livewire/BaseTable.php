<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseTable extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    public $searchColumns = ['name'];

    public $actionView = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public $perPage = 10;

    public abstract function query(): \Illuminate\Database\Eloquent\Builder;

    public abstract function columns(): array;

    #[Computed()]
    public function data()
    {
        return $this->query()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    foreach ($this->searchColumns as $column) {
                        $query->orWhere($column, 'like', '%' . $this->search . '%');
                    }
                });
            })
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.base-table');
    }
}
